require('./bootstrap');
require('moment-duration-format');
require('./modal.js');
window.ProgressBar = require("progressbar.js");
window.Vue = require('vue');
window.Howler = require("howler");
import Swiper from "swiper/dist/js/swiper.min.js";

import AddPlaylist from "./components/AddPlaylist.vue";
import SearchPlaylist from "./components/SearchPlaylist";
import Header from "./components/Header.vue";
import TopNav from "./components/TopNavigation.vue";
import Player from "./components/Player.vue";
import Record from "./components/RecordPlayer.vue";
import Playlist from "./components/Playlist.vue";
import Modal from "./components/Modal.vue";
import List from "./components/List.vue";
import ScrollList from "./components/ScrollList.vue";
import PlaylistSlider from "./components/PlaylistSlider.vue";
import FileUpload from 'v-file-upload';
//import Comments from "./components/Comments.vue";
import Comments from "./components/Comments.vue";
import PostComment from "./components/PostComment.vue";
Vue.component("c-file-up",FileUpload);
Vue.component("c-search-playlist",SearchPlaylist);
Vue.component("c-add-playlist",AddPlaylist);
Vue.component("c-modal",Modal);
Vue.component("c-header", Header);
Vue.component("c-top-nav", TopNav);
Vue.component("c-player", Player);
Vue.component("c-record", Record);
Vue.component("c-playlist", Playlist);
Vue.component("c-list", List);
Vue.component("c-scroll-list", ScrollList);
Vue.component("c-playlist-slider",PlaylistSlider);
Vue.component("c-comments", Comments);
Vue.component("c-post-comment", PostComment);

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
            //this.dataLoaded();
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
        },

        dataLoaded () {

        }
    }
});

const app = new Vue({
    el: "#app",
});

$(".m-drawer-btn").on("click", function () {
    $(".m-drawer").toggleClass("active");
});

$(".comment-btn").on("click", function () {
    $(this).addClass("hide");
    $(".playlist-btn").removeClass("hide");
    $(".song-list-container").addClass("hide");
    $(".comments-wrap").removeClass("hide");
    $(".post-comment").removeClass("hide");
});

$(".playlist-btn").on("click", function () {
    $(this).addClass("hide");
    $(".comment-btn").removeClass("hide");
    $(".song-list-container").removeClass("hide");
    $(".comments-wrap").addClass("hide");
    $(".post-comment").addClass("hide");
});