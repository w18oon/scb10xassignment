require('./bootstrap');

import Vue from 'vue'

import VueRouter from 'vue-router'
Vue.use(VueRouter)

import Login from './components/LoginComponent.vue'
import Register from './components/RegisterComponent.vue'
import PartyList from './components/party/ListComponent.vue'
import PartyForm from './components/party/FormComponent.vue'

const router = new VueRouter({
    routes: [
        { path: '/', redirect: { name: 'login' }},
        { path: '/login', name: 'login', component: Login },
        { path: '/register', name: 'register', component: Register },
        { path: '/party', name: 'party', component: PartyList },
        { path: '/create-new-party', name: 'create-new-party', component: PartyForm },
    ]
})

router.beforeEach((to, from, next) => {
    const loggedIn = localStorage.getItem('token')
    if (to.name !== 'login' && to.name !== 'register' && !loggedIn) {
        next({ name: 'login' })
    }

    next()
})

const app = new Vue({
    el: '#app',
    router
})
