<template>
    <div id="player" class="player">
        {{ id }}
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
                duration: 180,
                playtime: 0,
                playtimeRelative: 0,
            }
        },
        created () {

        },
        methods: {
            setSong (id) {
                console.log("id set: ", id);
                this.id = id;
            },

            play () {
                this.isPlaying = true;
                this.tickPlaytime();
            },

            pause () {
                this.isPlaying = false;
            },

            setPlaytime (event) {
                let bar = this.$refs.bar.getBoundingClientRect(),
                    start = bar.left,
                    width = bar.width,
                    x = event.clientX - start;
                let relative = x / width;
                this.playtime = this.duration * relative;
            },

            songCompleted () {
                this.isPlaying = false;
                this.playtime = 0;
            },

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
            }
        }
    }
</script>