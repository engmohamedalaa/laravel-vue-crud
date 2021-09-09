require('./bootstrap');
import Vue from 'vue';//import Vue Libray
import { Plugin } from 'vue-fragment';
Vue.component('pagination', require('laravel-vue-pagination'));
Vue.use(Plugin);
Vue.component('posts-index',require('./components/Posts/index').default)
const app = new Vue({
    el :'#app'
})
