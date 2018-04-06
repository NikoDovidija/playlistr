<template>
    <div class="playlist-container grid grid-top">
        <div class="comments grid grid-col grid-left">
            <div class="heading">
                <i class="icon">mode_comment</i> {{numComments}} Comments
            </div>
            <div class="body">
                <div class="comments-container grid grid-col grid-left">
                    <div class="comment grid grid-col grid-left" v-for="comment in comments">
                        <div class="heading">
                            <span class="author">{{comment.author}}</span><span class="time">{{formatTime(comment.created_at)}}</span>
                        </div>
                        <div class="body">
                            {{comment.text}}
                        </div>
                        <div class="footing">
                            Reply
                        </div>

                        <div class="comment comment-reply" v-for="reply in comment.responses">
                            <div class="heading">
                                <span class="author">{{reply.author}}</span><span class="time">{{formatTime(reply.created_at)}}</span>
                            </div>
                            <div class="body">
                                {{reply.text}}
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="footing">

            </div>

        </div>

        <div class="playlist grid grid-col grid-left">
            <div class="heading">
                <i class="icon">play_arrow</i> {{songs.length}} Songs
            </div>

            <div class="body">
                <div class="songs-container grid grid-col grid-left">
                    <div class="song grid grid-col grid-left" v-for="(song, index) in songs">
                        <div>
                            <span class="order">{{index + 1}}</span>
                            <span>{{song.name}}</span> - <span>{{song.artist}}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="footing">

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
        computed: {
            numComments () {
                let sum = 0;
                this.comments.forEach(c => {
                    sum = sum + c.responses.length + 1;
                });
                return sum;
            }
        },
        methods: {
            formatTime (time) {
                return moment(time, "YYYY-MM-DD hh:mm:ss").fromNow();
            }
        }
    }
</script>
