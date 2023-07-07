<template>
    <create></create>
    <div>
        <div v-for="post in posts" class="card mt-3">
            <div class="card-header d-flex">
                <div class="me-1">{{ post.title }}</div>
                <div>от {{ post.date }}</div>
                <div class="ms-auto align-self-center">
                    <button type="button" @click.prevent="this.delete(post.id)" class="btn-close" aria-label="Удалить"></button>
                </div>
            </div>
            <div class="card-body">
                <div>
                    {{ post.description }}
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Create from './Posts/Create.vue';

export default {
    name: 'Get',
    data() {
        return {
            posts: null,
        }
    },

    components: {
        'Create': Create,
    },

    mounted() {
        this.get()
    },

    methods: {
        get() {
            axios.get('/api/get')
                .then(res => {
                    this.posts = res.data
                })
                .catch(res => {
                    console.log(res)
                })
        },
        delete(id){
            axios.delete(`api/${id}`)
            .then(res => {
                this.get()
            })
        }
    }
}
</script>
