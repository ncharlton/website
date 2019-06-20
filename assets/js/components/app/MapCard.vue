<template>
    <div class="map-card">
        <a :href="'/map/' + map.slug">
            <img class="img-fluid" :src="'/images/maps/' + map.image_name">
            <div class="map-title">{{ map.title }}</div>
        </a>
    </div>
</template>

<script>
    export default {
        name: "MapCard",
        props: ["map"],
        data() {
            return {

            }
        },

    }
</script>

<style scoped>

</style>