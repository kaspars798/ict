import { createRouter } from 'vue-router';
import Products from '@/views/Products.vue';
import Product from '@/views/Product.vue';
import EditProduct from '@/views/EditProduct.vue';
import AddProduct from '@/views/AddProduct.vue';
import Login from '@/views/Login.vue';

const routes = [
    {
        path: "/products",
        name: "Products",
        component: Products
    },
    {
        path: "/product/:id",
        name: "Product",
        component: Product
    },
    {
        path: "/edit-product/:id",
        name: "EditProduct",
        component: EditProduct
    },
    {
        path: "/add-product",
        name: "AddProduct",
        component: AddProduct
    },
    {
        path: "/",
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