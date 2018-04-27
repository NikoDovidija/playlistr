<template>
    <div v-bind:id='getId' class="modal-wrapper hide">
        <div class="modal-container grid grid-wide">
            <div class="modal-header grid grid-wide">
                <div class="modal-close grid grid-right">
                    <button data-close-modal="testmodal"> close me</button>
                </div>
            </div>
            <div class="modal-content">
                 <!-- <component
                    v-bind:is="passedComponent"
                 ></component> -->
            </div>
<!-- header, close,  -->
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
