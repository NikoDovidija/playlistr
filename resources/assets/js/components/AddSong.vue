<template>
    <div class="grid grid-full grid-wrap">
    <div class="grid grid-full grid-wrap modal-add-content">
        <div class="grid grid-center grid-right">
            <h3>Add song </h3>
        </div>
        <div class="grid  grid-center grid-right">
            <button class="btn btn-primary" @click="submit">Upload songs</button>
        </div>
    </div> 
    <div class="grid grid-full">
        <div class="form-group grid grid-wide grid-wrap">
            <!-- <label for="logo" class="control-label">Attachments</label> -->
            <!-- <br> -->
             <div class="grid grid-wide grid-wrap">
                <input type="file" multiple="multiple" accept=".mp3,audio/*" id="attachments" @change="uploadFieldChange">
                <!-- <hr> -->
                <div class="grid grid-item grid-wrap">
                    <div class="attachment-holder animated fadeIn" v-cloak v-for="(attachment, index) in attachments" :key="index"> 
                        <hr>
                        <div class="grid grid-wide">
                            <span class="label label-primary" >{{ attachment.name + ' (' + Number((attachment.size / 1024 / 1024).toFixed(1)) + 'MB)'}}</span> 
                                Artist:<input type="text" :name='"artist"+index' >
                                Song name:<input type="text" :name='"songname"+index' >
                            <span class="" style="background: red; cursor: pointer;" @click="removeAttachment(attachment)"><button class="btn btn-xs btn-danger">Remove</button></span>
                        </div>
                    </div>
                </div>
             </div>
             <!-- <br><br> -->
        </div>
    </div>
</div>
</template>

<script>
export default {

  data() {
    return {
        // You can store all your files here
        attachments: [],
        songname:[],
        artist:[],
        // Each file will need to be sent as FormData element
        data: new FormData(),
        errors: {
        },
        percentCompleted: 0, // You can store upload progress 0-100 in value, and show it on the screen

      
    }
  },
  watch: {
  
  },
  methods: {
      getAttachmentSize() {
                this.upload_size = 0; // Reset to beginningƒ
                this.attachments.map((item) => { this.upload_size += parseInt(item.size); });
                this.upload_size = Number((this.upload_size).toFixed(1));
                this.$forceUpdate();
            },
            prepareFields() {
                if (this.attachments.length > 0) {
                    for (var i = 0; i < this.attachments.length; i++) {
                        var query1 = "input[name=artist"+i+"]";
                        var query2 = "input[name=songname"+i+"]";
                        const field1 = document.querySelector(query1).value
                        const field2 = document.querySelector(query2).value
                        let attachment = this.attachments[i];
                        this.data.append('attachments[]', attachment);
                        let attinfo = {"index":i,"artist":field1,"songname":field2};
                        this.data.append('attinfo[]',JSON.stringify(attinfo));
                    }
                }
            },
            removeAttachment(attachment) {
                
                this.attachments.splice(this.attachments.indexOf(attachment), 1);
                this.getAttachmentSize();
                console.log("current atts"+this.attachments);
                
            },
            // This function will be called every time you add a file
            uploadFieldChange(e) {
                var files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                for (var i = files.length - 1; i >= 0; i--) {
                    this.attachments.push(files[i]);
                }
                // Reset the form to avoid copying these files multiple times into this.attachments
                document.getElementById("attachments").value = [];
                
            },
            submit() {
                this.prepareFields();
                var config = {
                    headers: { 'Content-Type': 'multipart/form-data' } ,
                    onUploadProgress: function(progressEvent) {
                        this.percentCompleted = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
                        this.$forceUpdate();
                    }.bind(this)
                };
                let id = parseInt(window.location.pathname.split('/')[2]);
                var self =this;
                axios.post('/api/playlists/'+id+'/upload/mp3', this.data, config)
                .then(function (response) {
                    console.log(response);
                    if (response.data.success) {
                        console.log('Successfull Upload');
                        this.resetData();
                        self.redirectTo(id);
                    } else {
                        console.log('Unsuccessful Upload');
                        this.errors = response.data.errors;
                    }
                }.bind(this)) // Make sure we bind Vue Component object to this funtion so we get a handle of it in order to call its other methods
                .catch(function (error) {
                    console.log(error);
                });
            },
            // We want to clear the FormData object on every upload so we can re-calculate new files again.
            // Keep in mind that we can delete files as well so in the future we will need to keep track of that as well
            resetData() {
                this.data = new FormData(); // Reset it completely
                this.attachments = [];
            },
            start() {
                console.log('Starting File Management Component');
            },
            redirectTo(id){
                window.location.href = "/playlists/"+id;
            }
        },
        created() {
            this.start();
        }
  
  
}
</script>
