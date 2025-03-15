<template>
<div class="account">
    <div class="acc">
        <router-link v-if="!isAuth" class="m-3" :to="{name:'login'}">
        Login</router-link>

        <router-link v-if="!isAuth" class="m-3" :to="{name:'register'}">
        registration</router-link>

        <a class="logout btn-flower" v-if="isAuth" @click.prevent="logout">Выйти</a>
        
        <div v-if="user" class="account-info">
            <p>Имя: {{ user.name }}</p>
            <p>Почта: {{ user.email }}</p>
            <p>Вместимость сада: {{ user.capacity }}</p>
        </div>
    </div>
    <div class="top-table">
        <TopTable :users="top" :user_id="user.id" v-if="top"/>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import TopTable from './TopTable.vue';

export default{
    components:{TopTable},
    data(){
        return{
            isAuth: false,
            user: null,
            top: null,
        }
    },
    mounted(){
        this.checkAuth();
        this.getUser();
        this.getTop();
    },
    methods:{
        checkAuth(){
            if(localStorage.getItem('auth')){
                this.isAuth = true;
            }
        },
        logout(){
            axios.post('/logout').then(res => {
                localStorage.removeItem('auth')
                this.$emit('destroy');
                this.$router.push({name:'login'})
            })
        },
        getUser(){
            axios.get('/api/user').then(res => {
                this.user = res.data
            })
        },
        getTop(){
            axios.get('/api/top').then(res => {
                this.top = res.data
            })
        }
    }
}
</script>

<style>
.account{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
}
.link-btn{
    color: #568f56;
    text-decoration: underline;
}
.account-info{
    margin-top: 30px;
    margin-left: 20px;
}
.logout{
    margin-left: 20px;
}
.top-table{
    width: 80%;
    display: flex;
    justify-content: end;
}
@media (max-width: 950px) {
    .top-table{
        width: 70%;
    }
        .acc{
            width: 30%;
        }
    }
    @media (max-width: 620px) {
    .top-table{
        width: 60%;
    }
        .acc{
            width: 40%;
        }
    }
    @media (max-width: 520px) {
        .account{
            flex-direction: column;
            justify-content: center;
        }
        .top-table{
            width: 100%;
            justify-content: center;
        }
        .acc{
            width: 100%;
            margin-top: 20px;
        }
    }
</style>