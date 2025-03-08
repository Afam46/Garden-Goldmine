import { createRouter, createWebHistory } from "vue-router";
import Shop from "./components/pages/Shop.vue";
import Garden from "./components/pages/Garden.vue";
import Account from "./components/pages/Account.vue";
import Login from "./components/pages/account_components/Login.vue";
import Flower from "./components/pages/Flower.vue";
import Registration from "./components/pages/account_components/Registration.vue";

const routes = [
    {
        path: '/',
        name: 'shop',
        component: Shop
    },
    {
        path: '/garden',
        name: 'garden',
        component: Garden
    },
    {
        path: '/account',
        name: 'account',
        component: Account,
    },
    {
        path: '/logInNa',
        name: 'login',
        component: Login
    },
    {
        path: '/registration',
        name: 'register',
        component: Registration
    },
    {
        path: '/flower/:id',
        name: 'flower.show',
        component: Flower
    }
];

const router = createRouter({
    history : createWebHistory(),
    routes
});

router.beforeEach((to, from, next) => {
    const isAuth = localStorage.getItem('auth');
    if(!isAuth){
        if(to.name === 'login' || to.name === 'register'){
            return next()
        }else{
            return next({
                name: 'login'
            })
        }
    }
    if(to.name === 'login' || to.name === 'register' && isAuth){
        return next({
            name: 'account'
        })
    }

    next()
})

export default router;