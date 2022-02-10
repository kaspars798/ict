<template>
    <div class="card w-100">
        <div class="card-body">
            <router-link :to="{ name: 'Product', params: { id } }">
                <h5 class="card-title">{{ name }}</h5>
            </router-link>
            <p class="card-text">{{ description }}</p>
        </div>
    </div>
</template>

<script>
export default {
    props: { name: String, description: String, id: Number }
}
</script>