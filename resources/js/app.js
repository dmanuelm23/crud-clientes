require('./bootstrap');
import {createApp} from 'vue';
import 'bootstrap';
import 'bootstrap/dist/css/bootstrap.min.css';

import DashboardComponent from './components/DashboardComponent';
import LoginComponent from './components/auth/LoginComponent';
import ClientesComponent from './components/ClientesComponent';

const app=createApp({
    components:{
        DashboardComponent,
        LoginComponent,
        ClientesComponent
    }
})

app.mount('#app');