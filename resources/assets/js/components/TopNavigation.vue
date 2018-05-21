<template>
    <div class="top-navigation">
        <div class="grid grid-col">
            <span class="plus-btn" data-open-modal="add-song">
                <i class="icon btn2 btn icon-icons8-plus-math"></i>
            </span>
            <span class="comment-btn">
                <i class="icon btn2 btn icon-bubbles"></i>
            </span>
            <span class="playlist-btn hide">
                <i class="icon btn2 btn icon-playlist"></i>
            </span>
            <span class="remove-btn" v-on:click="confirmdelete">
                <i class="icon btn2 btn icon-icons8-delete"></i>
            </span>
        </div>
    </div>
  
</template>

<script>
    export default {
        data () {
            return {
                
            }
        },
        methods:{
            confirmdelete() {
                
                if (confirm("Are you sure you want to delete the playlist")) {
                    var id = window.location.pathname.split('/')[2];
                    this.postdelete(id);
                } 
            },

            postdelete(id){
                var self = this;
                axios.post('/api/playlists/'+id+'/removePlay')
                .then(function (response) {
                    console.log('success')
                        self.redirectTo();
                    })
                    .catch(function (error) {
                        console.log(error)
                    }) 
            },

            redirectTo(){
                window.location.href = '/';
            }
        }
    }
</script>