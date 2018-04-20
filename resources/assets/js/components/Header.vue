<template>
    <header>
        <a href="/" class="logo">
            <img src="/public/images/logo-small.svg" alt="Logo">
        </a>
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
