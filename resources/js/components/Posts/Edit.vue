<template>
    <RouterLink class="btn mb-2 p-0" :to="{ name: 'get' }">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-arrow-left"
            viewBox="0 0 16 16">
            <path fill-rule="evenodd"
                d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
        </svg>
    </RouterLink>
    <div>
        <input v-model="title" type="text" class="form-control mb-3" placeholder="Заголовок">
        <textarea v-model="description" class="form-control mb-3" id="" cols="30" rows="10"></textarea>
        <button :disabled="!isDisabled()" @click.prevent="this.updatePost()" type="button" class="btn btn-primary me-3">Изменить</button>
        <button v-if="isDeleted()" @click.prevent="restore()" type="button" class="btn btn-primary">Восстановить</button>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: "Edit",
    data() {
        return {
            title: null,
            description: null,
        };
    },
    mounted() {
        this.getPost();
    },
    methods: {
        getPost() {
            let id = this.$route.params.id;
            axios.get(`/api/edit/${id}`)
                .then(res => {
                    this.title = res.data.title;
                    this.description = res.data.description;
                });
        },
        updatePost() {
            let id = this.$route.params.id;
            axios.patch(`/api/${id}`, { title: this.title, description: this.description })
                .then(res => {
                    this.$router.push({ name: "get" });
                });
        },
        isDisabled(){
            return this.title && this.description && localStorage.getItem('filter') == 'all'
        },
        isDeleted(){
            return localStorage.getItem('filter') == 'deleted'
        },
        restore(){
            let id = this.$route.params.id
            axios.post(`/api/restore/${id}`)
            .then(res => {
                localStorage.setItem('filter','all')
                this.$router.push({ name: "get" });
            })
        }
    },
}
</script>
