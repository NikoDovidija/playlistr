<template>
    <div id="player" class="player">
        {{ id }}
        <div class="playtime">
            <div class="bar"></div>
            <div class="bar current" v-bind:style="{ width: (playtimeRelative * 100) + '%', }"></div>
            <div class="bar-cursor" v-bind:style="{ right: ((1 - playtimeRelative) * 100) + '%' }"></div>
        </div>
        <div class="controls">

            <span class="control" 
                    v-bind:class="{ hide: isPlaying }"
                    v-on:click="isPlaying = !isPlaying">
                <i class="material-icons">play_arrow</i>
            </span>
            <span class="control" 
                    v-bind:class="{ hide: !isPlaying }"
                    v-on:click="isPlaying = !isPlaying">
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
        watch: {
            "playtime": function (val, old) {
                console.log(val, old);
            }
        },
        created () {
            let self = this;
            setInterval(function () {
                self.tickPlaytime();
            }, 200);
        },
        methods: {
            setSong (id) {
                console.log("id set: ", id);
                this.id = id;
            },

            tickPlaytime () {
                this.playtime = this.playtime + 0.2;
                this.playtimeRelative = this.playtime / this.duration;
            }
        }
    }
</script>