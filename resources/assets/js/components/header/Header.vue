<template>
    <header>
        <div class="width-limiter">
            <div class="grid">
                <div class="logo grid-item">laylistR</div>
                <menu-component></menu-component>
            </div>
        </div>
    </header>
</template>

<script>
    import MenuComponent from '../header/Menu.vue';

    export default {
        components: {
            "menu-component": MenuComponent
        },
        data () {
            return {};
        },
    };
</script>

