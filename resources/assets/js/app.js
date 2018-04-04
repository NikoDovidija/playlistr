 

require('./bootstrap');
require('moment-duration-format');


window.Vue = require('vue');

import Player from "./components/player/Player.vue";
import Header from './components/header/Header.vue'
import Footer from './components/footer/Footer.vue';
//import Playlists from "./components/playlist/Playlists.vue";
import Playlist from "./components/playlist/Playlist.vue";


Vue.component("header-component", Header);
Vue.component("footer-component", Footer);
Vue.component("player-component", Player);
//Vue.component("playlists-component", Playlists);
Vue.component("playlist-component", Playlist);

// TODO make serverside rendering of components

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
            app.$refs.player.setPlaylist(data, 0);
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
})

const app = new Vue({
    el: "#app",
});


app.$refs.player.setSong("t8RFcWCWkcI");
