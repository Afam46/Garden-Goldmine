<template>
    <div class="form-input" style="margin: 180px auto;">
        <h1 style="font-size: 36px;">Регистрация</h1>
        <div class="input-label">
            <label>Имя:</label>
            <input class="input" v-model="name" type="text" :style="nameErr.length > 0
            ? 'margin-bottom: 12px; border: solid 1px brown':''">
            <p class="err" v-for="(err,i) in nameErr" :key="i">{{ err }}</p>
        </div>
        <div class="input-label">
            <label>Почта:</label>
            <input class="input" v-model="email" type="email" :style="emailErr.length > 0
            ? 'margin-bottom: 12px; border: solid 1px brown':''">
            <p class="err" v-for="(err,i) in emailErr" :key="i">{{ err }}</p>
        </div>
        <div class="input-label">
            <label>Пароль:</label>
            <input class="input" v-model="password" type="password" :style="passErr.length > 0
            ? 'margin-bottom: 12px; border: solid 1px brown':''">
            <p class="err" v-for="(err,i) in passErr" :key="i">{{ err }}</p>
        </div>
        <div class="input-label">
            <label>Подтверждение пароля:</label>
            <input class="input" v-model="password_confirmation" type="password"
            :style="passconfErr.length > 0 ? 
            'margin-bottom: 12px; border: solid 1px brown':''">
            <p class="err" v-for="(err,i) in passconfErr" :key="i">{{ err }}</p>
        </div>
        <div>
            <button class="btn-flower" @click.prevent="register" type="submit"
            style="margin: 10px 0;" :disabled="dis">Зарегестрироваться</button>
        </div>
        <div style="display: flex; margin-bottom: 20px;">
                <p>Есть аккаунт?</p>
                <router-link class="link-btn" style="margin-left: 10px;"
                :to="{name:'login'}">Войти</router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios'

export default{
    data(){
    return{
        dis: false,
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
        emails: null,
        emailsArr: [],
        nameErr: [],
        emailErr: [],
        passErr: [],
        passconfErr: [],
    }
    },
    mounted(){
        this.getEmail();
    },
    methods:{
        register(){
            this.dis = true;
            this.nameErr = [];
            this.emailErr = [];
            this.passErr = [];
            this.passconfErr = [];
            if(!this.name.trim()){
                this.nameErr.push('Введите имя')
            }if(this.password !== this.password_confirmation){
                this.passconfErr.push('Пароли не совпадают')
            }if(this.password.length < 8){
                this.passErr.push('Минимум 8 символов')
            }if(this.emailsArr.indexOf(this.email) !== -1){
                this.emailErr.push('Такая почта уже существует')
            }if(this.nameErr.length + this.emailErr.length + this.passErr.length === 0){
                axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/register', {
                        email:this.email,
                        password:this.password,
                        name:this.name,
                        password_confirmation: this.password_confirmation,
                    })
                    .then(res => {
                        if(res && res.status === 200){
                            localStorage.setItem('auth', true)
                            this.$emit('updateBalance');
                            this.$emit('checkAuth');
                            this.$router.push('/');
                        }
                    })
            });
            }
            setTimeout(() => {
                this.dis = false
            }, 2000);
        },
        getEmail(){
            axios.get('/api/email').then(res => {
                this.emails = res.data;
                this.emails.forEach(e => {
                    this.emailsArr.push(e.email)
                })
            });
        },
    }
}
</script>

<style>
    .err{
        color: brown;
        position: absolute;
        text-align: center;
        margin-top: 46px;
    }
</style>