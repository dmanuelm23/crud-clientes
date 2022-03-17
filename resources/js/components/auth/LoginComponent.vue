<template>
    <div class="container box">
        <main class="form-signin">
            <form>
                <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>
                <div class="form-floating">
                    <input class="form-control" required autofocus type="email" name="email" id="email" placeholder="name@example.com" v-model="login.email">
                    <label for="email">Correo electrónico</label>
                </div>
                <small style="color:red;" v-for="(e_email, index) in errors.email" :key="index">{{e_email}}</small>
                <div class="form-floating">
                    <input class="form-control" required  type="password" name="password" id="password" placeholder="Password" v-model="login.password">
                    <label for="floatingPassword">Contraseña</label>
                </div>
                <small style="color:red;" v-for="(e_password, index) in errors.password" :key="index">{{e_password}}</small>
                <small style="color:red;" v-for="(e_credential, index) in errors.credentials" :key="index">{{e_credential}}</small>

                <div class="checkbox mb-3">
                <label>
                    <input type="checkbox" id="remember" name="remember" v-model="login.remember"> Recuerda mi sesión
                </label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" @click.prevent="enviar">Iniciar Sesión</button>
            </form>
        </main>
    </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            errors:[],
            login:{
                email:'',
                password:'',
                remember:'',
            },
            invalid:{
                'email':0,
                'password':0,
                'credentials':0
            }
        }
    },
    methods: {
        enviar(){
            axios.post('login', this.login).then(response => {
                window.location.href = window.location.origin +'/home';
            })
            .catch((error)=> {
                console.log(error);
                if (error.response.status == 422) {
                    this.errors = error.response.data.errors;
                    this.showErrors();
                    console.log(this.errors);
                }
            });
        },
        showErrors(){
            for(let error in this.errors) {
                switch(error){
                    case 'email':
                        this.invalid.email = 1;
                        break;
                    case 'password':
                        this.invalid.password = 1;
                        break;
                }
            }

        }
    },
}
</script>
<style>
    .box{
        display:flex;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    .form-signin{
        width: 100%;
        max-width: 330px;
        padding: 15px;
        margin: auto;
    }
</style>