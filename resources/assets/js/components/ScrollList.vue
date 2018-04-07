<template>
  <div class="scroll-container">
      <div class="heading">
          {{heading}}
      </div>
      <div class="body grid grid-wrap">
          <div class="item" v-for="playlist in topThree">
              <div class="image-container">
                  <div class="blur"></div>
                  <img v-bind:src="playlist.artwork" alt="">
              </div>
              <div class="details">
                  <div class="name">{{playlist.name}}</div>
                  <div class="description">{{playlist.description}}</div>
              </div>
          </div>
      </div>
  </div>
</template>

<script>
    export default {
        props: ["heading"],
        data () {
            return {
                playlists: []
            }
        },

        computed: {
            topThree () {
                return this.playlists.slice(0, 3);
            }
        }
    }
</script>
