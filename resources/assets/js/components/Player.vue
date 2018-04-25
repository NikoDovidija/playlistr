<template>
    <div class="player-container grid grid-half">
        <div class="player grid grid-wide grid-col">

            <div class="song-playing sm-only grid grid-wide grid-center">
                <span>Ka$cade</span> - <span>Animals As Leaders</span>
            </div>

            <div class="grid grid-col grid-left playtime">
                <div class="progress-container grid">
                    <div class="song-progress-wrap" v-on:click="setProgress">
                        <div id="song-progress" ref="progress" class="song-progress"></div>
                    </div>
                    <div class="duration">
                        <span>{{progress}}</span>
                    </div>
                </div>
            </div>

            <div class="grid">

                <div class="volume-container grid">
                    <i class="icon">volume_up</i>
                    <div class="volume-progress-wrap" v-on:click="setVolume">
                        <div id="volume" ref="volume" class="volume-progress"></div>
                    </div>
                </div>

                <div class="controls grid grid-full grid-center">
                    <span class="btn skip-btn">
                        <i class="icon btn">skip_previous</i>
                    </span>

                    <span class="btn play-btn" v-on:click="play" v-bind:class="{hide: isPlaying}">
                        <i class="icon btn">play_arrow</i>
                    </span>

                    <span class="btn pause-btn" v-on:click="pause" v-bind:class="{hide: !isPlaying}">
                        <i class="icon btn">pause</i>
                    </span>

                    <span class="btn skip-btn">
                        <i class="icon btn">skip_next</i>
                    </span>
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
                    color: "#212121",
                });
                this.volumeBar = new ProgressBar.Line("#volume", {
                    color: "#212121",
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
