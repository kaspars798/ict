<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder">Product attributes</h6>
        <ul class="list-group list-group-horizontal">
            <li class="list-group-item bg-info">KEY:</li>
            <li class="list-group-item bg-info">VALUE:</li>
        </ul>
        <div v-if="loading">
            Data is loading ...
        </div>
        <div v-else>
            <div v-for="attribute in attributes" :key="attribute.id">
                <attributes-list-item v-bind="{kkey: attribute.kkey, value: attribute.value}" />
            </div>
        </div>
    </div>
</template>

<script>
import AttributesListItem from "./AttributesListItem.vue"

export default {
    props: {
        productId: String
    },
    components: {
        AttributesListItem
    },
    data() {
        return {
            loading: false,
            attributes: null
        }
    },
    created() {
        this.loading = true
        let headers = {Authorization: 'Bearer ' + localStorage.getItem('token'), Accept: 'application/json'}
        axios.get(`/api/products/${this.productId}/attributes`, {headers})
            .then(response => {this.attributes = response.data.data})
            .catch(error => {})
            .then(this.loading = false)
    }
}
</script>