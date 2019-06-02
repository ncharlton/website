<template>
    <div>
        <div v-if="status != null">
            <div v-if="status">
                <strong>Memb is online</strong>
                <p>{{ stream[0].title }}</p>
                <p class="badge badge-primary">Viewers: {{ stream[0].viewer_count }}</p>
            </div>
            <div v-if="!status">Offline</div>
        </div>

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
                thumbnail_width: 300,
                thumbnail_height: 150,
            }
        },
        methods: {
            isStreamerLive() {
                ApiTwitch.isStreamerLive()
                    .then((result) => {
                        if(result.data) {
                            this.stream = result.data
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
        }
    }
</script>

<style scoped>

</style>