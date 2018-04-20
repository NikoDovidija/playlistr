require('./bootstrap');
require('moment-duration-format');
window.ProgressBar = require("progressbar.js");
window.Vue = require('vue');
window.Howler = require("howler");

import Header from "./components/Header.vue";
import Player from "./components/Player.vue";
import Record from "./components/RecordPlayer.vue";
import Playlist from "./components/Playlist.vue";

import List from "./components/List.vue";
import ScrollList from "./components/ScrollList.vue";

Vue.component("c-header", Header);
Vue.component("c-player", Player);
Vue.component("c-record", Record);
Vue.component("c-playlist", Playlist);
Vue.component("c-list", List);
Vue.component("c-scroll-list", ScrollList);

// Global component setup
Vue.mixin({
    props: ["apiGet"],
    created () {
        // if component has "api-get" property fetch and assign data
        if (this.apiGet != undefined) {
            this.apiGetCall(this.apiGet);
        }   
    },
    methods: {
        /* 
        sets components data retrieved from url
        */
        setData (data) {
            let props = this.$data;
            // Loop over components data
            for (let prop in props) {
                if (props.hasOwnProperty(prop)){
                    // set components data if fetched data has the same key
                    if (data[prop] != undefined) {
                        this.$data[prop] = data[prop];
                    }
                }
            }
            console.log(data);
        },

        /* 
        execute http GET request
        */
        apiGetCall(url) {
            axios.get("/api/" + url)
            .then(response => {
                this.setData(response.data);
            })
            .catch(e => {
                console.error(e);
            });
        }
    }
});

const app = new Vue({
    el: "#app",
});