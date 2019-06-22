<template>
    <div>
        <transition name="fade">
            <div v-if="status != null">
                <div v-if="status">
                    <a class="stream-link" target="_blank" href="https://twitch.tv/membtv">
                        <div class="streamer-online">
                            <div class="streamer-online-image">
                                <img class="img-fluid" :src="thumbnail">
                            </div>
                            <div class="streamer-online-content">
                                <span class="badge badge-live">LIVE</span>
                                <span class="badge badge-viewers"><i class="far fa-eye"></i> {{ stream[0].viewer_count }}</span>
                                <p class="stream-title">{{ stream[0].title | streamSlice }}</p>

                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import ApiTwitch from '../../api/twitch'

    export default {
        name: "StreamerStatus",
        data() {
            return {
                firstLoad: false,
                status: null,
                stream: null,
                thumbnail: null,
                thumbnail_width: 300,
                thumbnail_height: 175,
            }
        },
        methods: {
            isStreamerLive() {
                ApiTwitch.isStreamerLive()
                    .then((result) => {
                        if(result.data) {
                            this.stream = result.data;
                            this.thumbnail = this.stream[0].thumbnail_url;
                            this.thumbnail = this.thumbnail.replace(/{width}/, this.thumbnail_width);
                            this.thumbnail = this.thumbnail.replace("{height}", this.thumbnail_height);
                            console.log(this.thumbnail);
                            console.log(this.stream);
                            this.status = true
                        } else {
                            this.status = false
                        }
                    })
                    .catch((error) => {
                        console.log(error)
                    })
            }
        },
        beforeMount() {
            this.isStreamerLive()
        },
        mounted: function() {
            window.setInterval(() => {
                this.isStreamerLive();
            }, 60000);
        }
    }
</script>

<style scoped>

</style>