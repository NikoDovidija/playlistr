<template>
    <div class="post-comment grid grid-wide hide" v-if="usrid!=undefined">
        <div class="grid grid-quarter grid-col grid-left" v-if="reply">
              <div class="reply-btn grid grid-center" v-on:click="unreply">
                    <i class="icon-undo2 btn" ></i>
                </div>
        </div>
        <div class="grid grid-threequarter grid-col grid-left">
            <div class="grid grid-wide">
                <textarea placeholder="Comment" rows="3" v-model="comment" ></textarea>
                <div class="reply-btn grid grid-center" v-on:click="postcomment">
                    <i class="icon-redo2 btn" ></i>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
   export default {
        props:['usrid'],
         data(){
            return {
                name:'',
                comment:'',
                reply:false,
                idreply:null,
            }  
        },    
        computed: {
 
        },
        methods:{
            unreply(){
                this.reply = false;
                this.idreply = null;
            },
            postcomment(){
                const formData = new FormData()
                var ptype = this.idreply ? 'comment' : 'playlist';
                var response = this.idreply ? this.idreply : window.location.pathname.split('/')[2];
                formData.append("parent_type",ptype);
                formData.append("response_to",response);
                formData.append("text",this.comment);
                formData.append("author",this.usrid);
                var self = this;
                axios.post('/api/comments', formData)
                    .then(function (response) {
                        self.redirectTo();
                    })
                    .catch(function (error) {
                        console.log(error)
                    })    
            },
            redirectTo(){
                console.log('usr is'+this.usrid);
                //var id = window.location.pathname.split('/')[2];
                //window.location.href = '/playlists/'+id;
            },
            fetchComments(){
                var id = window.location.pathname.split('/')[2];
                var self = this;
                  axios.get('/api/playlists/'+id+'/comments')
                    .then(function (response) {
                        console.log('success')
                        self.comments = response.data['']
                    })
                    .catch(function (error) {
                        console.log(error)
                    }) 
            }
        },
        mounted(){
            console.log('mounted'+this.usrid);
            this.$root.$on('comment-response', id => {
                this.reply = true;
                this.idreply = id;
            });
        },
    }
</script>