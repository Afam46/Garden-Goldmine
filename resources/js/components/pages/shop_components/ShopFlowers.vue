<template>
    <div class="flowers">
        <div v-for="flower in flowers" :key="flower.id" class="flower">
                <div class="flower-img">
                <img :src="flower.img" :alt="flower.title">
                <Money v-if="buyFlower == flower.id"
                :moneyCount="moneyCount" color="rgb(180, 0, 0)"/>
            </div>
            <div class="flower-body">
                <div class="flower-info">
                    <p class="title">{{ flower.title }}</p>
                    <div class="price-water">
                        <div class="price-coin">
                            <p class="price">
                                {{flower.price }}
                            </p>
                            <img class="coin" src="../img/coin.png">
                        </div>
                        <div class="use-water">
                            <p>{{ flower.use_time_water }} мин</p>
                            <img class="coin" src="../img/water.png">
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button @click.prevent="buy(flower)"
                    :disabled="balance < flower.price || countGarden >= capacity"
                    :class="balance < flower.price || countGarden >= capacity ?
                    'disable' : 'btn-flower'" class="btn">Купить</button>
                </div>
            </div>
            </div>
        </div>
</template>

<script>
import axios from 'axios';
import Money from '../Money.vue';

export default{
    components: {Money},
    props:{flowers: Array},
    data(){
        return{
            buyFlower: null,
            moneyCount: 0,
            user_id: null,
            balance: null,
            countGarden: 0,
            capacity: -1,
        }
    },
    mounted(){
        this.getBalance()
        this.getUser()
        this.getCountGarden()
    },
    methods:{
        getCountGarden(){
            axios.get('/api/garden_flowers/count').then(res => {
                this.countGarden = res.data;
            });
        },
        getBalance(){
            axios.get('/api/balance').then(res => {
                this.balance = res.data.balance
            })
        },
        getUser(){
            axios.get('/api/user_capacity').then(res => {
                this.capacity = res.data
            })
        },
        buy(flower){
            ++this.countGarden;
            if(this.balance >= flower.price && this.countGarden <= this.capacity){
                this.$emit('buy', flower.price)
                this.buyFlower = flower.id;
                this.moneyCount = -flower.price;
                let countBalance = Number(this.balance) - Number(flower.price);
                this.balance -= flower.price;
                axios.post(`/api/balance/update`, 
                {balance : countBalance})
                .then(res=>{
                    let newPrice = flower.price/2
                    axios.post(`/api/garden_flowers`, {
                        title : flower.title,
                        price : newPrice,
                        category_id : flower.category_id,
                        use_time_water : flower.use_time_water,
                        img : flower.img,
                        descrip: flower.descrip,
                    })
                })
            }
            setTimeout(()=>{
                this.buyFlower = false;
            }, 1000)
        },
    }
}
</script>

<style>
    .use-water{
        display: flex;
        align-items: center;
        margin-right: 20px;
    }
    .use-water img{
        width: 20px;
    }
    .price-coin{
        margin: 0;
    }
    .flowers{
        padding-top: 10px;
        display: flex;
        justify-content: center;
        width: 100%;
        flex-wrap: wrap;
    }
    .flower{
        margin: 10px 10px;
        flex-basis: 23.6%;
        height: 360px;
        border: solid 1px #568f56;
        border-radius: 10px;
    }
    .flower-body{
        display: flex;
        flex-direction: column;
        margin-left: 20px;
    }
    .flower-img{
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 175px;
        border-bottom: 1px solid #568f56;
        margin-bottom: 10px;
        box-shadow: inset 10px 10px 10px rgb(236, 236, 252);
        border-radius: 10px;
    }
    .flower-img img{
        transform: scale(1.2);
    }
    .btn{
        text-align: center;
        margin-right: 10px;
        cursor: pointer;
        color: black;
        background-color: white;
        border: solid 2px #568f56;
        border-radius: 10px;
        padding: 10px;
        text-decoration: none;
    }
    @media (min-width: 1700px) {
        .flower{
            flex-basis: 18%;
        }
    }
    @media (max-width: 1430px) {
        .flower{
            flex-basis: 31%;
        }
    }
    @media (max-width: 870px) {
        .flower{
            flex-basis: 45%;
        }
    }
    @media (max-width: 520px) {
        .flower{
            flex-basis: 90%;
        }
    }
</style>