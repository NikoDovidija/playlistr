<template>
   <div class="comments-wrap grid grid-full grid-center hide">

        <div class="comments-container swiper-container grid grid-full">
            <div class="fade fade-top"></div>
            <div class="swiper-wrapper">
                <div class="comment swiper-slide" v-for="(comment) in comments" :key="comment.comment_id">
                    <div class="comment-wrapper grid grid-left grid-wide">
                        <div class="grid grid-col grid-even">
                            <span>
                                <i class="icon-chevron-up btn"></i>
                            </span>
                            <span>
                                12
                            </span>
                            <span>
                                <i class="icon-chevron-down btn"></i>
                            </span>
                        </div>

                        <div class="comment-body grid grid-col grid-full">

                            <div class="grid grid-wide">
                                <div>
                                    <span class="comment-author">
                                        {{ comment.author }}
                                    </span>

                                    <span class="comment-time">
                                        {{ formatTime(comment.created_at) }}
                                    </span>
                                </div>
                                <span class="comment-reply" v-on:click="replyTo(comment.comment_id)">
                                    <i class="icon-undo2 btn"></i>
                                </span>
                            </div>

                            <div class="comment-text grid grid-wide">
                                {{ comment.text }}
                            </div>


                        </div>
                    </div>

                    <div class="reply" v-for="(reply,index) in comment.responses" :key="index">
                        <div class="comment-wrapper grid grid-left grid-wide">
                        <div class="grid grid-col grid-even">
                            <span>
                                <i class="icon-chevron-up btn"></i>
                            </span>
                            <span>
                                12
                            </span>
                            <span>
                                <i class="icon-chevron-down btn"></i>
                            </span>
                        </div>

                        <div class="comment-body grid grid-col grid-full">

                            <div class="grid grid-wide">
                                <div>
                                    <span class="comment-author">
                                        {{ reply.author }}
                                    </span>

                                    <span class="comment-time">
                                        {{ formatTime(reply.created_at) }}
                                    </span>
                                </div>
                            </div>

                            <div class="comment-text grid grid-wide">
                                {{ reply.text }}
                            </div>


                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
            <div class="fade fade-bottom"></div>
        </div>

    </div>
</template>

<script>
///Applications/MAMP/htdocs/oo-playlistr/resources/assets/js/event-bus.js
    export default {
        
        data () {
            return {
                slider: null,
                comments: []
            }
        },

        mounted () {
            this.initSlider();
        },

        methods: {
            replyTo(id){
                this.$root.$emit('comment-response', id);
            },

            initSlider () {
                this.slider = new Swiper(".comments-container", {
                    direction: "vertical",
                    slidesPerView: "auto",
                    spaceBetween: 0,
                    watchSlidesVisibility: true,
                    mousewheelControl: true,
                    freeModeSticky: true,
                });
            },

            formatTime(time) {
                return moment(time, "YYYY-MM-DD hh:mm:ss").fromNow();
            },

        }
    }
</script>
