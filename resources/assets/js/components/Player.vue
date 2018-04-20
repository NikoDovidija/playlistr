<template>
    <div class="player-container">
        <!-- <div class="soundwaves-container">
            <img src="http://www.lgam.info/local-files/wayne-eddy-s-photos-6/Artvo-Shark.jpg" alt="">
           <span class="soundwave" v-bind:class="{active: isPlaying}" v-for="x in 50"></span>
        </div> -->
        <div class="player grid">
            <div class="volume-container">
                <div class="volume-wrap" v-on:click="setVolume">
                    <div id="volume" ref="volume" class="volume"></div>
                </div>
                <i class="icon">volume_up</i>
            </div>



            <div class="controls grid grid-center grid-square">
                <span class="btn btn-circle btn-3 skip-btn">
                    <i class="icon">skip_previous</i>
                </span>

                <span class="btn btn-circle btn-3 play-btn" v-on:click="play" v-bind:class="{hide: isPlaying}">
                    <i class="icon">play_arrow</i>
                </span>

                <span class="btn btn-circle btn-3 pause-btn" v-on:click="pause" v-bind:class="{hide: !isPlaying}">
                    <i class="icon">pause</i>
                </span>

                <span class="btn btn-circle btn-3 skip-btn">
                    <i class="icon">skip_next</i>
                </span>
            </div>

            <div class="grid grid-col grid-left playtime">
                <div class="song-details">
                    <span class="name">Fable</span> - <span class="artist">Intervals</span>
                    <div class="album">The Shape of Colour</div>
                </div>

                <div class="progress-container grid">
                    <div class="song-progress-wrap" v-on:click="setProgress">
                        <div id="song-progress" ref="progress" class="song-progress"></div>
                    </div>
                    <div class="duration">
                        <span>{{progress}}</span> <!--| <span>{{fullDuration}}</span> -->
                    </div>
                </div>
            </div>


        </div>
    </div>
</template>

<script>
    export default {
        props: ["songUrl"],

        data () {
            return {
                player: null,
                isPlaying: false,
                progressBar: null,
                playerProgress: 0,
                progressTicker: null,
            }
        },

        mounted () {
            this.initializeProgressBars();
            this.initializePlayer();
        },

        computed: {
            progress () {
                return moment.duration(this.playerProgress, "seconds").format("mm:ss", {trim: false}); 
            },

            fullDuration () {
                if (this.player == null || this.player.duration() == 0)
                    return "00:00";
                return moment.duration(this.player.duration(), "seconds").format("mm:ss", {trim: false});
            }
        },

        methods: {

            initializeProgressBars () {
                this.progressBar = new ProgressBar.Line("#song-progress", {
                    color: "#e64a19",
                });
                this.volumeBar = new ProgressBar.Line("#volume", {
                    color: "#e64a19",
                    svgStyle: {
                        transform: "rotate(90deg)",
                        width: "100px",
                    }
                });
            },

            initializePlayer () {
                let self = this;
                this.player = new Howl({
                    src: [self.songUrl],
                });
                this.volumeBar.set(this.player.volume());
            },

            tickProgress () {
                let self = this;
                clearInterval(this.progressTicker);
                this.progressTicker = setInterval(function () {
                    if (self.player != null) {
                        self.playerProgress = self.player.seek();
                        self.progressBar.set(self.playerProgress / self.player.duration());
                    }
                }, 500);
            },

            play () {
                if (this.player.playing())
                    return;

                this.player.play();
                this.isPlaying = true;
                this.tickProgress();
            },

            pause () {
                if (!this.player.playing())
                    return;
                clearInterval(this.progressTicker);
                this.player.pause();
                this.isPlaying = false;
            },

            setProgress (event) {
                let bar = this.$refs.progress.getBoundingClientRect(),
                    start = bar.left,
                    width = bar.width,
                    x = event.clientX - start;
                let relative = x / width;
                this.player.seek(this.player.duration() * relative);
                this.progressBar.set(relative);
            },
            
            setVolume (event) {
                let bar = this.$refs.volume.getBoundingClientRect(),
                    start = bar.bottom,
                    height = bar.height,
                    y = event.clientY - start;
                let relative = y / height;
                this.player.volume(Math.abs(relative));
                this.volumeBar.set(relative);
            }

        }
    }
</script>
