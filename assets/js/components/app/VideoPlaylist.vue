<template>
    <div>
        <div v-if="loaded">
            <div v-for="playlist in playlists">
                {{ playlist.title }}
                <video-playlist-preview v-for="video in playlist.videos"
                    :video="video"
                    :key="video.id"
                />
                <hr>
            </div>
        </div>
        {{ loaded }}
    </div>
</template>

<script>
    import VideoPlaylistPreview from "./VideoPlaylistPreview";
    export default {
        name: "VideoPlaylist",
        components: {VideoPlaylistPreview},
        props: ["playlists"],
        data() {
            return {

            }
        },
        methods: {
        },
        computed: {
            loaded() {
                if(this.playlists) {
                    console.log(this.playlists)
                    return true

                } else {
                    return false
                }
            }

        },
    }
</script>

<style scoped>

</style>