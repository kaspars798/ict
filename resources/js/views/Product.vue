<template>
    <div class="row">
        <div class="col-md-8">
            <div class="card-body">
                <div v-if="!loading">
                    <h2>{{ product.name }}</h2>
                    <hr />
                    <article>{{product.description}}</article>
                </div>
                <router-link class="btn btn-default mt-4" :to="{ name: 'AddProduct' }">Add new</router-link>
                <router-link class="btn btn-primary mt-4" :to="{ name: 'EditProduct', params: { id } }">Edit</router-link>
                <button type="button" class="btn btn-danger mt-4" @click="deleteProduct">Delete</button>
            </div>
        </div>
        <div class="col-md-4">
            <attributes :product-id="id" />
        </div>
    </div>
    
</template>

<script>
import Attributes from "./Attributes"
export default {
    components: {
        Attributes
    },
    data() {
        return {
            product: null,
            loading: false,
            status: null,
            headers: null
        }
    },
    computed: {
        id() {
            return this.$route.params.id
        }
    },
    created() {
        this.loading = true;
        this.headers = {Authorization: 'Bearer ' + localStorage.getItem('token'), Accept: 'application/json'}
        axios.get(`/api/products/${this.id}`, {headers: this.headers})
            .then(response => {
                this.product = response.data.data
                this.loading = false;
            });
    },
    methods: {
        deleteProduct() {
            axios.delete(`/api/products/${this.id}`, {headers: this.headers})
                .then(response => {this.$router.push({ name: 'Products' })})
                .catch(error => {this.status = 0})
        }
    }
}
</script>