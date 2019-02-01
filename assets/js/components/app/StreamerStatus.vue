<template>
    <div>
        <div v-if="status">Online</div>
        <div v-if="!status">Offline</div>
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