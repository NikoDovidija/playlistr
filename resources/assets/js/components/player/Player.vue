<template>
    <div id="player" class="player">

        <div id="ytplayer" class="hide"></div>

        <div class="navigation">
            <div class="previous" v-on:click="goPrevious">
                <span class="name">
                    <i class="material-icons">chevron_left</i>
                    {{previousSong().name}}
                </span>
            </div>
            <div class="next" v-on:click="goNext">
                <span class="name">
                    {{nextSong().name}}
                    <i class="material-icons">chevron_right</i>
                </span>
            </div>
        </div>

        <div class="controls">

            <span class="control btn" 
                    v-bind:class="{ hide: isPlaying }"
                    v-on:click="play">
                <i class="material-icons">play_arrow</i>
            </span>
            <span class="control btn" 
                    v-bind:class="{ hide: !isPlaying }"
                    v-on:click="pause">
                <i class="material-icons">pause</i>
            </span>
            <span class="control btn">
                <i class="material-icons">stop</i>
            </span>
        </div>

        <div class="song-details">
            <div class="credits">
                {{currentSong.artist}} - {{currentSong.name}}  {{currentSong.album}}
            </div>
        </div>

        <div class="playtime">
            <div class="playtime-display">
                <span class="current">{{formattedPlaytime}}</span>
                |
                <span class="overall">{{formattedDuration}}</span>
            </div>
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
    </div>
</template>

<script>
    export default {

        data () {
            return {
                id: "Song-id-1",
                song: 0,
                playlist: {
                    songs: [
                        {
                            name: "",
                            artist: "",
                            album: "",
                        }
                    ]
                },
                isPlaying: false,
                pendingSong: false,
                pendingPlay: false,
                duration: 180,
                playtime: 0,
                playtimeRelative: 0,
                ticker: null,
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

        computed: {
            formattedPlaytime () {
                return moment.duration(this.playtime, "seconds").format(this.playtime >= 3600 ? "hh:mm:ss" : "mm:ss", {trim: false});
            },

            formattedDuration () {
                return moment.duration(this.duration, "seconds").format(this.duration >= 3600 ? "hh:mm:ss" : "mm:ss", {trim: false});
            },

            currentSong () {
                return this.playlist.songs[this.song];
            },

        },

        methods: {
            /* 
            loads the video into Youtube player
            */
            setSong (song) {
                // if id is not passed keep the previous one
                if (song != undefined) {
                    this.id = song.video_id;
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
                // play song if its pending for play
                if (this.pendingPlay) {
                    this.play();
                }
            },

            /*
            sets the playlist and current song
            */
            setPlaylist (playlist, index) {
                this.playlist = playlist;
                if (index == undefined) {
                    index = 0;
                }
                this.setSong(this.playlist.songs[index]);
                this.song = index;
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
                clearInterval(this.ticker);
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
            returns the previous song
            */
            previousSong () {
                // of overshoot to negative set index to last song
                let index = this.song == 0 ? this.playlist.songs.length - 1 : this.song - 1;
                return this.playlist.songs[index];
            },

            /* 
            returns the next song
            */
            nextSong () {
                // if overshoot over song array length, set index to 0
                let index = this.song == this.playlist.songs.length - 1 ? 0 : this.song + 1;
                return this.playlist.songs[index];
            },

            /* 
            plays the previous song
            */
            goPrevious () {
                let previous = this.previousSong();
                this.song = this.playlist.songs.indexOf(previous);
                //reset player
                this.songCompleted();
                // autoplay when song is set
                this.pendingPlay = true;
                this.setSong(previous);
            },

            /* 
            plays the next song
            */
            goNext () {
                let next = this.nextSong();
                this.song = this.playlist.songs.indexOf(next);
                this.songCompleted();
                this.pendingPlay = true;
                this.setSong(next);
            },

            /* 
            syncs local duration to Youtubes
            */
            setDuration () {
                let self = this;
                let durationTicker = setInterval(function () {
                    let duration = self.yt.player.getDuration();
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
                // get positions of progress bar and click
                let bar = this.$refs.bar.getBoundingClientRect(),
                    start = bar.left,
                    width = bar.width,
                    x = event.clientX - start;
                // calculate percentage where useh has clicked relative to progress bar
                let relative = x / width;
                this.playtime = this.duration * relative;
                this.playtimeRelative = this.playtime / this.duration;

                // set Youtube player to this time if it should be playing
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

                this.ticker = setTimeout(function () {
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