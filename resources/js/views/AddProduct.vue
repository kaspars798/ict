<template>
    <div>
        <div class="row">
            <div class="col-md-12">
                <h2>Add product</h2>
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
    </div>
</template>

<script>

export default {
    data() {
        return {
            name: null,
            description: null,
            status: null,
            errors: null
        }
    },
    methods: {
        saveProduct() {
            this.errors = null
            let headers = {Authorization: 'Bearer ' + localStorage.getItem('token'), Accept: 'application/json'}
            axios.post('/api/products', { name: this.name, description: this.description }, { headers })
                .then(response => {this.$router.push({ name: 'Products' })})
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
    }
}
</script>