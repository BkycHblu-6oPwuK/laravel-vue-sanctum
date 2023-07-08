<template>
    <div>
        <div class="d-flex">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Добавить заметку
            </button>
            <filter-component  ref="filter" class="ms-3" v-model="$parent.filter"></filter-component>
        </div>

        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Заголовок модального окна</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                    </div>
                    <div class="modal-body">
                        <input v-model="title" type="text" class="form-control mb-3" placeholder="Заголовок">
                        <textarea v-model="description" class="form-control mb-3" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                        <button :disabled="!isDisabled()" @click.prevent="create()" type="button"
                            class="btn btn-primary d-disabled" data-bs-dismiss="modal">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import filter from './Filter.vue';
import axios from 'axios';
export default {
    name: 'Create',
    components: {
        'filter-component': filter,
    },
    data() {
        return {
            title: null,
            description: null,
        }
    },

    mounted() {
    },

    methods: {
        create() {
            axios.post('/api/store', { title: this.title, description: this.description })
                .then(res => {
                    axios.get('/api/get')
                        .then(res => {
                            this.$parent.posts = res.data
                            this.title = null
                            this.description = null
                        })
                })
                .catch(res => {
                })
        },
        isDisabled() {
            return this.title && this.description
        },

    }
}
</script>
