<template>
    <div v-bind:id='getId' class="modal-wrapper hide" >
        <div class="modal-container grid grid-wide grid-twothird grid-center grid-wrap">
            <div class="modal-header grid grid-wide">
                <div class="modal-close grid grid-left grid-half">
                    <span data-close-modal="testmodal" class="iconsHolder">
                        <i class="icon-icons8-delete btn btn2"></i>
                    </span>
                </div> 
                <div class="modal-action grid grid-right grid-half">
                    <span data-close-modal="testmodal" class="iconsHolder">
                        <i class="icon-icons8-add btn btn2"></i>
                    </span>
                </div>
            </div>
            <div class="modal-content grid grid-full grid-center">
            <c-add-playlist v-if="getId=='add-playlist'"></c-add-playlist>
            <c-search-playlist v-else-if="getId=='search-playlist'"></c-search-playlist>
            </div>
        </div>
    </div>
</template>

<script>
    
    export default {
        props: ["id"]
        ,
        computed: {
            getId(){
                return this.id;
            }
        },
        methods:{

        },
        mounted(){
            console.log(this.id);
        }
    }
</script>
