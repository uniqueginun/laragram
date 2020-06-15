/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import Vuex from 'vuex'

Vue.use(Vuex)

import posts from './store/posts'

const store = new Vuex.Store({
    modules: {
        posts
    }
})

import VModal from 'vue-js-modal'

Vue.use(VModal, {
    dynamic: true,
    injectModalsContainer: true,
    dynamicDefaults: {
        height: 'auto',
        pivotY: 0.2,
        classes: 'p-4',
    }
})


const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

// Vue.component('example-component', require('./components/CreatePostModal.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    store
});
