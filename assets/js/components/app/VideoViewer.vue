<template>
    <div v-if="loaded" class="container-fluid">
        <section class="video-viewer">
            <div id="video-switch" class="video-view-switch active" v-on:click="switchView()">
                <i class="fas fa-chevron-right"></i>
            </div>
            <div id="video-view" class="video-view active">
                <iframe class="video-embed-item" :src="'http://youtube.com/embed/' + video.video.youtube_id "></iframe>
            </div>
            <div id="video-side" class="video-side active">
                <p class="video-sub-title">{{ video.playlist.title }}</p>
                <p class="video-title">{{ video.title }}</p>
                <p class="video-description">{{ video.description}}</p>



                <div class="next-videos">
                    <p class="video-sub-title">Next up</p>
                    <div v-for="nextVideo in nextVideos" class="next-video">
                        <a :href="'/video/' + nextVideo.slug">
                            <div class="next-video-img">
                                <img :src="nextVideo.video.thumbnails[1].url" class="img-fluid">
                            </div>
                            <div class="next-video-text">
                                <p class="next-video-title">
                                    {{ nextVideo.title }}
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
    import Moment from 'moment'
    import $ from 'jquery'

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
            switchView() {
                let switchElement = $("#video-switch");
                let viewElement = $("#video-view");
                let sideElement = $("#video-side")
                let switchStatus = switchElement.hasClass('active');

                if(switchStatus) {
                    switchElement.removeClass('active');
                    viewElement.removeClass('active');
                    sideElement.removeClass('active');

                    switchStatus = false;
                } else {
                    switchElement.addClass('active');
                    viewElement.addClass('active');
                    sideElement.addClass('active');

                    switchStatus = true;
                }
            }
        },
        computed: {
            loaded() {
                console.log(this.video)
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
            },

            nextVideos() {
                return this.playlist.videos.slice(0, 5);
            }
        }
    }
</script>

<style scoped>

</style>