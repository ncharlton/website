import '@babel/polyfill'
import Vue from 'vue'
import StreamerStatus from './components/app/StreamerStatus'

require('../css/app.scss');


new Vue({
    el: '#app',
    components: {StreamerStatus},
    data() {
        return {
        }
    },
    methods: {

    },
})
