<template>
    <div>
        <div v-if="loaded">
            <a :href="'/video/' + video.slug" >{{ video.title }}</a>
            <br>
            <img :src="video.video.thumbnails[1].url">
        </div>
    </div>
</template>

<script>
    export default {
        name: "VideoPlaylistPreview",
        props: ["video"],
        data() {
            return {

            }
        },
        methods: {

        },
        computed: {
            loaded() {
                if(this.video) {
                    console.log(this.video)
                    return true;
                } else {
                    return false;
                }
            }
        }
    }
</script>

<style scoped>

</style>