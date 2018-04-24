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
                    });  
 
                this.swiper.update();   
                $(window).on("resize", function () {
                    var ww = $(window).width();
                    if (ww>1000) self.swiper.params.slidesPerView = 5;
                    if (ww>724 && ww<=1000) self.swiper.params.slidesPerView = 3;
                    if (ww>468 && ww<=724) self.swiper.params.slidesPerView = 2;
                    if (ww<=468) self.swiper.params.slidesPerView = 1;
                    self.swiper.update();
                });    
        }
        
        },  
    }
</script>
