<template>
<div style="display:flex; justify-content: center;">
    <div v-if="flowers" class="flowers">
        <div v-for="flower in flowers" :key="flower.id" class="flower">
            <div class="flower-img">
                <img :src="flower.img" :alt="flower.title">
                <Money v-if="money == flower.id"
                :moneyCount="moneyCount" color="rgb(255, 213, 0)"/>
            </div>
            <div class="flower-body">
                <div class="flower-info">
                    <h5 class="title">{{flower.title}}</h5>
                    <div class="price-water">
                        <div class="price-coin">
                            <p class="price">{{flower.price}}</p>
                            <img class="coin" src="./img/coin.png">
                        </div>
                        <img v-if="getTimeForWater(flower.time, flower.use_time_water)"
                        src="./img/water.png" class="water">
                    </div>
                </div>
                <div class="buttons">
                    <button @click="show(flower.id)"
                    class="btn btn-flower">Осмотреть</button>
                    <button @click="sell(flower.id, flower.price)"
                    class="btn btn-flower">Продать</button>
                    <button :disabled="!getTimeForWater(flower.time, flower.use_time_water)" 
                    @click="toWater(flower.id, flower.price)"
                    :class="!getTimeForWater(flower.time, flower.use_time_water)
                     ? 'disable' : 'btn-flower'" class="btn">Полить</button>
                </div>
            </div>
        </div>
        <AddGarden @buy="goEmit" :balance="balance" :countFlowers="flowers.length"/>
    </div>
    <div v-else class="loading">
        <h1>Загрузка...</h1>
    </div>
</div>
</template>

<script>
import axios from 'axios';
import router from '../../router';
import Money from './Money.vue';
import AddGarden from './AddGarden.vue';

export default{
    components:{Money, AddGarden},
    data(){
        return{
            money: false,
            moneyCount: 0,
            flowers: null,
            balance: 0,
            now: new Date().getTime(),
            newStage: null,
        }
    },
    mounted(){
        this.getGarden();
        this.getBalance();
    },
    methods:{
        getGarden(){
            axios.get('/api/garden_flowers').then(res => {
                this.flowers = res.data;
                this.flowers.forEach(flower => {
                    if(flower.stage >= 2){
                        flower.price *= Math.floor(flower.stage);
                    }
                });
            })
        },
        getBalance(){
            axios.get('/api/balance').then(res => {
                this.balance = res.data.balance
            })
        },
        show(id){
            router.push({name : 'flower.show', params:{id : id}})
        },
        getTimeForWater(currentTime, waterTime){
            return parseInt(this.now/60000) - currentTime > waterTime
        },
        sell(id, price){
            this.flowers.forEach((flower,i) => {
                if(flower.id == id){
                    this.flowers.splice(i,1)
                }
            });
            this.$emit('sell', price)
            let countBalance = this.balance + price;
            this.balance += price;
            axios.get(`/api/garden_flowers/destroy/${id}`).then(res => {
                axios.post(`/api/balance/update`, {balance : countBalance})
            });
        },
        toWater(id, profit){
            this.moneyCount = Math.ceil(profit/10)
            let countBalance = this.balance + Math.ceil(profit/10);
            this.balance += Math.ceil(profit/10);
            this.$emit('sell', Math.ceil(profit/10))
            this.money = id;
            axios.post(`/api/balance/update`, {balance : countBalance});
            this.flowers.forEach(flower => {
                if(flower.id == id){
                    flower.time = parseInt(this.now/60000);
                    this.newStage = (flower.stage + Math.round(Math.random()*40)/100)
                    if(this.newStage >= 2){
                        flower.price = flower.price/Math.floor(flower.stage)
                        * Math.floor(this.newStage)
                    }
                }
            });
            if(this.newStage > 5){
                this.newStage = 5;
            }
            axios.post(`/api/garden_flowers/update`, {
                id : id,
                now : parseInt(this.now/60000),
                stage: this.newStage,
            })
            setTimeout(() => {
                this.money = false;
            },1000)
        },
        goEmit(price){
            this.$emit('buy', price)
        }
    }
}
</script>

<style>
.buttons{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    margin-right: 10px;
}
.buttons .btn{
    width: 45%;
    margin-bottom: 5px;
}
.disable{
    color: rgb(193, 193, 193);
}
.water{
    width: 24px;
    margin-right: 30px;
    margin-top: -15px;
}
.price-water{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}
</style>

<style scoped>
    @media(max-width: 550px){
        .flowers{
            padding: 40px 0;
        }
    }
</style>