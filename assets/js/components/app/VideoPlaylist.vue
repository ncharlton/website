<template>
    <div>
        <section class="video-slide" v-if="loaded">
            <div class="carousel-videos" v-for="playlist in playlists">
                <div class="slide-title">
                    {{ playlist.title }}
                </div>

                <br>
                <div class="carousel-row">
                    <div class="carousel-tile" v-for="video in playlist.videos">
                        <a :href="'/video/' + video.slug">
                            <img :src="video.video.thumbnails[1].url" class="img-fluid">
                            <div class="badge badge-duration">{{ video.video.duration | formatDuration }}</div>
                            <div class="slide-item-title">
                                <p>{{ video.title }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="carousel-videos" v-for="playlist in playlists">
                <div class="slide-title">
                    {{ playlist.title }}
                </div>

                <br>
                <div class="carousel-row">
                    <div class="carousel-tile" v-for="video in playlist.videos">
                        <a :href="'/video/' + video.slug">
                            <img :src="video.video.thumbnails[1].url" class="img-fluid">
                            <div class="badge badge-duration">{{ video.video.duration | formatDuration }}</div>
                            <div class="slide-item-title">
                                <p>{{ video.title }}</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </section>
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