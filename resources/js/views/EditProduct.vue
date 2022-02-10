<template>
    <div v-if="!loading">
        <div class="row">
            <div class="col-md-12">
                <h2>Edit {{ product.name }}</h2>
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12 form-group">
                <label for="name">Product name</label>
                <input type="text" name="name" class="form-control" v-model="name" :class="[{'is-invalid': this.errorFor('name')}]" />
            </div>
        </div>
        <div class="form-row">
            <div class="col-md-12 form-group">
                <label for="description">Product description</label>
                <textarea name="description" class="form-control" rows="5" v-model="description" :class="[{'is-invalid': this.errorFor('description')}]"></textarea>
            </div>
        </div>
        <button type="button" class="btn btn-primary" @click="saveProduct">Save</button>
        <div class="row">
            <div class="col-md-12">
                <h4>Attributes</h4>
            </div>
        </div>
        <div v-for="attribute in attributes" :key="attribute.id">
            <edit-product-attributes v-bind="{productId: id, id: attribute.id, kkey: attribute.kkey, value: attribute.value}" />
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Add new attribute</h4>
            </div>
            <add-attribute v-bind="{productId: id}" />
        </div>
    </div>
</template>

<script>
import EditProductAttributes from "./EditProductAttributes.vue"
import AddAttribute from "./AddAtribute.vue"
export default {
    components: {
        EditProductAttributes,
        AddAttribute
    },
    data() {
        return {
            name: null,
            description: null,
            product: null,
            attributes: null,
            loading: false,
            headers: null
        }
    },
    computed: {
        id() {
            return this.$route.params.id
        }
    },
    methods: {
        saveProduct() {
            axios.put(`/api/products/${this.id}`, { name: this.name, description: this.description}, {headers: this.headers})
                .then(response => {this.$router.push( {name: "Product", params: { id: this.id } } )})
                .catch(error => {
                    if(error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                    this.status = error.response.status
                })
        },
        errorFor(field) {
            return (this.errors && this.errors[field] ? this.errors[field] : null)
        }
    },
    created() {
        this.loading = true;
        this.headers = {Authorization: 'Bearer ' + localStorage.getItem('token'), Accept: 'application/json'}
        axios.get(`/api/products/${this.$route.params.id}`, {headers: this.headers})
            .then(response => {
                this.product = response.data.data
                this.name = response.data.data.name
                this.description = response.data.data.description
                return axios.get(`/api/products/${this.$route.params.id}/attributes`, {headers: this.headers})
                    .then(response => {this.attributes = response.data.data})
                    .catch(error => {})
                    .then(this.loading = false)
            });
    }
}
</script>