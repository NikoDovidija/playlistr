<template>
    <div class="grid grid-full">
    <div class="grid grid-full grid-wrap modal-add-content">
        <div class="grid grid-col grid-center grid-right">
            <h3>Create new playlist</h3>
        </div>
        <hr>
        <div class="grid grid-wide grid-left grid-wrap ">
            <form id="basic-input-data" action="">
                 <p v-if="errors.length">
                    <b>Please fill the following fields:</b>
                    <ul>
                    <li v-for="(error,index) in errors" :key="index" >{{ error }}</li>
                    </ul>
                </p>
                <br>
                <input id="playlistname" type="text" name="username" v-model="playname" placeholder="Playlist name">
                <br>
                <textarea id="playdescp" rows="4" cols="4" v-model="descp" placeholder="Description"></textarea>
                <br>
                <input type="file" name="pic" accept="image/*" @change="previewFile" id="fileinput">
                <br>
                <div class="container">
                <img v-if="this.imageurl" v-bind:src="this.imageurl" alt="image" v-on:dblclick='eraseImage' id="prev-image">
                <div class="cross">
                    Remove image
                </div>
                </div>
            </form>
        </div>
        
    </div> 

    </div>   
</template>

<script>

    export default {
        data(){
            return {   
                image: '',
                imageurl:'',
                files: [],
                creator:'',
                content:'',
                username:'',
                errors:[],
                playname:'',
                descp:'',
                url: 'api/upload',
                success: false,
                error:null,
                accept:'.mp3,.flac',
            }  
        },
        computed: {

        },
        methods:{
            thumbUrl(file) {
                return (file) || this.success
                ? 'uspeh'
                : ''
                console.log();
             },
            onFileChange (file) {
                this.fileUploaded = file
                console.log(file);
                },
                onSucess() {
                this.error = ''
                this.success = true
                var filee = e.target.files || e.dataTransfer.files;
                    if (!filee.length)
                    return;
                this.image = file.target.files[0];
                this.submitImage();
                },
                onError(e) {
                this.error = e
            },
            postBasicInfo(){
                console.log(this.content);
            },
            selectionChange(editor, range) {
                if (range) {
                    if (range.start !== range.end) {
                        this.content = editor.getContents();
            }
            }
            },
            previewFile(e) {
                var file = e.target.files || e.dataTransfer.files;
                    if (!file.length)
                    return;
                this.image = e.target.files[0];
                this.submitImage();
            },
            submitImage () {
                const formData = new FormData()
                formData.append('file',this.image)
                var tempurl = '';
                var self = this;
                axios.post('api/upload/thumbnail', formData)
                    .then(function (response) {
                        self.imageurl = decodeURIComponent(response.data["url"]);
                    })
                    .catch(function (error) {
                    console.log(error)
                    })    
                
                },
            eraseImage(item){
                $('input[name=pic').val('');
                var self = this;
                const formData = new FormData()
                formData.append('url',this.imageurl)
                 axios.post('api/upload/removeThumbnail', formData)
                    .then(function (response) {
                        self.imageurl = null;
                    })
                    .catch(function (error) {
                    console.log(error)
                    })    
            },
            checkForm() {
                if(this.playname) return true;
                this.errors = [];
                if(!this.playname) this.errors.push("Playlist name required.");
            }
        },
        components:{
        },
    }
</script>
