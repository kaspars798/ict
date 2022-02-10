<template>
    <div>
        <div class="form-row attribute">
            <div class="col-md-6 form-group">
                <label for="key">Attribute key</label>
                <input type="text" name="key" class="form-control" v-model="kkey" :class="[{'is-invalid': this.errorFor('kkey')}]" />
            </div>
            <div class="col-md-6 form-group">
                <label for="value">Attribute value</label>
                <input type="text" name="value" class="form-control" v-model="value" :class="[{'is-invalid': this.errorFor('value')}]" />
            </div>
        </div>
        <button type="button" class="btn btn-primary" @click="saveAttribute">Save</button>
    </div>
</template>

<script>
export default {
    props: { productId: String },
    data() {
        return {
            kkey: null,
            value: null,
            errors: null
        }
    },
    methods: {
        saveAttribute() {
            this.errors = null
            let headers = {Authorization: 'Bearer ' + localStorage.getItem('token'), Accept: 'application/json'}
            axios.post('/api/attributes', { product_id: this.productId, key: this.kkey, value: this.value }, {headers})
                .then(response => {this.$router.go()})
                .catch(error => {
                    if(error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                })
        },
        errorFor(field) {
            return (this.errors && this.errors[field] ? this.errors[field] : null)
        }
    }
}
</script>