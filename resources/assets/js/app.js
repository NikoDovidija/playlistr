 

require('./bootstrap');

window.Vue = require('vue');

import Player from "./components/player/Player.vue";

Vue.component("player-component", Player);

// TODO make serverside rendering of components

const app = new Vue({
    el: "#app",
})

// will remove and make same logic as player
require("./partials/header");
require("./partials/footer");



app.$refs.player.setSong("Song 2");
