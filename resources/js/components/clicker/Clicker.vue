<template>
    <div class="all-game">
    <div class="game">
        <div class="header-game">
            <p class="count-money">{{countMoney}}$</p>
        </div>
        <hr>
        <div class="body-game">
            <div @click="incMoney" class="clicker">

            </div>
            <button class="btn btn-warning mt-5" @click="shopOpen = !shopOpen">
                Shop
            </button>
            <div v-if="shopOpen" class="shop mt-5">
                <div class="item p-2" v-for="item in items" :key="item.id">
                    <button v-if="!item.buyed" :disabled="!isDisabled(item.price)"
                    @click="buy(item)"
                    class="btn btn-primary">{{item.name}}</button>
                    <button v-else class="btn btn-secondary">{{ item.name }} buyed!</button>
                    <p class="price text-center">{{item.price}}$</p>
                </div>
            </div>
        </div>
    </div>
    </div>
</template>

<script>
export default{
    data(){
        return{
            shopOpen: false,
            countMoney: 0,
            x: 1,
            items: [
                {
                    id: 0,
                    name: 'x2 boost',
                    price: 10,
                    buyed: false,
                },
                {
                    id: 1,
                    name: 'man',
                    price: 50,
                    buyed: false,
                },
                {
                    id: 3,
                    name: 'woman',
                    price: 25,
                    buyed: false,
                }
            ],
        }
    },
    methods:{
        incMoney(){
            this.countMoney += this.x
        },
        buy(item){
            if(item.name == 'x2 boost'){
                this.countMoney -= item.price;
                this.x = 2
            }else if(item.name == 'man'){
                this.countMoney -= item.price;
                setInterval(() => {
                    this.countMoney++;
                }, 1000);
            }else if(item.name == 'woman'){
                this.countMoney -= item.price;
                setInterval(() => {
                    this.countMoney += 0.5;
                }, 1000);
            }
            item.buyed = true;
            console.log(this.items)
        },
        isDisabled(price){
            return this.countMoney >= price
        }
    }
}
</script>

<style scoped>
    .all-game{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        height: 100vh;
        background-color: rgb(68, 68, 68);
    }
    .shop{
        display: flex;
        background-color: rgb(255, 255, 255);
        position: absolute;
        top: 65%;
        left: 55%;
    }
    .game{
        margin: 0 auto;
        width: 50%;
        height: 80%;
        background-color: rgb(49, 49, 49);
    }
    .body-game{
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100%;
    }
    .clicker{
        width: 100px;
        height: 100px;
        background-color: rgb(222, 222, 0);
        cursor: pointer;
        transition: 1s;
    }
    .clicker:hover{
        scale: 1.025;
        background-color: rgb(173, 173, 0);
    }
    .header-game{
        display: flex;
        justify-content: end;
    }
    .count-money{
        color: white;
        font-size: 24px;
        margin-right: 20px;
    }
</style>