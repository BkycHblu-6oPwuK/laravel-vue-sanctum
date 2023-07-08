<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto m-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <RouterLink @click="removeFilter()" class="nav-link" v-if="token" :to="{ name: 'get' }">Заметки
                    </RouterLink>
                </li>
                <li class="nav-item">
                    <RouterLink class="nav-link" v-if="!token" :to="{ name: 'login' }">Вход</RouterLink>
                </li>
                <li class="nav-item">
                    <RouterLink class="nav-link" v-if="!token" :to="{ name: 'registration' }">Регистрация</RouterLink>
                </li>
                <li class="nav-item"><a class="nav-link" v-if="token" @click.prevent="logout()" href="">Выйти</a></li>
            </ul>
        </div>
    </nav>
    <div class="p-3 w-50 m-auto">
        <RouterView v-slot="{ Component }" :key="$route.fullPath">
            <component ref="view" :is="Component"></component>
        </RouterView>
    </div>
</template>

<script>
export default {

    data() {
        return {
            token: null
        }
    },


    mounted() {
        this.getToken()
    },

    updated() {
        this.getToken()
    },

    methods: {
        getToken() {
            const token = localStorage.getItem('x_xsrf_token')
            if (token) {
                this.token = token
            }
        },


        logout() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/logout')
                    .then(res => {
                        localStorage.removeItem('x_xsrf_token')
                        this.removeFilter()
                        this.token = null
                        this.$router.push({ name: "login" })
                    })
            });
        },
        removeFilter() {
            this.$nextTick(() => {
                if (this.$refs.view && typeof this.$refs.view.removeFilter === 'function') {
                    this.$refs.view.removeFilter();
                }
            });
        }
    }
}
</script>
