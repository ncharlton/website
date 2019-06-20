<template>
    <div>
        current sort: {{ filterSettings.order }} <br>

            <select v-model="filterSettings.scout">
                <option value="hourse">Hourse</option>
                <option value="camel">Camel</option>
                <option value="any">Any</option>
            </select>

            <select v-model="filterSettings.order">
                <option value="title">Title</option>
                <option value="created">Created</option>
            </select>

            <select v-model="filterSettings.direction">
                <option value="desc">down</option>
                <option value="asc">up</option>
            </select>

            <button @click="filter()">Filter</button>

        <hr>
        <h4>Results:</h4>
        <transition name="fade">
            <div v-if="loading">
                <scale-loader></scale-loader>
            </div>
        </transition>
        <transition name="fademaps">
            <div v-if="!loading">
                <div v-for="map in maps" v-if="maps" class="map-wrapper">
                    <map-card :map="map"></map-card>
                </div>
            </div>
        </transition>
    </div>
</template>

<script>
    import MapCard from "./MapCard";
    import Axios from 'axios';
    import { ScaleLoader } from '@saeris/vue-spinners';

    export default {
        name: "MapFilter",
        components: {MapCard, ScaleLoader},
        data() {
            return {
                maps: [],
                currentLevel: 1,
                currentSort: 'desc',
                loading: true,
                filterSettings: {
                    order: 'created',
                    direction: 'desc',
                    base: '',
                    start: '',
                    scout: 'any',
                }
            }
        },
        methods: {
            loadMaps() {
                this.loading = true;

                Axios.get('/api/maps', {
                    params: {
                        order: this.filterSettings.order,
                        direction: this.filterSettings.direction,
                        fBase: this.filterSettings.base,
                        fStart: this.filterSettings.start,
                        fScout: this.filterSettings.scout,
                    }
                })
                .then((res) => {
                    this.maps = res.data;
                    this.loading = false;
                })
            },
            filter() {
                // adjust filter settings

                this.loadMaps();
            }
        },
        beforeMount() {
            this.loadMaps()
        },
        computed: {

        }
    }
</script>

<style scoped>

</style>