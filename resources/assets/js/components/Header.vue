<template>
    <header>
        <!-- <div class="soundwaves-bg">
            <span class="soundwave"  v-for="x in 50"></span>
        </div> -->
        <div class="grid grid-top">
            <a href="/" class="logo grid-item">
                <div class="logo"></div>
            </a>
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
