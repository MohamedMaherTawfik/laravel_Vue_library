import { createApp } from 'vue';
import './bootstrap';
import 'animate.css';
import '../css/app.css';

import RegisterComponent from './components/registerComponent.vue';
import LoginComponent from './components/loginComponent.vue';

const app = createApp({});
app.component('register-component', RegisterComponent);
app.component('login-component', LoginComponent);
app.mount('#app');
