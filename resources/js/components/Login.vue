<template>
    <div>
        <input v-model="email" type="email" class="form-control mb-3" placeholder="Email">
        <input v-model="password" type="password" class="form-control mb-3" placeholder="Пароль">
        <input @click.prevent="login()" type="submit" class="btn btn-primary" value="Войти">
    </div>
</template>

<script>
import axios from 'axios';

export default {
    name: 'Login',
    data() {
        return {
            email: null,
            password: null,
        }
    },
    methods: {
        login() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/login', { email: this.email, password: this.password })
                    .then(res => {
                        localStorage.setItem('x_xsrf_token',res.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'get'})
                    })
                    .catch( res => {
                    })
            });
        }
    }
}
</script>
