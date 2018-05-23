<template>
    <div id="recordPlayer" class="grid grid-full grid-col grid-even">
            <div class="record-container">
                <!-- Black material -->
                <div class="record-outer"></div>
                <div class="record-spin-wrap" :class="{ playing:isPlaying , still:!isPlaying }" id="temp" >  
                    <!-- Artwork of a song or playlist -->
                    <div class="record-artwork-container"  >
                        <img class="record-artwork" :src="urlImage" alt="">
                    </div>
                </div>
                <!-- Gradient on top of artwork to make it look shiny -->
                <div class="record-blur"></div>
                <!-- The hole in the middle of record -->
                <div class="record-hole"></div>

            </div>



    </div>
</template>

<script>
    export default {
        props:['pinfo'],
        data () {
            return {
                id:null,
                urlImage:"",
                isPlaying:false,
            }
        },
        created () {
        },
        mounted () {
            this.id = window.location.pathname.split('/')[2];
            axios.get("/api/playlists/url/"+this.id)
                .then(response => {
                    this.setImage(response.data["url"]);
                })

            this.$root.$on('play-record', should => {
                this.isPlaying = should;
                
            });
        },
        computed: {
            calculateAngle(){
                var el = document.getElementById('temp');
                var st = window.getComputedStyle(el, null);
                var tr = st.getPropertyValue("-webkit-transform") ||
                    st.getPropertyValue("-moz-transform") ||
                    st.getPropertyValue("-ms-transform") ||
                    st.getPropertyValue("-o-transform") ||
                    st.getPropertyValue("transform") ||
                    "fail...";

                if( tr !== "none") {
                    console.log('Matrix: ' + tr);

                    var values = tr.split('(')[1];
                    values = values.split(')')[0];
                    values = values.split(',');
                    var a = values[0];
                    var b = values[1];
                    var c = values[2];
                    var d = values[3];

                    var scale = Math.sqrt(a*a + b*b);

                    // First option, don't check for negative result
                    // Second, check for the negative result
                    /** /
                    var radians = Math.atan2(b, a);
                    var angle = Math.round( radians * (180/Math.PI));
                    /*/
                   // arc sin, convert from radians to degrees, round
                    var sin = b/scale;
                    // next line works for 30deg but not 130deg (returns 50);
                    // var angle = Math.round(Math.asin(sin) * (180/Math.PI));
                    var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
                    /**/
                    
                } else {
                    var angle = 0;
                }

                // works!
                return angle;
            }

        },
        events: {

        },
        methods: {
            setImage(id){
                if(!id.startsWith('/')){
                    id = "/"+id;
                }
                this.urlImage = id;
            }
        }
    }
</script>