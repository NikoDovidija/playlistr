<template>
<div class="grid grid-wide">
    <button v-on:click="editSong">Edit song</button>
    <button v-on:click="removeSong">Remove song</button>
    <div v-if="toEdit">
    <input v-model="name" placeholder="Artist name">
    <input v-model="artist" placeholder="Song name">
    </div>
</div>
</template>


<script>
    export default {
           data () {
            return {
                name:'',
                artist:'',
                toEdit:false
            }
        },
        computed: {

        },
        methods:{
            editSong(){
                this.toEdit = true;
            },
            removeSong(){

            }, 
        },
        components:{

        }
    }
</script>