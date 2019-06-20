<template>
    <div>
        <transition name="fade">
            <div v-if="status != null">
                <div v-if="status">
                    <a href="http://twitch.tv/membtv">
                        <img class="img-fluid" :src="thumbnail">
                        <p>{{ stream[0].title }}</p>
                        <p class="badge badge-primary">Viewers: {{ stream[0].viewer_count }}</p>
                    </a>
                </div>
                <div v-if="!status">Offline</div>
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
            },60000);
        }
    }
</script>

<style scoped>

</style>