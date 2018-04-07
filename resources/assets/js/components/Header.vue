<template>
    <header>
        <div class="grid grid-top">
            <a href="/" class="logo grid-item">
                Playlistr
            </a>

            <div class="grid-item">
                <span class="btn btn-2 btn-circle">
                    <i class="icon">search</i>
                </span>

                <span class="btn btn-1 btn-text">
                    <span v-if="page == 'playlist'">Upload</span>
                    <span v-if="page == 'home'">Create</span>
                    <i class="icon">add</i>
                </span>
            </div>
        </div>
    </header>
</template>

<script>
    export default {

        computed: {
            page () {
                let route = window.location.pathname;
                if (route == "/")
                    return "home";
                else if (/^\/\d+$/.test(route))
                    return "playlist";
                
            }
        }
    }
</script>
