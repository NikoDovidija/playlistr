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
            }
        },
        mounted(){
            this.initSwiper();
        },
        methods: {
              initSwiper () {
                let self = this;
                this.swiper = new Swiper(".swiper-container", {
                    slidesPerView: 3,
                    loop: true,
                    spaceBetween: 15,
                    initialSlide: 2,
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                });

        }
        },  
    }
</script>
