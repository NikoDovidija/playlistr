<template>
    <div class="song-list-container grid grid-full grid-center">

        <div class="song-list swiper-container">
            <div class="fade fade-top"></div>
            <div class="swiper-wrapper">
                <div class="song swiper-slide" v-for="(song, index) in songs " :key="index" @click="setSong(index)">
                    <span class="song-name">{{song.name}}</span>
                    <span class="song-artist">
                        {{song.artist}}
                        <span class="song-options">
                            <i class="icon btn4 btn icon-more"></i>
                        </span>
                    </span>
                </div>
            </div>
            <div class="fade fade-bottom"></div>
        </div>

    </div>
</template>

<script>
    export default {
        props: [''],
        data () {
            return {
                songs: [],
                currentSong: 3,
                swiper: null,
            }
        },

        mounted () {
            this.initSwiper();
        },

        watch: {
            songs: function (val, oldVal) {
                setTimeout(this.initSwiper, 0);                
            }
        },

        computed: {

        },

        methods: {

            setSong (index) {
                this.currentSong = index;
                this.swiper.slideTo(index, 100, true);
            },
            // updateSlide(){
            //     if (this.swiper != null) {
            //         this.swiper.update();
            //     }
            // },
            initSwiper () {
                let self = this;
                this.swiper = new Swiper(".swiper-container", {
                    direction: "vertical",
                    initialSlide: self.currentSong,
                    centeredSlides: true,
                    slidesPerView: 9,
                    spaceBetween: 0,
                    grabCursor: true,
                    watchSlidesVisibility: true,
                    mousewheelControl: true,
                    freeModeSticky: true,
                    onTransitionStart: function () {
                        $(".swiper-slide").removeClass("swiper-slide-edge");
                        $(".swiper-slide-prev").prev().addClass("swiper-slide-edge");
                        $(".swiper-slide-next").next().addClass("swiper-slide-edge");
                    },
                });
            },
        }

    }
</script>
