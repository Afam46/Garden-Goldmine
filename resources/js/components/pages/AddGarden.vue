<template>
    <div v-if="capacity && capacity <= countFlowers && capacity < 20" class="flower">
            <div class="flower-add">
                <div @click="buyCapacity(25*this.capacity)"
                :class="balance > 25*this.capacity ? 'add' : 'disable gray-add'">+</div>
                <button class="add-price" :disabled="balance < 25*this.capacity">
                    <p>{{25*this.capacity}}</p><img src="./img/coin.png">
                </button>
            </div>
        </div>
</template>

<script>
export default{
    props:{balance: Number,countFlowers:Number},
    data(){
        return{
            capacity: null,
        }
    },
    mounted(){
        this.getCapacity();
    },
    methods: {
        getCapacity(){
            axios.get('/api/user_capacity').then(res => {
                this.capacity = res.data
            })
        },
        buyCapacity(price){
            if(this.balance > price && this.capacity <= this.countFlowers){
                let countBalance = Number(this.balance) - Number(price);
                this.$emit('buy',price);
                ++this.capacity; 
                axios.post(`/api/balance/update`, 
                {balance : countBalance}).then(res => {
                    axios.post('/api/user_capacity/update',{capacity : this.capacity})
                })
            }
        }
    }
}
</script>

<style scoped>
.add-price{
    display: flex;
    position: absolute;
    margin-top: 90px;
}
img{
    width: 24px;
    margin-left: 4px;
}
.flower-add{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100%;
}
.add{
    background-color: #568f56;
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 24px;
    cursor: pointer;
    transition: .3s;
}
.add:hover{
    background-color: #467446;
}
.gray-add{
    background-color: #666666;
    width: 50px;
    height: 50px;
    border-radius: 10px;
    display: flex;
    justify-content: center;
    align-items: center;
    color: white;
    font-size: 24px;
    cursor: pointer;
}
</style>