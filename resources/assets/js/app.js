 

require('./bootstrap');

window.Vue = require('vue');

import Player from "./components/player/Player.vue";
import Header from './components/header/Header.vue'
import Footer from './components/footer/Footer.vue';
import Playlist from "./components/playlist/Playlist.vue";


Vue.component("header-component", Header);
Vue.component("footer-component", Footer);
Vue.component("player-component", Player);
Vue.component("playlist-component", Playlist);

// TODO make serverside rendering of components

const app = new Vue({
    el: "#app",
});


app.$refs.player.setSong("t8RFcWCWkcI");
