<template>
    <div>
        <!-- Кнопка-триггер модального окна -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Добавить заметку
        </button>

        <!-- Модальное окно -->
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
                        <button @click.prevent="create()" type="button" class="btn btn-primary" data-bs-dismiss="modal">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Create',

    data(){
        return {
            title: null,
            description: null,
            posts: null,
        }
    },

    mounted() {
    },

    methods: {
        create(){
            axios.post('/api/store',{title:this.title,description:this.description})
            .then(res => {
                axios.get('/api/get')
                .then(res => {
                    this.$parent.posts = res.data
                    console.log(this.$parent.posts)
                })
            })
            .catch(res => {
                console.log(res)
            })
        }
    }
}
</script>
