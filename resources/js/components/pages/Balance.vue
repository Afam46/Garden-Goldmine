<template>
        <div class="price-coin-balance">
            <p style="margin-right: 5px; padding-left: 5px;">Баланс: </p>
            <p>{{balance}}</p>
            <img class="coin" src="./img/coin.png" alt=""
            style="padding-right: 5px;">
        </div>
</template>

<script>
export default{
    props:{balance: Number}
}
</script>

<style>
    .coin{
        width: 24px;
        margin-left: 5px;
    }
    .price-coin-balance{
        position: absolute;
        right: 20px;
        display: flex;
        align-items: center;
        z-index: 101;
    }
    .price-coin{
        display: flex;
        align-items: center;
        margin-bottom: 10px;
    }
    @media (max-width: 550px) {
        .price-coin-balance{
            top: 62px;
            background-color: white;
            border: 1px solid #7fcf7f;
            border-radius: 0 0 5px 5px;
        }
    }
</style>