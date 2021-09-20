<template>
    <div class="container">
        <div class="form-group">
            <input type="text" @blur="saveName" class="form-control mt-3" v-model="name">
        </div>
        <div class="alert alert-danger mt-3" role="alert" v-if="errored">
            Ошибка загрузки данных!
        </div>
        <div class="spinner-border" style="width: 4rem; height: 4rem;" role="status" v-if="loading">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
</template>

<script>
export default {
    props: [
        'deskId',
    ],
    data() {
        return {
            name: null,
            errored: false,
            loading: true,
        }
    },
    methods: {
        saveName() {
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
    },
    mounted() {
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
    }
}
</script>
