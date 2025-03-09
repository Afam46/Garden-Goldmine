<template>
    <AppHeader v-if="balance > -1" :balance="balance"/>
    <router-view @buy="niga" @sell="plus"
    @updateBalance="getBalance" @destroy="balance = -1">
    </router-view>
</template>

<script>
import AppHeader from './AppHeader.vue';

export default{
    components: {AppHeader},
    data(){
        return{
            balance: -1,
        }
    },
    mounted(){
        this.getBalance()
    },
    methods:{
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