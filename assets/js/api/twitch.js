import Axios from 'axios'

export default {
    async isStreamerLive() {
        let result = await Axios.get("/api/twitch/stream/status")
        return result;
    }
}