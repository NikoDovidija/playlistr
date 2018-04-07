<template>
    <div class="list-container">
        <div class="list grid grid-col">
            <div class="list-heading">
                {{heading}}
            </div>
            <div class="list-body grid grid-col">
                <div class="item grid" v-for="playlist in playlists">
                    <a class="grid" v-bind:href="playlist.playlist_id">
                        <span>{{playlist.name}}</span>
                        <span class="time">{{formatTime(playlist.created_at)}}</span>
                    </a>
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
                playlists: [],
            }
        },
        methods: {
            formatTime (time) {
                return moment(time, "YYYY-MM-DD hh:mm:ss").fromNow();
            }
        }
    }
</script>
