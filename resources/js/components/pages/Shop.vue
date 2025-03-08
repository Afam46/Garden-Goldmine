<template>
    <div v-if="flowers">
    <div class="all-shop">
    <ShopCategory @filter="filter" :categories="categories" :activeId="activeId"/>
    <ShopFlowers @buy="goEmit" :flowers="flowers"/>
    </div>
    </div>
    <div v-else class="loading">
        <h1>Loading...</h1>
    </div>
</template>

<script>
import axios from 'axios';
import ShopCategory from './shop_components/ShopCategory.vue';
import ShopFlowers from './shop_components/ShopFlowers.vue';

export default{
    components:{ShopCategory, ShopFlowers},
    data(){
        return{
            categories: null,
            flowers: null,
            activeId: null,
            allFlowers: [],
        }
    },
    mounted(){
        this.getFlowers();
        this.getCategories();
    },
    methods:{
        getFlowers(category = null){
            axios.get('/api/flowers').then(data => {
                this.flowers = data.data;
            })
        },
        getCategories(){
            axios.get('/api/categories').then(data => {
                this.categories = data.data
            })
        },
        filter(id){
            this.activeId = id
            if(id === 'all'){
                this.flowers = this.allFlowers;
            }else{
                let arr = [];
                if(this.allFlowers.length > 0){
                    this.flowers = this.allFlowers;
                    this.allFlowers = [];
                }
                this.flowers.forEach((flower) => {
                    this.allFlowers.push(flower);
                    if(flower.category_id === id){
                        arr.push(flower);
                    }
                })
                this.flowers = arr;
            }
        },
        goEmit(price){
            this.$emit('buy', price)
        }
    }
}
</script>

<style>
    .all-shop{
        display: flex;
        align-items: center;
        flex-direction: column;
    }
    .sub-header{
        display: flex;
        padding: 20px 0;
        justify-content: end;
    }
    .search{
        display: flex;
        align-items: center;
        margin-right: 30px;
    }
    .search-input{
        border-radius: 10px 0 0 10px;
        background-color: rgb(231, 231, 231);
    }
    .poisk{
        background-color: rgb(231, 231, 231);
        border-left: solid 1px black;
        width: 25px;
        display: flex;
        justify-content: center;
        align-items: center; 
        cursor: pointer;
    }
    .loading{
        width: 100%;
        height: 90vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    @media(max-width: 550px){
        .sub-header{
            padding: 40px 0 20px 0;
        }
    }
</style>