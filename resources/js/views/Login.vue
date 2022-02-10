<template>
    <div class="w-50 m-auto">
        <div class="card card-body">
            <form>
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="text" name="email" placeholder="Enter your e-mail" class="form-control" v-model="email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" placeholder="Enter your password" class="form-control" v-model="password">
                </div>
                <button type="button" class="btn btn-primary btn-lg btn-block" @click="login">Log-in</button>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            email: null,
            password: null
        }
    },
    methods: {
        async login() {
            try {
                axios.get('/sanctum/csrf-cookie')
                axios.post('/api/login', {email: this.email, password: this.password})
                    .then(response => {
                        localStorage.setItem('token', response.data.token)
                        this.$router.push({ name: 'Products' })
                    })
            } catch (errors) {

            }

        }
    }
}
</script>