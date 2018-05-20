<template>
    <div class="player-container grid grid-half">
        <div class="player grid grid-wide grid-col">

            <div class="song-playing sm-only grid grid-wide grid-center">
                <span>Ka$cade</span> - <span>Animals As Leaders</span>
            </div>
            <div class="grid grid-wide grid-top">
                <div class="grid grid-full grid-col">
                <div class="grid grid-col grid-left playtime">
                    <div class="progress-container grid">
                        <div class="song-progress-wrap" v-on:click="setProgress">
                            <div id="song-progress" ref="progress" class="song-progress"></div>
                        </div>

                    </div>
                </div>
                <div class="grid grid-wide grid-xs-center">
                    <div class="volume-container grid width-2 grid-center">
                        <i class="icon btn3 icon-speaker"></i>
                        <div class="volume-progress-wrap" v-on:click="setVolume">
                            <div id="volume" ref="volume" class="volume-progress"></div>
                        </div>
                    </div>

                    <div class="controls grid width-2 grid-right">
                        <span class="btn skip-btn">
                            <i class="icon btn4 btn  icon-forward"></i>
                        </span>

                        <span class="btn play-btn" v-on:click="play" v-bind:class="{hide: isPlaying}">
                            <i class="icon btn3 btn icon-play-button"></i>
                        </span>

                        <span class="btn pause-btn" v-on:click="pause" v-bind:class="{hide: !isPlaying}">
                            <i class="icon btn btn3 icon-pause"></i>
                        </span>

                        <span class="btn skip-btn" v-on:click="forward">
                            <i class="icon btn4 btn icon-forward2"></i>
                        </span>
                    </div>
                </div>
                </div>
                    <div class="duration grid- grid-height">
                        <span>{{progress}}</span>
                    </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        props: ["songurls"],

        data () {
            return {
                player: null,
                isPlaying: false,
                progressBar: null,
                playerProgress: 0,
                progressTicker: null,
                playingid:0
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
            },

        },

        methods: {
            initializeProgressBars () {
                this.progressBar = new ProgressBar.Line("#song-progress", {
                    color: "#212121",
                });
                this.volumeBar = new ProgressBar.Line("#volume", {
                    color: "#212121",
                });
            },

            initializePlayer () {
                let self = this;
                console.log(this.songurls);
                let arr = JSON.parse(self.songurls);
                this.player = new Howl({
                    src: arr,
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

                this.playingid = this.player.play();
                this.isPlaying = true;
                this.tickProgress();
            },

            forward (){
                if (this.player.playing())
                    this.player.stop();
                    this.isPlaying = false;
                console.log(this.playingid);
                this.playingid++;
                console.log(this.playingid);
                this.player.play(this.playingid);
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
                    start = bar.left,
                    width = bar.width,
                    x = event.clientX - start;
                let relative = x / width;
                this.player.volume(Math.abs(relative));
                this.volumeBar.set(relative);
            }

        }
    }
</script>
