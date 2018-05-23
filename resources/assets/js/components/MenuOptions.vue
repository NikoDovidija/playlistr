<template>
    <div class="grid grid-col grid-right iconsOuterHolder">
            <span data-open-modal="add-playlist" class="iconsHolder" v-if="loggin">
                <i class="icon-icons8-plus-math btn btn2"></i>
            </span>
            <span data-open-modal="search-playlist" class="iconsHolder">
                <i class="icon-icons8-search btn btn2"></i>
            </span>
            <span class="iconsHolderLogin" v-on:click="redirectTo">
                <i class="icon-user-plus btn btn2"></i>
            </span>
        </div>
</template>


<script>
    export default {
           data () {
            return {
                loggin:true
            }
        },
        computed: {

        },
        mounted:{

        },
        methods:{
            redirectTo(){
                window.location.href = '/login';
            }
        },
        components:{

        }
    }
</script>