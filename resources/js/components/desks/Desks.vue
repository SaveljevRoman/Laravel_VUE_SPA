<template>
    <div class="container">
        <h1>Доски</h1>
        <form v-on:submit.prevent="addNewDesk">
            <div class="form-group">
                <input type="text" class="form-control" v-model="name" placeholder="Введите название доски"
                       v-bind:class="{ 'is-invalid': $v.name.$error }">
                <div class="invalid-feedback" v-if="!$v.name.required">
                    Поле не может быть пустым.
                </div>
                <div class="invalid-feedback" v-if="!$v.name.maxLength">
                    Длина превышает допустимое колличество символов: {{ $v.name.$params.maxLength.max }}.
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Добавить</button>
        </form>
        <div class="alert alert-danger mt-3" role="alert" v-if="errored">
            Ошибка загрузки данных!<br>
            {{ errors[0] }}
        </div>
        <div class="row">
            <div class="col-lg-4" v-for="desk in desks">
                <div class="card mt-3">
                    <router-link class="card-body" v-bind:to="{name: 'showDesk', params: {deskId: desk.id}}">
                        <h4 class="card-title">{{ desk.name }}</h4>
                    </router-link>
                    <button type="button" class="btn btn-danger" v-on:click="deleteDesk(desk.id)">Удалить</button>
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
    data() {
        return {
            desks: [],
            errored: false,
            errors: [],
            loading: true,
            name: null,
        }
    },
    methods: {
        getDesks() {
            axios.get('/api/V1/desks')
                .then(response => {
                    this.desks = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                    this.errored = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        deleteDesk(id) {
            if (confirm('Вы действительно хотите удалить доску и содержащиесе в ней карточки с задачами?')) {
                axios.post('/api/V1/desks/' + id, {
                    _method: 'DELETE',
                })
                    .then(response => {
                        this.desks = [];
                        this.getDesks();
                    })
                    .catch(error => {
                        console.log(error);
                        this.errored = true;
                    })
                    .finally(() => {
                        this.loading = false;
                    });
            }
        },
        addNewDesk() {
            this.$v.$touch();
            if (this.$v.$anyError) {
                return;
            }
            axios.post('/api/V1/desks', {
                name: this.name,
            })
                .then(response => {
                    this.desks = [];
                    this.name = '';
                    this.getDesks();
                })
                .catch(error => {
                    console.log(error);
                    if (error.response.data.errors.name) {
                        this.errors = [];
                        this.errors.push(error.response.data.errors.name[0]);
                    }
                    this.errored = true;
                })
                .finally(() => {
                    this.loading = false;
                });
        },
    },
    mounted() {
        this.getDesks();
    },
    validations: {
        name: {
            required,
            maxLength: maxLength(255),
        },
    },
}
</script>
