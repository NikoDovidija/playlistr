<template>
    <div id="recordPlayer" class="grid grid-full grid-col grid-even">


            <div class="record-container">
           
                <!-- Black material -->
                <div class="record-outer"></div>
                
                <div class="record-spin-wrap playing">  
                    <!-- Artwork of a song or playlist -->
                    <div class="record-artwork-container">
                        <img class="record-artwork" src="/public/images/joy-of-motion.jpg" alt="">
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

        data () {
            return {
              
                
            }
        },

        created () {
        },

        mounted () {

        },

        computed: {

        },

        events: {

        },

        methods: {
        
        }
    }
</script>