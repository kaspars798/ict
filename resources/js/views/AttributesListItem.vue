<template>
    <ul class="list-group list-group-horizontal">
        <li class="list-group-item">{{ kkey }}</li>
        <li class="list-group-item">{{ value }}</li>
    </ul>
</template>

<script>
export default {
    props: { kkey: String, value: String }
}
</script>
    