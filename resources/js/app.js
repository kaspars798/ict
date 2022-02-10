require('./bootstrap');

const { createApp } = require('vue');
import App from './Index.vue';
import { createWebHistory } from 'vue-router';
import createRouter from './routes.js';
import axios from 'axios';
import VueAxios from 'vue-axios';

const app = createApp(App);
const router = createRouter(createWebHistory());

app.component('app', require("./components/App.vue").default);

app.use(router);
app.use(VueAxios, axios);
app.mount('#app');
