<template>

    <div class="grid grid-full">
    <div class="grid grid-full grid-wrap modal-add-content">
        <div class="grid grid-col grid-center grid-right">
            <h3>Create new playlist</h3>
        </div>
        <hr>
        <div class="grid grid-wide grid-left grid-wrap ">
            <div class="grid grid-wide grid-left">
                <h4>Basic information</h4>
            </div>
            <form id="basic-input-data">
                Playlist name:
                <input type="text" name="username"><br>
                Playlist creator:
                <input type="text" name="playlistname">
            </form>
        </div>
        <div class="grid grid-wide grid-wrap">
            <div class="grid grid-wide grid-left">
                   <h4>Song upload</h4>
                   </div>
            <div class="grid grid-wide grid-left">
                    <c-file-up id="file-upload" :url='url' :thumb-url='thumbUrl' :headers="headers" @change="onFileChange"></c-file-up>
             </div>       
        </div>
           <div class="grid grid-wide grid-center grid-wrap">
            <div class="grid grid-wide grid-left">
                <div class="grid grid-wide grid-left upload-holder">
                   <h4>Playlist description</h4>
                </div>
            </div>
            <div id="rich-text">
                  <quill-editor ref="myTextEditor">
        </quill-editor>
            </div>
        </div>
    </div> 

    </div>   
</template>

<script>
    import { quillEditor } from 'vue-quill-editor'

    export default {
        data(){
            return {
                url: 'http://your-post.url',
                headers: {'access-token': '<your-token>'},
                filesUploaded: []
            }
            
        },
        computed: {

        },
        methods:{
        thumbUrl (file) {
            return file.myThumbUrlProperty
            },
            onFileChange (file) {
            // Handle files like:
            this.fileUploaded = file
            }
        },
        components:{
            quillEditor
        },
    }
</script>
