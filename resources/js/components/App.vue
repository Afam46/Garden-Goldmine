<template>
    <AppHeader v-if="isAuth" :balance="balance"/>
    <router-view @buy="niga" @sell="plus"
    @updateBalance="getBalance" @destroy="balance = 0"
    @checkAuth="checkAuth">
    </router-view>
</template>

<script>
import AppHeader from './AppHeader.vue';

export default{
    components: {AppHeader},
    data(){
        return{
            isAuth: false,
            balance: 0,
        }
    },
    mounted(){
        this.getBalance();
        this.checkAuth();
    },
    methods:{
        checkAuth(){
          if(localStorage.getItem('auth')){
            this.isAuth = true
          }
        },
        getBalance(){
            axios.get('/api/balance').then(res => {
                this.balance = res.data.balance
            })
        },
        niga(price){
            console.log(this.balance)
            console.log(price)
            this.balance = this.balance - price;
        },
        plus(price){
            this.balance += price;
        }
    }
}
</script>

<style>
body{
    image-rendering: pixelated;
}
</style>