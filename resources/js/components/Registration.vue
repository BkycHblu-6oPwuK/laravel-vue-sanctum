<template>
    <div>
        <input v-model="name" type="text" class="form-control mb-3" placeholder="Имя">
        <input v-model="email" type="email" class="form-control mb-3" placeholder="Email">
        <input v-model="password" type="password" class="form-control mb-3" placeholder="Пароль">
        <input v-model="password_confirmation" type="password" class="form-control mb-3" placeholder="Подтвердить пароль">
        <input @click.prevent="registration()" type="submit" class="btn btn-primary mb-3" value="Регистрация">
    </div>
</template>

<script>
export default {
    name: 'Registration',
    data() {
        return {
            name: null,
            email: null,
            password: null,
            password_confirmation: null,
        }
    },
    methods: {
        registration() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/register', { name: this.name, email: this.email, password: this.password, password_confirmation: this.password_confirmation })
                    .then(res => {
                        localStorage.setItem('x_xsrf_token',res.config.headers['X-XSRF-TOKEN'])
                        this.$router.push({name: 'personal'})
                    })
            })
        }
    }
}
</script>
