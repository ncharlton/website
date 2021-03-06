import '@babel/polyfill'
import Vue from 'vue'
import Moment from 'moment'
import StreamerStatus from './components/app/StreamerStatus'
import VideoPlaylist from './components/app/VideoPlaylist'
import VideoViewer from './components/app/VideoViewer'
import MapFilter from './components/app/MapFilter'
import { VueSpinners } from '@saeris/vue-spinners'

require('bootstrap/js/src');
require('@fortawesome/fontawesome-free/css/all.min.css');
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

Vue.filter('streamSlice', function(value) {
    return value.slice(0, 20) + ' ...';
});

Vue.use(VueSpinners);

new Vue({
    el: '#app',
    components: {
        StreamerStatus,
        VideoPlaylist,
        VideoViewer,
        MapFilter
    },
    data() {
        return {
        }
    },
    methods: {

    },
});
