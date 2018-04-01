<template>
    <div id="player" class="player">

        <div id="ytplayer" class="hide"></div>
        <div class="playtime">
            <div class="bar"
                ref="bar"
                @click="setPlaytime"></div>
            <div class="bar current" 
                v-bind:style="{ width: (playtimeRelative * 100) + '%', }"
                @click="setPlaytime"></div>
            <div class="bar-cursor" 
                v-bind:style="{ right: ((1 - playtimeRelative) * 100) + '%' }"
                ></div>
        </div>
        <div class="controls">

            <span class="control" 
                    v-bind:class="{ hide: isPlaying }"
                    v-on:click="play">
                <i class="material-icons">play_arrow</i>
            </span>
            <span class="control" 
                    v-bind:class="{ hide: !isPlaying }"
                    v-on:click="pause">
                <i class="material-icons">pause</i>
            </span>
            <span class="control">
                <i class="material-icons">skip_next</i>
            </span>
        </div>
    </div>
</template>

<script>
    export default {

        data () {
            return {
                id: "Song-id-1",
                isPlaying: false,
                pendingSong: false,
                pendingPlay: false,
                duration: 180,
                playtime: 0,
                playtimeRelative: 0,
                yt: {
                    player: null,
                    ready: false,
                }
            }
        },

        created () {
            let self = this;

            $(window).on("load", function () {
                self.loadYtPlayer();
            });
        },

        mounted () {

        },

        methods: {
            /* 
            loads the video into Youtube player
            */
            setSong (id) {
                // if id is not passed keep the previous one
                if (id != undefined) {
                    this.id = id;
                }
                // don't load the song if player isn't ready. Set it pending to set it when player is ready
                if (!this.yt.ready) {
                    this.pendingSong = true;
                    return;
                }
                // if song doesn't have id dont do anything
                if (this.id == undefined || this.id.length < 1) {
                    return;
                }
                // load video and stop it from autoplay
                this.yt.player.loadVideoById(this.id);
                this.yt.player.stopVideo();
            },

            /* 
            plays/resumes both players
            */
            play () {
                // if player is not ready, set pendingPlay to start as soon as it's ready
                if (!this.yt.ready) {
                    this.pendingPlay = true;
                    return;
                }
                // start playing video in Youtube player
                this.yt.player.playVideo();
                // sync player playtimes
                this.yt.player.seekTo(this.playtime);
                // set song duration to display proper playtime bar
                this.setDuration();
                this.isPlaying = true;
                // start counting playtime
                this.tickPlaytime();
            },

            /* 
            pauses both players
            */
            pause () {
                this.yt.player.pauseVideo();
                this.isPlaying = false;
            },

            /* 
            syncs local duration to Youtubes
            */
            setDuration () {
                let self = this;
                let durationTicker = setInterval(function () {
                    let duration = self.yt.player.getDuration();
                    console.log(duration);
                    if (duration != undefined && duration > 0) {
                        self.duration = duration;
                        clearInterval(durationTicker);
                    }
                }, 100);
            },

            /* 
            sets bar display
            sets Youtube player playtime
            */
            setPlaytime (event) {
                let bar = this.$refs.bar.getBoundingClientRect(),
                    start = bar.left,
                    width = bar.width,
                    x = event.clientX - start;
                let relative = x / width;
                this.playtime = this.duration * relative;
                this.playtimeRelative = this.playtime / this.duration;

                if (this.isPlaying) {
                    this.yt.player.seekTo(this.playtime);
                }
            },

            /* 
            stops and resets the player
            */
            songCompleted () {
                this.isPlaying = false;
                this.playtime = 0;
            },

            /* 
            updates playtime
            updates playtime bar
            */
            tickPlaytime () {
                let self = this;
                if (!this.isPlaying) {
                    return;
                }
                this.playtime = this.playtime + 0.2;
                this.playtimeRelative = this.playtime / this.duration;

                if (this.playtime >= this.duration) {
                    this.songCompleted();
                }

                setTimeout(function () {
                    self.tickPlaytime();
                }, 200);
            },

            /* 
            after scripts are loaded, replace placeholder DOM with youtube iframe
            call onYtPlayerReady when done 
            */
            loadYtPlayer () {
                let self = this;
                if (this.yt.ready) {
                    return;
                }
                this.yt.player = new YT.Player("ytplayer", {
                    events: {
                        "onReady": function () { self.onYtPlayerReady(); },
                    }
                });
            },

            /* 
            load song to Youtube player if pending
            start playing if play is pending
            */
            onYtPlayerReady () {
                console.log("player ready");
                this.yt.ready = true;
                if (this.pendingSong) {
                    this.pendingSong = false;
                    this.setSong();
                }
                if (this.pendingPlay) {
                    this.pendingPlay = false;
                    this.play();
                }
            }
        }
    }
</script>