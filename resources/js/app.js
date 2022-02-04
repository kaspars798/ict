require('./bootstrap');

import { createApp } from 'vue';
import HelloWorld from './views/app';

const app = createApp({});

app.component('hello-world', HelloWorld);

app.mount('#app');
