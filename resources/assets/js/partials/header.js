import Header from '../components/header/Header.vue'

Vue.component("header-component", Header);


const header = new Vue({
    el: 'header-component',
});
