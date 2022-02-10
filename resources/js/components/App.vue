<template>
    <nav class="navbar bg-white border-bottom navbar-light">
        <router-link class="navbar-brand mr-auto" :to="{name: 'Products'}" v-if="token">Home</router-link>
        <router-link class="btn nav-button" :to="{name: 'Login'}" v-if="!token">Login</router-link>
    </nav>
</template>

<script>
export default {
    data() {
        return {
            token: 0
        }
    },
    created(){
        this.token = localStorage.getItem('token')
    }
}
</script>