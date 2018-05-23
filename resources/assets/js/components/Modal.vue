<template>
    <div v-bind:id='getId' class="modal-wrapper hide" >
        <div class="modal-container grid grid-wide grid-twothird grid-center grid-wrap">
            <div class="modal-header grid grid-wide">
                <div class="modal-close grid grid-left grid-half">
                    <span data-close-modal="testmodal" class="iconsHolder">
                        <i class="icon-icons8-delete btn btn2"></i>
                    </span>
                </div> 
                <div v-if="getId=='add-playlist'" class="modal-action grid grid-right grid-half">
                    <span class="iconsHolder" @click='postData'>
                        <i class="icon-icons8-add btn btn2"></i>
                    </span>
                </div>
            </div>
            <div class="modal-content grid grid-full grid-center">
            <c-add-playlist ref="addPlay" v-if="getId=='add-playlist'" ></c-add-playlist>
            <c-search-playlist v-else-if="getId=='search-playlist'" ></c-search-playlist>
            <c-add-song v-else-if="getId=='add-song'" ></c-add-song>
            <c-edit-song v-else></c-edit-song>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
         data(){
            return {
            }  
        },    
        mounted:{
         
        },
        props: ["id"]
        ,
        computed: {
            getId(){
                return this.id;
            }
        },
        methods:{
            postData(){
                if(this.$refs.addPlay.checkForm()){
                    const formData = new FormData();
                    formData.append('name',this.$refs.addPlay.playname)
                    formData.append('creator',this.$refs.addPlay.creator);
                    formData.append('descp',this.$refs.addPlay.descp);
                    formData.append('artwork',this.$refs.addPlay.imageurl);
                    var self = this;
                    axios.post("/create",formData)
                    .then(response => {
                        self.closeModal(); 
                        self.toparent(response.data);
                    })
                    .catch(e => {
                        console.error(e);
                    });
                }
            },
            closeModal(){
                $(".modal-wrapper").addClass('hide');
            },
            toparent(data){
                this.$emit('test', data);
            }
        },
        mounted(){
            console.log(this.id);
        },
    }
</script>
