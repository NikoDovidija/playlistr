<template>
    <div class="playlists">
        <div class="playlists-header">
            Most played today
        </div>
        <div class="playlist-list">
            <div class="playlist-item"  
                v-for="plist in playlists">
                <a v-bind:href="'/' + plist.playlist_id">
                    <div class="name">{{plist.name}}</div>
                </a>
                <span>{{formatDate(plist.created_at)}}</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ["playlists"],
        methods: {
            formatDate (date) {
                return moment(date, "YYYY-MM-DD hh:mm:ss").fromNow();
            }
        }
    };
</script>
