<template>
    <create ref="create"></create>
    <div>
        <h1 class="mt-3" v-if="this.posts && this.posts.length == 0">Нет заметок</h1>
        <div v-for="post in posts" class="card mt-3">
            <div role="button" @click.prevent="this.toEdit(post.id)">
                <div class="card-header d-flex">
                    <div class="me-1 content">
                        <div>{{ post.title }}</div>
                    </div>
                    <div>
                        от {{ post.date }}
                    </div>
                    <div class="ms-auto d-flex align-self-center align-items-center">
                        <div v-if="this.filter == 'deleted'" class="ms-auto align-self-center">
                            <button type="button" @click.stop="this.restore(post.id)" class="btn p-0 me-3"
                                aria-label="Восстановить">
                                Восстановить
                            </button>
                        </div>
                        <button type="button" @click.stop="this.delete(post.id)" class="btn btn-close"
                            aria-label="Удалить"></button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="content">
                        <div>{{ post.description }}</div>
                    </div>
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
            filter: localStorage.getItem('filter') || null,
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
            axios.get('/api/get', { params: { filter: this.filter } })
                .then(res => {
                    this.posts = res.data
                })
                .catch(res => {
                })
        },
        delete(id) {
            axios.delete(`api/${id}`)
                .then(res => {
                    this.get()
                })
        },
        toEdit(id) {
            this.$router.push({ name: 'edit', params: { id: id } })
        },
        changeFilter(value) {
            this.filter = value
            this.get()
        },
        removeFilter() {
            localStorage.setItem('filter','all')
            this.changeFilter(localStorage.getItem('filter'))
            this.$forceUpdate();
            this.$refs.create.$refs.filter.value = localStorage.getItem('filter')
            this.$router.push({name:'get'})
        },
        restore(id){
            axios.post(`/api/restore/${id}`)
            .then(res => {
                localStorage.setItem('filter','all')
                this.get()
            })
        }
    }
}
</script>
