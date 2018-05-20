<template>
<div class="playlist-social not-sm grid grid-half grid-center">
    <span class="grid social-icon" v-on:click="incrementFav">
    <i class="icon btn btn4 icon-like"></i>
    <span>{{favs}}</span>
    </span>
    <span class="grid social-icon">
    <i class="icon btn btn4 icon-share"></i>
    <span></span>
    </span>
</div>
</template>

<script>

    export default {
        props:['playlistid','favourites','played'],
        data(){
            return {
                favs: 0,
            }  
        },
        computed: {
            

        },
        
        methods:{
            incrementFav(){
                var self = this;
                axios.post('/api/'+this.playlistid+'/incrementFav')
                    .then(function (response) {
                        self.favs = response.data["favourites"]
                    })
                    .catch(function (error) {
                    console.log(error)
                    })    
                
            }
      
        },
        mounted(){
            this.favs = this.favourites;
        }
    }
</script>
