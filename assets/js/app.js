import '@babel/polyfill'
import Vue from 'vue'
import StreamerStatus from './components/app/StreamerStatus'
import VideoPlaylist from './components/app/VideoPlaylist'
import VideoViewer from './components/app/VideoViewer'


require('../css/app.scss');


new Vue({
    el: '#app',
    components: {
        StreamerStatus,
        VideoPlaylist,
        VideoViewer
    },
    data() {
        return {
        }
    },
    methods: {

    },
})
