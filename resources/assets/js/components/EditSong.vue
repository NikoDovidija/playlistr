<template>
<div class="grid grid-wrap">
    <div class="grid grid-item">
    <button v-on:click="editSong">Edit song</button>
    </div>
     <div class="grid grid-item">
    <button v-on:click="removeSong">Remove song</button>
    </div>
    <div class="grid grid-item">
    <div v-if="toEdit">
    <input v-model="name" placeholder="Artist name">
    <input v-model="artist" placeholder="Song name">
    <button v-on:click="posteditSong">Confrim</button>
     </div>
    </div>
</div>
</template>


<script>
    export default {
           data () {
            return {
                name:'',
                artist:'',
                toEdit:false,
                id:null,
            }
        },
        computed: {

        },
        methods:{
            posteditSong(){
                var self = this;
                var url = window.location.pathname.split('/')[2];
                const formData = new FormData()
                formData.append('artist',this.artist);
                formData.append('name',this.name);
                axios.post('/songs/'+this.id+'/editSong',formData)
                .then(function (response) {
                    console.log('success')
                        self.redirectTo(url);
                    })
                    .catch(function (error) {
                        console.log(error)
                    }) 
            },
            editSong(){
                this.toEdit = !this.toEdit;
                this.posteditSong();
            },
            removeSong(){
                   if (confirm("Are you sure you want to delete the song")) {
                    var id = window.location.pathname.split('/')[2];
                    this.postdelete(id);
                } 
            }, 

            postdelete(url){
                var self = this;
                console.log("id je"+this.id);
                const formData = new FormData()
                formData.append('playlist',url);
                axios.post('/songs/'+this.id+'/removeSong',formData)
                .then(function (response) {
                    console.log('success')
                        self.redirectTo(url);
                    })
                    .catch(function (error) {
                        console.log(error)
                    }) 
            },
            redirectTo(url){
                window.location.href="/playlists/"+url;
            }
        },
        components:{

        },
        mounted(){
            var self = this;
            this.$root.$on('song-options', index => {
                self.id=index;
            });
        }
    }
</script>