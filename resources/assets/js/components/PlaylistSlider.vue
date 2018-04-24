<template>
    <div class="swiper-container">
    <!-- Additional required wrapper -->
    <div class="swiper-wrapper">
        <!-- Slides -->
      <c-slider-slide></c-slider-slide>
      <c-slider-slide></c-slider-slide>
      <c-slider-slide></c-slider-slide>
      <c-slider-slide></c-slider-slide>
      <c-slider-slide></c-slider-slide>

    </div>
     <div class="swiper-pagination"></div>
</div>
</template>

<script>

    export default {
        props: [],
        data () {
            return {
                swiper: null,
                numberslides:null
            }
        },
        mounted(){
            this.initSwiper();
        },
        methods: {
              initSwiper () {
                var ww_temp = $(window).width();
                let self = this;   
                if (ww_temp>1000) this.numberslides = 5;
                if (ww_temp>724 && ww_temp<=1000) this.numberslides = 3;
                if (ww_temp>468 && ww_temp<=724) this.numberslides = 2;
                if (ww_temp<=468) this.numberslides = 1; 
                this.swiper = new Swiper(".swiper-container", {
                    slidesPerView: self.numberslides,
                    initialSlide: 2,
                    centeredSlides: true,
                    breakpoints: {
                        // when window width is <= 320px
                        5200: {
                        slidesPerView: 5,
                        spaceBetween: 25
                        },
                        1500: {
                        slidesPerView: 4,
                        spaceBetween: 25
                        },
                        1000: {
                        slidesPerView: 3,
                        spaceBetween: 10
                        },
                        // when window width is <= 480px
                        724: {
                        slidesPerView: 2,
                        spaceBetween: 15
                        },
                        // when window width is <= 640px
                        468: {
                        slidesPerView: 1,
                        spaceBetween: 15
                        }
                    }
                    });  
        
        }
        
        },  
    }
</script>
