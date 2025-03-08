<template>
     <div class="all-columns" v-if="flower">
        <div class="column-1">
            <div class="desc">
                <p>
                {{flower.descrip}}
            </p>
            </div>
        </div>
        <div class="column-2">
            <div class="img">
                <h1>{{ flower.title }}</h1>
                <img class="img-flower" :src="flower.img" alt="img"> 
            </div>
        </div>
        <div class="column-3">
            <div class="characteristics">
                <div class="characteristic">
                    <p class="item">Прибыль за полив:</p>
                    <p class="item">{{ Math.ceil(flower.price/10) }}</p>
                    <img src="./img/coin.png" style="width:30px; margin-bottom: -20px;
                    margin-left: -5px;">
                </div>
                <div class="characteristic">
                    <p class="item">Цена:</p>
                    <p class="item"> {{ flower.price }}</p>
                    <img src="./img/coin.png" style="width:30px; margin-bottom: -20px;
                    margin-left: -5px;">
                </div>
                <div class="characteristic">
                    <p class="item">Потребление воды:</p>
                    <p class="item"> {{ flower.use_time_water }} мин</p>
                    <img src="./img/water.png" style="width:24px; margin-bottom: -20px;
                    margin-left: -5px;">
                </div>
                <div class="characteristic">
                    <p class="item">Стадия:</p>
                    <p class="item"> {{flower.stage < 5 ? flower.stage + '/5' : 'макс'}}</p>
                </div>
                <div class="stage-bar">
                    <img v-for="i in Math.floor(flower.stage)" :key="i"
                    src="./img/bar-item.png" class="bar-item">
                </div>
                <div class="characteristic">
                    <p style="font-size: 16px;">
                        С каждой стадией (начиная со второй) цена увеличивается</p>
                </div>
            </div>
        </div>
    </div>
    <div class="btn-block">
        <button @click="$router.go(-1)"
        class="btn btn-flower" v-if="flower">Вернуться</button>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    data(){
        return{
            flower: null
        }
    },
    mounted(){
        this.getFlower()
    },
    methods:{
        getFlower(){
            axios.get(`/api/garden_flowers/show/${this.$route.params.id}`).then(res => {
                this.flower = res.data
                if(this.flower.stage >= 1){
                    this.flower.price *= Math.floor(this.flower.stage)
                }
            })
        }
    }
}
</script>

<style scoped>
h1{
    font-size: 36px;
    text-align: center;
}
p{
    font-size: 22px;
    margin-top: 20px;
}
.all-columns{
    display: flex;
    justify-content: space-around;
    align-items: center;
    height: 80vh;
}
.img{
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
    height: 100%;
}
.column-1{
    width: 34%;
    height: 80%;
    border: solid 2px #568f56;
    border-radius: 30px;
}
.desc{
    padding: 10px;
}
.column-2{
    width: 29%;
    height: 80%;
}
.column-3{
    width: 34%;
    height: 80%;
    border: solid 2px #568f56;
    border-radius: 30px;
}
.btn{
    margin: 0 auto;
    padding: 10px 20px;
    border: none;
    background-color: white;
    font-size: 20px;
    border: #568f56 solid 1px;
    border-radius: 50px;
}
.characteristics{
    padding: 10px;
    font-size: 20px;
}
.characteristic{
    display: flex;
    align-items: center;
}
.item{
    margin-right: 10px;
}
.stage-bar{
    border: black solid 1px;
    height: 30px;
    display: flex;
}
.bar-item{
    width: 20%;
    height: 100%;
}
.img-flower{
    margin-top: 60px;
    transform: scale(2);
}
.btn-block{
    display: flex;
    justify-content: center;
    width: 100%;
    margin-top: -30px;
}
@media (max-width: 1200px) {
    .column-2{
        width: 24%;
        height: 80%;
    }
    .img-flower{
        transform: scale(1.6);
    }
    .column-1{
        width: 36%;
    }
    .column-3{
        width: 36%;
    }
    h1{
        font-size: 30px;
    }
    p{
        font-size: 18px;
    }
}
@media (max-width: 950px) {
    .column-2{
        width: 22%;
        height: 80%;
    }
    .img-flower{
        transform: scale(1.4);
    }
    .column-1{
        width: 38%;
    }
    .column-3{
        width: 38%;
    }
}
@media (max-width: 850px) {
    .img{
        padding-bottom: 30px;
    }
    .all-columns{
        flex-direction: column;
        width: 100%;
        align-items: start;
    }
    .column-2{
        order: -2;
        width: 100%;
        margin: 0 0;
        border-bottom: solid 2px #568f56;
        padding-bottom: 20px;
    }
    .column-1{
        width: 100%;
        border: none;
        border-radius: 0;
    }
    .column-3{
        order: -1;
        width: 100%;
        border: none;
        border-radius: 0;
    }
    .btn-block{
        display: none;
    }
}
@media (max-width: 360px) {
    h1{
        font-size: 26px;
    }
    p{
        font-size: 18px;
    }
}
</style>