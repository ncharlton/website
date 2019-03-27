import '@babel/polyfill'
import Vue from 'vue'
import Moment from 'moment'
import StreamerStatus from './components/app/StreamerStatus'
import VideoPlaylist from './components/app/VideoPlaylist'
import VideoViewer from './components/app/VideoViewer'

require('../css/app.scss');

/**
 * Vue filters
 */

Vue.filter('formatDuration', function (value) {
   if (value) {
       let duration = Moment.duration(value);

       if (duration.hours() > 0) {
           return duration.hours() + ':' + duration.minutes() + ':' + duration.seconds();
       } else {
           return duration.minutes() + ':' + duration.seconds();
       }

   }
});

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
});
