<template>
    <div class="header" :class="{ 'out': isScrolledDown }">
        <nav>
            <router-link class="btn-flower nav-item" to="/">Магазин</router-link>
            <router-link class="btn-flower nav-item" to="/garden">Сад</router-link>
            <router-link class="btn-flower nav-item" :to="{name :  'login'}">Аккаунт</router-link>
        </nav>
        <Balance v-if="balance" :balance="balance"/>
    </div>
</template>

<script>
import Balance from './pages/Balance.vue'

export default{
    components:{Balance},
    props:{
        balance: Number,
    },
    data() {
    return {
      isScrolledDown: false,
      scrollPrev: 0
    }
  },
  mounted() {
    window.addEventListener('scroll', this.handleScroll)
  },
  beforeDestroy() {
    window.removeEventListener('scroll', this.handleScroll)
  },
  methods: {
    handleScroll() {
      const scrolled = window.scrollY
      if (scrolled > 100 && scrolled > this.scrollPrev) {
        this.isScrolledDown = true
      } else {
        this.isScrolledDown = false
      }
      this.scrollPrev = scrolled
    }
  }
}
</script>

<style>
    .header{
        background-color:#7fcf7f;;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px 0;
        position: sticky;
        top: 0;
        z-index: 100;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }
    .out {
        transform: translateY(-100%);
    }
    .btn-flower{
        cursor: pointer;
        color: black;
        background-color: white;
        border: solid 2px #568f56;
        border-radius: 10px;
        padding: 10px;
        text-decoration: none;
        transition: 1s;
    }
    .btn-flower:hover{
        background-color: #7fcf7f;
    }
    .nav-item{
        margin: 10px;
    }
</style>