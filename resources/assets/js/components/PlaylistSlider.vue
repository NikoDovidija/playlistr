<template>
    <div class="swipecomponent grid grid-wide grid-wrap grid-center">
        <div class="button-holder grid grid-item" v-if="profile==0">
              <button
                    v-for="tab in tabs"
                    v-bind:key="tab"
                    v-bind:class="['tab-button', { active: currentTab === tab }]"
                    v-on:click="callto(tab)"
                    id="cat-button"
                >{{ tab }}
                </button>
        </div>
    <div class="swiper-container grid grid-item grid-wide ">
        <c-modal v-on:test="parentHandler" id="add-playlist"></c-modal>
        <div class="swiper-wrapper">
            <div class="swiper-slide grid grid-even" v-for="(slide,index) in slides()" :key="index">
                <div v-for="(playlist,index) in slide" class="playlist-item grid grid-col" v-bind:class="getItemWidth()" :key="index" >
                    <div class="imageHolder grid" v-on:click="redirectTo(playlist.playlist_id)">
                        <img :src="playlist.url" alt="slideImage"/>
                        <div class="playButton">
                            <span class="grid grid-center grid-full">
                                <i class="icon-play3 btn bt2"></i>
                            </span>
                        </div>
                    </div>
                    <div class="titleHolder grid">
                        <div class="playlistTitle">
                            <p><b>{{playlist.name}}</b></p>
                        </div>      
                    </div>
                    <div class="authorHolder grid">
                        <div class="authorTitle">
                             <p>{{playlist.user_id}}</p>
                        </div>  
                    </div>
                    <div class="socialHolder grid grid-wide grid-even">
                        <div class="grid iconsHolder">
                            <i class="icon-play-button btn bt2"></i>
                                <span>{{playlist.times_played}}</span>
                        </div>
                        <div class="grid grid-item iconsHolder">
                            <i class="icon-like btn bt2"></i>
                                <span>{{playlist.favourites}}</span>
                        </div>
                        <div class="grid grid-item iconsHolder">
                            <i class="icon-share btn bt2"></i>
                                <span>{{playlist.times_recommended}}</span>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</template>

<script>

    export default {
        props:['profile'],
        data () {
            return {
                swiper: null,
                numberslides: null,
                display: true,
                playlists:[],
                tabs:["All","Recommended","Most liked"],
                currentTab:'',
                previousTab:'',
                
            }
        },
        mounted () {
        this.initSwiper();
        },
        computed: {

        },
        updated () {
            this.$nextTick(function () {
                if (this.swiper != null) {
                    this.swiper.update();
                }
            });
        },
        methods: {
                callto(tab){
                    this.previousTab = this.currentTab;
                    this.currentTab = tab;
                    console.log("blup");
                    if(this.previousTab != this.currentTab){
                        this.fetchPlaylists(this.currentTab);
                    }

                },
                fetchPlaylists(tab){
                    var self= this;
                    var getRequest = null;
                    switch(tab){
                        case "All":
                        getRequest = axios.get('api/');
                        break;
                        case "Recommended":
                        getRequest = axios.get('api/recommended');
                        break;
                        case "Most liked": 
                        getRequest = axios.get('api/mostfavourite');
                        break;   
                    }
                    getRequest.then(function (response) {
                        self.playlists = response.data["playlists"];
                         if (self.swiper != null) {
                            self.swiper.update();
                            self.swiper.slideTo(0, 500, false);
                        }
                        })
                        .catch(function (error) {
                            console.log(error)
                        })    
                          
                },
                redirectTo(id){
                    //this.swiper.destroy();
                   window.location.href = '/playlists/'+id;
                },
                parentHandler(data){
                    this.playlists.push(data);
                },
              initSwiper () {
                var ww_temp = $(window).width();
                let self = this;   
                this.swiper = new Swiper(".swiper-container", {
                    direction: "vertical",
                    centeredSlides: true,
                    watchSlidesVisibility: true,
                    mousewheelControl: true,
                    freeModeSticky: true,
                });  

                $(window).on("resize", function () {
                    let currentPlaylists = self.playlists;
                    self.playlists = [];
                    self.playlists = currentPlaylists;
                });
            },

            getItemWidth () {
                let numItems = this.getNumItems();
                return "width-" + numItems;
            },

            getNumItems () {
                let numItems = 1;
                let width = $(window).width();
                if (width > 468) numItems = 2;
                if (width > 720) numItems = 3;
                if (width > 1000) numItems = 4;
                if (width > 1200) numItems = 5;
                return numItems;
            },
            slides () {
                let numItems = this.getNumItems();
                var slides = [];
                var i = 0;
                var currentSlide = [];
                for (var x = 0; x < this.playlists.length; x++) {
                    currentSlide.push(this.playlists[x]);
                    i++;
                    if (i >= numItems) {
                        slides.push(currentSlide);
                        currentSlide = [];
                        i = 0;
                    }
                }
                if (currentSlide.length > 0) {
                    slides.push(currentSlide);
                }
                return slides;
            }

        },  
    }
</script>
