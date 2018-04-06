<template>
    <div>
        <span class="nav-toggle btn" 
                    v-bind:class="{ active: isActive}"
                    v-on:click="isActive = !isActive">
                <i class="material-icons">menu</i>
        </span>
        <ul class="nav collapse grid-item"
            v-bind:class="{ active: isActive}">
            <li class="nav-item">Item 1</li>
            <li class="nav-item">Item 2</li>
            <li class="nav-item">Item 3</li>
        </ul>
    </div>
</template>
    
<script>
    export default {
        data () {
            return {
                isActive: false
            };
        }
    };
</script>   