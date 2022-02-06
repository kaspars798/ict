require('./bootstrap');

const { createApp } = require('vue');
import App from './Index.vue';
import { createWebHistory } from 'vue-router';
import createRouter from './routes.js';

const app = createApp(App);
const router = createRouter(createWebHistory());

app.component('app', require("./components/App.vue").default);
//app.component('home', require("./views/Home.vue").default);
//app.component('about', require("./views/About.vue").default);
app.use(router);
app.mount('#app');
