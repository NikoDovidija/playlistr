<template>
    <div class="grid grid-wide grid-wrap">
        <ais-index app-id="HUH5HSSLJ2"
           api-key="553c9236e9611caaf74d78cc3285f457"
           index-name="playlists"
           ref="aisIndex"
           id="search-holder-main">
            <ais-input placeholder="Search playlists..." id="search-p"></ais-input>
            <ais-results inline-template>
                <div id="grid grid-full search-result-container">
            <div v-for="result in results" :key="result.playlist_id" class="grid grid-row grid-full grid-wrap search-result-inner" v-bind:class="{ active: isActive }">
                <div class="grid grid-item" :href="'/playlists/'+result.playlist_id" >
                <img class="main-image" :src="result.url" alt="slideImage"/>
                </div>
                  <div class="grid-item grid-col grid-threequarter">
                      <div class="grid grid-wide grid-wrap">
                          <div class="grid-item grid-wide">
                              <h4>{{result.name}}</h4>
                              </div>
                          <div class="grid-item grid-wide">
                              <h5>{{result.times_played}}</h5>
                              </div>
                          <div class="grid-item grid-wide">
                              <h5>{{result.times_recommended}}</h5>
                              </div>
                      </div>
                </div>
            </div>      
                </div>
            </ais-results>
        </ais-index>
    </div>
</template>

<script>
    export default {
           data () {
            return {
                isActive: true,
                currentId: null
            }
        },
        computed: {
            // fetchedUrl () {
            //     return axios.get('/api/playlists/url/'+this.currentId);
            //     }
        },
        methods:{
            circle(res){
                console.log(res);
            },
            redirectTo(id){
                window.location.href = '/playlists/'+id;
            },
        },
        components:{

        }
    }
</script>
