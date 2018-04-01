<template>
    <div class="playlist-list">
        <div class="playlist"  
            v-for="playlist in playlists">
                <div class="details">
                    <img class="artwork" alt="Artwork"
                        v-bind:src="playlist.artwork">
                    <div class="name">{{playlist.name}}</div>
                    <div class="description">{{playlist.description}}</div>
                </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["playlists"],
        data () {
            return {
                playlists: [],
            }
        }

    };
</script>
