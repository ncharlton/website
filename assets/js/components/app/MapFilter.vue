<template>
    <div>
        <div class="map-filter">
            <div class="filter-item form-group">
                <label for="filterType">Type</label>
                <select id="filterType" v-model="filterSettings.type">
                    <option value="any">Any</option>
                    <option value="land">Land</option>
                    <option value="water">Water</option>
                    <option value="mixed">Mixed</option>
                </select>
            </div>
            <div class="filter-item form-group">
                <label>Base</label>
                <select v-model="filterSettings.base">
                    <option value="any">Any</option>
                    <option value="open">Open</option>
                    <option value="walled">Walled</option>
                    <option value="random">Random</option>
                </select>
            </div>
            <div class="filter-item form-group">
                <label>Start</label>
                <select v-model="filterSettings.start">
                    <option value="any">Any</option>
                    <option value="nomad">Nomad</option>
                    <option value="town center">Town center</option>
                    <option value="migration">Migration</option>
                    <option value="random">Random</option>
                </select>
            </div>
            <div class="filter-item form-group">
                <label>Scout</label>
                <select v-model="filterSettings.scout">
                    <option value="any">Any</option>
                    <option value="none">None</option>
                    <option value="scout">Scout</option>
                    <option value="animal">Animal</option>
                    <option value="random">Random</option>
                </select>
            </div>
            <div class="filter-item form-group">
                <label>Order by</label>
                <select v-model="filterSettings.order">
                    <option value="title">Title</option>
                    <option value="created">Created</option>
                </select>
            </div>
            <div class="filter-item form-group">
                <label>Order direction</label>
                <select v-model="filterSettings.direction">
                    <option value="desc">down</option>
                    <option value="asc">up</option>
                </select>
            </div>
            <div class="filter-item form-group">
                <button class="filter-button" @click="filter()"><i class="fas fa-filter"></i> Filter</button>
            </div>
        </div>
        <hr>
        <h4>{{ count }} results:</h4>

        <div class="scale-loader">
            <transition name="fadeloader">
                <div v-if="loading">
                    <scale-loader color="#fff"></scale-loader>
                </div>
            </transition>
        </div>

        <transition name="fademaps">
            <div v-if="!loading" class="map-wrapper">
                <div v-for="map in maps" v-if="maps">
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
                count: 0,
                currentLevel: 1,
                currentSort: 'desc',
                loading: true,
                filterSettings: {
                    order: 'created',
                    direction: 'desc',
                    type: 'any',
                    base: 'any',
                    start: 'any',
                    scout: 'any',
                    terrain: 'any',
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
                        fType: this.filterSettings.type,
                        fStart: this.filterSettings.start,
                        fScout: this.filterSettings.scout,
                        fTerrain: this.filterSettings.terrain,
                    }
                })
                .then((res) => {
                    this.count = res.data.length;
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