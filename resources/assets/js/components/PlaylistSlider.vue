<template>
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <div class="swiper-slide grid grid-even" v-for="slide in slides()">
                <div v-for="(playlist, index) in slide" class="playlist-item grid grid-col" v-bind:class="getItemWidth()">


                    <div class="imageHolder grid">
                        <img src="/images/intervalsalbum.jpg" alt="slideImage"/>
                        <div class="playButton">
                            <span class="grid grid-center grid-full">
                                <i class="icon-play3 btn bt2"></i>
                            </span>
                        </div>
                    </div>
                    <div class="titleHolder grid">
                        <div class="playlistTitle">
                            <p><b>Progressive metal playlist</b></p>
                        </div>      
                    </div>
                    <div class="authorHolder grid">
                        <div class="authorTitle">
                            by John Pretruccio
                        </div>  
                    </div>
                    <div class="socialHolder grid grid-wide grid-even">

                                <div class="grid iconsHolder">
                                    <i class="icon-play-button btn bt2"></i>
                                    <span>512</span>
                                </div>


                                <div class="grid grid-item iconsHolder">
                                    <i class="icon-like btn bt2"></i>
                                    <span>62</span>
                                </div>


                                <div class="grid grid-item iconsHolder">
                                    <i class="icon-share btn bt2"></i>
                                    <span>28</span>
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
        props: [],
        data () {
            return {
                swiper: null,
                numberslides: null,
                playlists: [],
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
              initSwiper () {
                var ww_temp = $(window).width();
                let self = this;   
                this.swiper = new Swiper(".swiper-container", {
                    direction: "vertical",
                    centeredSlides: true,
                    grabCursor: true,
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
