<template>
    <div class="player-container grid grid-half">
        <div class="player grid grid-wide grid-col">
            <div class="song-playing  grid grid-wide grid-center">
                <span>{{playingname}}</span>{{playingartist}} <span></span>
            </div>
            <div class="grid grid-wide grid-top" v-if="hasData">
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

                    <div class="controls grid width-2 grid-right" >
                        <span class="btn skip-btn" v-on:click="skip('prev')">
                            <i class="icon btn4 btn  icon-forward"></i>
                        </span>
                        <span class="btn play-btn" v-on:click="play(playingid)" v-bind:class="{hide: isPlaying}">
                            <i class="icon btn3 btn icon-play-button"></i>
                        </span>

                        <span class="btn pause-btn" v-on:click="pause" v-bind:class="{hide: !isPlaying}">
                            <i class="icon btn btn3 icon-pause"></i>
                        </span>

                        <span class="btn skip-btn" v-on:click="skip('forward')">
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
                playingid:0,
                songarr:null,
                playingname:null,
                playingartist:null,
                hasData:true
            }
        },

        mounted () {
            this.initVars();
            if(this.hasData){
                this.initializeProgressBars();
                this.initializePlayer();
            }

            this.$root.$on('song-selected', id => {
                var playr = this.songarr[this.playingid].howl;
                if(playr){
                    playr.stop();
                    this.tickProgress();
                }
                this.playingid = id;
                this.skipTo(this.playingid);
            });
        },

        computed: {
            aname(){
                return this.songarr.length>0 ? this.songarr[this.playingid].artist : 'z';
            },
            sname(){
                return this.songarr.length>0 ? this.songarr[this.playingid].name : 'z';
            },
            converteda(){
                return JSON.parse(this.songurls);
            },
            progress () {
                return moment.duration(this.playerProgress, "seconds").format("mm:ss", {trim: false}); 
            },
            name(){
                return this.songurls[0]["name"];
            },
            fullDuration () {
                if (this.player == null || this.player.duration() == 0)
                    return "00:00";
                return moment.duration(this.player.duration(), "seconds").format("mm:ss", {trim: false});
            },
            geturls(){
                if(this.songarr.length>0){
                    let urls = [];
                    for(var i=0;i<this.songarr.length;i++){
                        urls.push(this.songarr[i]["url"]);
                    }
                return urls;
                }
                return [];
            }
        },

        methods: {
            initVars(){
                this.songarr = this.converteda;
                if(this.songarr.length<1){
                    this.hasData = false;
                }
                else{
                    console.log('names');
                    this.playingname = this.sname;
                    this.playingartist = this.aname;
                }
            },
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
                this.isvalid = true;
                this.songarr[0].howl = new Howl({
                    src: this.songarr[0].url,
                     onend: function() {
                        self.skip('right');
                    }
                });
                this.playingid = 0;
                this.volumeBar.set(this.songarr[0].howl.volume());
                
            },

            tickProgress () {
                let self = this;
                clearInterval(this.progressTicker);
                this.progressTicker = setInterval(function () {
                    if (self.songarr[self.playingid].howl != null) {
                        self.playerProgress = self.songarr[self.playingid].howl.seek();
                        self.progressBar.set(self.playerProgress / self.songarr[self.playingid].howl.duration());
                    }
                }, 500);
            },

            play (index) {
                var data = this.songarr[index];
                var sound = null;
                 if (data.howl) {
                    sound = data.howl;
                } else {
                    sound = data.howl = new Howl({
                        src: [data.url],
                        html5: true, // Force to HTML5 so that the audio can stream in (best for large files).
                    });
                    }

                    // Begin playing the sound.
                sound.play();
                this.isPlaying = true;
                this.playingid = index;
                this.playingname = this.songarr[this.playingid]["name"];
                this.playingartist = this.songarr[this.playingid]["artist"];
                this.tickProgress();
            },

             skip: function(direction) {
                var index = 0;
                if (direction === 'prev') {
                index = this.playingid - 1;
                if (index < 0) {
                    index = this.songarr.length - 1;
                }
                } else {
                index = this.playingid + 1;
                if (index >= this.songarr.length) {
                    index = 0;
                }
                }
                this.skipTo(index);
            },

              skipTo: function(index) {
                    var player = this.songarr[this.playingid].howl;
                    if (player) {
                        player.stop();
                        this.isPlaying = false;
                    }
                     this.progressBar.set(0);
                     this.play(index);
                },

            pause () {
                if (!this.songarr[this.playingid].howl.playing())
                    return;
                clearInterval(this.progressTicker);
                this.songarr[this.playingid].howl.pause();
                this.isPlaying = false;
            },

            setProgress (event) {
                let bar = this.$refs.progress.getBoundingClientRect(),
                    start = bar.left,
                    width = bar.width,
                    x = event.clientX - start;
                let relative = x / width;
                var player = this.songarr[this.playingid].howl;
                player.seek(player.duration() * relative);
                this.progressBar.set(relative);
            },
            
            setVolume (event) {
                let bar = this.$refs.volume.getBoundingClientRect(),
                    start = bar.left,
                    width = bar.width,
                    x = event.clientX - start;
                let relative = x / width;
                var player = this.songarr[this.playingid].howl;
                player.volume(Math.abs(relative));
                this.volumeBar.set(relative);
            }
        }
        }
   
</script>
