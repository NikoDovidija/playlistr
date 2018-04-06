<template>

      <div class="comment" v-bind:class="{reply: isReply}">
        <div class="comment-header">
            <span class="author">{{author}}</span>
            <span class="date">{{formattedDate}}</span>
        </div>
        <div class="comment-body">
            {{text}}
        </div>
        <div class="comment-footer">
            <span class="upvote">up</span>
            <span class="downwote">down</span>
            <span class="reply" v-if="!isReply">Reply</span>
        </div>
      </div>


</template>

<script>
    export default {
        props: ["author", "createdAt", "text", "isReply"],
        computed: {
            formattedDate () {
                return moment(this.createdAt, "YYYY-MM-DD hh:mm:ss").fromNow();
            }
        }
    }
</script>
