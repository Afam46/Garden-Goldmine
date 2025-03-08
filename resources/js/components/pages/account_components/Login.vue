<template>
    <div class="form-input">
        <h1 style="font-size: 36px;">Вход</h1>
        <div class="input-label">
            <label>Почта:</label>
            <input class="input" v-model="email" type="email">
        </div>
        <div class="input-label">
            <label>Пароль:</label>
            <input class="input" v-model="password" type="password">
        </div>

        <p class="error">{{ err }}</p>

        <input @click.prevent="login" style="margin: 15px 0; width: 25%;"
        type="submit" class="btn-flower" value="Войти">

        <div style="display: flex; margin-bottom: 20px;">
                <p>Нет аккаунта?</p>
                <router-link class="link-btn" :to="{name:'register'}"
                style="margin-left: 10px;">Регистрация</router-link>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

export default{
    data(){
        return{
            email: '',
            password: '',
            err: '',
            check: false,
        }
    },
    methods:{
        login(){
            axios.post('/api/check',{email: this.email, password: this.password})
            .then(res => {
                this.check = res.data
            })
            this.emailErr = '';
            this.passErr = '';

            if(this.check){
                axios.get('/sanctum/csrf-cookie')
                .then(response => {
                    axios.post('/login', {email:this.email, password:this.password})
                    .then(res => {
                        localStorage.setItem('auth', true)
                        this.$router.push('/');
                    })
                });
            }else{
                this.err = 'Не корректная почта или пароль'
            }
        },
    }
}
</script>

<style>
.error{
    color: brown;
}
.form-input{
    border: solid 2px #568f56;
    border-radius: 10px;
    display: flex;
    width: 40%;
    margin: 170px auto;
    align-items: center;
    flex-direction: column;
}
.form-login{
    width: 100%;
}
.input{
    width: 100%;
    border: solid 1px #568f56;
}
.input-label{
    display: flex;
    width: 65%;
    flex-direction: column;
}
@media (max-width: 950px) {
        .form-input{
            width: 60%;
        }
    }
@media (max-width: 600px) {
        .form-input{
            width: 90%;
        }
    }
</style>