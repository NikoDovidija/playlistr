<template>
    <div class="swiper-slide grid grid-full">
        <div v-for='x in 3' class="playlist-item grid grid-col grid-third">
            <div class="imageHolder grid grid-col">
                <img src="/images/intervalsalbum.jpg" alt="slideImage"/>
                <div class="playButton" @click="detachAll">
                          <span class="grid grid-item grid-center">
                            <i class="icon btn bt2">play_arrow</i>
                        </span>
                </div>
            </div>
            <div class="titleHolder grid grid-col">
                <div class="playlistTitle">
                    <p><b>Progressive metal playlist</b></p>
                </div>      
            </div>
             <div class="authorHolder grid grid-col">
                <div class="authorTitle">
                    by John Pretruccio
                </div>  
            </div>
            <div class="socialHolder grid grid-col">
                 <div class="grid">
                    <div class="grid grid-item grid-left grid-even">
                        <span class="grid grid-item iconsHolder">
                            <i class="icon btn bt2 icon-play-button"></i>
                            512
                        </span>
                    </div>
                     <div class="grid grid-item grid-center grid-even">
                        <span class="grid grid-item iconsHolder">
                            <i class="icon btn bt2 icon-like"></i>
                            62
                        </span>
                    </div>
                     <div class="grid grid-item grid-right grid-even">
                            <span class="grid grid-item iconsHolder">
                            <i class="icon btn bt2 icon-share">share</i>
                            28
                        </span>
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
            }
        },
        methods: {
            detachAll() {
                let playlists = $(".playlist-item").detach();
                console.log(playlists);
            }
        }
    }
</script>
