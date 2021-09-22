<template>
    <div class="container">
        <h1>{{ name }}</h1>
        <div class="form-group mb-3">
            <input type="text" v-on:blur="saveName" class="form-control mt-3" v-model="name"
                   v-bind:class="{ 'is-invalid': $v.name.$error }">
            <div class="invalid-feedback" v-if="!$v.name.required">
                Поле не может быть пустым.
            </div>
            <div class="invalid-feedback" v-if="!$v.name.maxLength">
                Длина превышает допустимое колличество символов: {{ $v.name.$params.maxLength.max }} .
            </div>
        </div>
        <form v-on:submit.prevent="addNewDeskList">
            <div class="form-group">
                <input type="text" class="form-control" v-model="desk_list_name" placeholder="Введите название списка"
                       v-bind:class="{ 'is-invalid': $v.desk_list_name.$error }">
                <div class="invalid-feedback" v-if="!$v.desk_list_name.required">
                    Поле не может быть пустым.
                </div>
                <div class="invalid-feedback" v-if="!$v.desk_list_name.maxLength">
                    Длина превышает допустимое колличество символов: {{ $v.desk_list_name.$params.maxLength.max }}.
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Добавить список</button>
        </form>
        <div class="alert alert-danger mt-3" role="alert" v-if="errored">
            Ошибка загрузки данных!
        </div>
        <div class="row">
            <div class="col-lg-4" v-for="desk_list in desk_lists">
                <div class="card mt-3">
                    <a href="#" class="card-body">
                        <h4 class="card-title">{{ desk_list.name }}</h4>
                    </a>
                    <button type="button" class="btn btn-danger" v-on:click="deleteDeskList(desk_list.id)">Удалить
                    </button>
                </div>
            </div>
        </div>
        <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status" v-if="loading">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
import {required, maxLength} from 'vuelidate/lib/validators';

export default {
    props: [
        'deskId',
    ],
    data() {
        return {
            name: null,
            errored: false,
            loading: true,
            desk_list_name: null,
            desk_lists: true,
        }
    },
    methods: {
        saveName() {
            this.$v.$touch();
            if (this.$v.$anyError) {
                return;
            }
            axios.post('/api/V1/desks/' + this.deskId, {
                _method: 'PUT',
                name: this.name,
            })
                .then(response => {
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getDeskName() {
            axios.get('/api/V1/desks/' + this.deskId)
                .then(response => {
                    this.name = response.data.data.name;
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getDeskLists() {
            axios.get('/api/V1/desk_lists', {
                params: {
                    desk_id: this.deskId
                }
            })
                .then(response => {
                    this.desk_lists = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        addNewDeskList() {
            this.$v.$touch();
            if (this.$v.$anyError) {
                return;
            }
            axios.post('/api/V1/desk_lists', {
                name: this.desk_list_name,
                desk_id: this.deskId
            })
                .then(response => {
                    this.desk_list_name = [];
                    this.desk_lists = [];
                    this.getDeskLists();
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        deleteDeskList(id) {
            if (confirm('Вы действительно хотите удалить список и содержащиеся карточки с задачами?')) {
                axios.post('/api/V1/desk_lists/' + id, {
                    _method: 'DELETE',
                })
                    .then(response => {
                        this.desk_lists = [];
                        this.getDeskLists();
                    })
                    .catch(error => {
                        console.log(error.response);
                        this.errored = true;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        },
    },
    mounted() {
        this.getDeskName();
        this.getDeskLists();
    },
    validations: {
        name: {
            required,
            maxLength: maxLength(255),
        },
        desk_list_name: {
            required,
            maxLength: maxLength(255),
        },
    },
}
</script>
