require('./bootstrap');
import Vue from 'vue';//import Vue Libray
// import { Plugin } from 'vue-fragment';
import VueRouter from 'vue-router';
Vue.use(VueRouter);
// Vue.use(Plugin);
import postsBody from './components/App';

Vue.component('pagination', require('laravel-vue-pagination'));
// Vue.component('posts-index',require('./components/Posts/index').default);
// Vue.component('PostIndex',require('./components/Posts/index'));
// Vue.component('PostCreate',require('./components/Posts/create'));

import App from './components/App';
import PostIndex from './components/Posts/index';
import PostCreate from './components/Posts/create';

const router = new VueRouter({
    mode :'history',
    routes:[
        {
            path:'/app',
            component: PostIndex,
            name:'posts.index'
        },
        {
            path:'/posts/create',
            component: PostCreate,
            name:'posts.create'
        }
    ]
})
const app = new Vue({
    el :'#app',
    components:{ App },
    router: router,
});
