<template>
    <div :style="`margin-left:${r}px`">
        <h4 :style="`color:${color};`">{{ moneyCount }}</h4>
        <img src="./img/coin.png">
    </div>
</template>

<script>
export default{
    props:{moneyCount:Number, color:String},
    data(){
        return{
            r : Math.round(Math.random()*250)
        }
    }
}
</script>

<style scoped>
    div{
        display: flex;
        align-items: center;
        position: absolute;
        animation-timing-function: linear;
        animation-duration: 1s;
        animation-name: goUp;
    }
    img{
        margin-left: 5px;
        width: 24px;
    }
    h4{
        font-size: 24px;
    }
    @keyframes goUp {
        from{
            margin-bottom: 0;
        }
        to{
            margin-bottom: 100px;
        }
    }
</style>