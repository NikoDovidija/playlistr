<template>
  <div class="playlist">

      <div class="heading" v-bind:style="{ backgroundImage: 'url(' + artwork + ')'  }">
       <div>
        <div class="details">
            
            <div class="details-column">
                <div class="play btn" v-on:click="playPlaylist">
                    <i class="material-icons">play_arrow</i>
                </div>
                <div class="item">
                    <div class="name">{{name}}</div>
                    <div class="creator">by Jost Gombac</div>
                </div>
            </div>
            
            <div class="details-column">
                <div class="item">
                    <div class="duration">{{fullDuration}}</div>
                </div>
                <div class="item song-list-container">
                    <div class="song-list" v-bind:class="{short: songs.length > 3}">
                        <div class="song-name" v-for="(song, index) in shortSongList">
                            {{ index + 1 }}. {{ song.name }}
                        </div>
                    </div>
                    <div v-if="songs.length > 3">
                        <div class="song-list full">
                            <div class="song-name" v-for="(song, index) in songs">
                                {{ index + 1 }}. {{song.name}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
<div class="playlist-description">
        <div class="width-limiter">
        {{description}}
        </div>
        </div>
      </div>


  </div>
</template>

<script>
    export default {
        data () {
            return {
                playlist_id: "",
                name: "",
                description: "",
                artwork: "",
                songs: [],
                comments: [],
                created_at: "",
                updated_at: "",
            }
        },

        mounted () {
            //this.$parent.$refs.player.setPlaylist(this.$data, 0);
        },

        computed: {
            
            /* 
            returns formatted duration of playlist
            */
            fullDuration () {
                let duration = 0;
                this.songs.forEach(s => {
                    duration += s.duration;
                });
                return moment.duration(duration, "seconds").format("h [hours] mm [minutes] ss [seconds]");
            },

            /* 
            returns a slice of playlist
            */
            shortSongList () {
                return this.songs.slice(0, 3);
            }

        },

        methods: {

            playPlaylist () {
                console.log(this.$data);
                this.$emit('setPlaylist', this.$data);
            }

        }
    }
</script>
