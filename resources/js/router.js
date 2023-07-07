import { createRouter, createWebHistory } from "vue-router";

const routes = [
    {
        path: '/Get', component: () => import('./components/Get.vue'),
        name: 'get'
    },
    {
        path: '/Login', component: () => import('./components/Login.vue'),
        name: 'login'
    },
    {
        path: '/Registration', component: () => import('./components/Registration.vue'),
        name: 'registration'
    },
    {
        path: '/Personal', component: () => import('./components/Personal.vue'),
        name: 'personal'
    },
]

const router = createRouter({
    history: createWebHistory(),
    routes
})

router.beforeEach((to,from,next) => {
    const token = localStorage.getItem('x_xsrf_token')

    if(!token){
        if(to.name === 'login' || to.name === 'registration'){
            return next()
        } else {
            return next({
                name: 'login'
            })
        }
    }

    if(to.name === 'login' || to.name === 'registration' && token){
        return next({
            name: 'personal'
        })
    }


    next()

})

export default router