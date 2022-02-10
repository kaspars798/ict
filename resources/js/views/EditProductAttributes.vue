<template>
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item">{{ kkey }}</li>
        <li class="list-group-item">{{ value }}</li>
        <li class="list-group-item"><button type="button" class="btn btn-danger mt-4" @click="deleteAttribute">Delete</button></li>
    </ul>
</template>

<script>
export default {
    props: { productId: String, id: Number, kkey: String, value: String },
    methods: {
        deleteAttribute() {
            let headers = {Authorization: 'Bearer ' + localStorage.getItem('token'), Accept: 'application/json'}
            axios.delete(`/api/attributes/${this.id}`, {headers})
                .then(response => {this.$router.go()})
                .catch(error => {this.status = 0})
           
        }
    }
}
</script>