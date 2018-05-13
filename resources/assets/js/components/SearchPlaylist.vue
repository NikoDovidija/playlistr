<template>
    <div class="grid grid-wide grid-wrap">
         <!-- <div class="grid grid-wide grid-center">
            <h3>Search</h3>
        </div>
        <div class="grid grid-wide search-holder">
            <input id="big-search" type="text" name="textinput" value="Keywords">
        </div>
            <div class="grid grid-wide button-holder grid-center">
             <input id="search-button" type="button" value="Button" >
        </div>
          <div class="grid grid-wide list-holder grid-center">
            list content
        </div> -->
<ais-index app-id="HUH5HSSLJ2"
           api-key="553c9236e9611caaf74d78cc3285f457"
           index-name="playlists">

           <ais-input placeholder="Search playlists..."></ais-input>

           <ais-results></ais-results>

</ais-index>
    </div>
</template>

<script>
    export default {

        computed: {

        },
        methods:{

        },
        components:{

        }
    }
</script>
