<template>
    <div>
        <div v-if="loaded">
            Title: {{ video.title }}<br>
            Description {{ video.description}}<br>
            Created at: {{ video.created_at }}<br>
            Playlist title: {{ video.playlist.title }}<br>
            Playlist description: {{ video.playlist.description }}<br>

            <div v-if="event">
                event title: {{ event.title }}
            </div>
            <div v-if="game">
                game title: {{ game.name }}
            </div>


            <hr>
            <div v-html="video.video.embed_html"></div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "VideoViewer",
        props: ['video'],
        data() {
            return {
                playlist: null,
                event: null,
                game: null,
            }
        },
        methods: {

        },
        computed: {
            loaded() {
                if(this.video) {
                    this.playlist = this.video.playlist

                    if(this.playlist.event !== 'undefined') {
                        this.event = this.playlist.event
                    }

                    if(this.playlist.event.game !== 'undefined') {
                        this.game = this.playlist.event.game
                    }


                    console.log(this.playlist)
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