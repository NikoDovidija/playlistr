<template>
  <div class="playlist">

      <div class="heading" v-bind:style="{ backgroundImage: 'url(' + artwork + ')'  }">
        <div class="details">
            <div class="play btn">
                <i class="material-icons">play_arrow</i>
            </div>
            <div class="item">
                <div class="name">{{name}}</div>
                <div class="creator">by Jost Gombac</div>
            </div>
            <div class="item">
                <div class="duration">{{fullDuration}}</div>
            </div>
            <div class="item song-list-container">
                <div class="song-list short">
                    <div class="song-name" v-for="song in shortSongList">
                        {{song.name}}
                    </div>
                </div>
                <div class="song-list full">
                    <div class="song-name" v-for="song in songs">
                        {{song.name}}
                    </div>
                </div>

            </div>
        </div>

        <div class="playlist-description">{{description}}</div>
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

        }
    }
</script>
