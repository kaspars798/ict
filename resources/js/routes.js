import { createRouter } from 'vue-router';
import Products from '@/views/Products.vue';
import Login from '@/views/Login.vue';

const routes = [
    {
        path: "/",
        name: "Products",
        component: Products
    },
    {
        path: "/login",
        name: "Login",
        component: Login
    }
];

export default function (history) {
    return createRouter({
        history,
        routes
    })
};