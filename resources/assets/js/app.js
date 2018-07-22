
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
Vue.mixin({
    methods: {
        getApiUrl(slug) {
            var protocol = location.protocol;
            var slashes = protocol.concat("//");
            var host = slashes.concat(window.location.hostname);
            return host + '/' + slug;
        }
    }
});

Vue.component('categories', require('./components/categories/CategoriesList.vue'));
Vue.component('categories-form', require('./components/categories/CategoriesForm.vue'));
Vue.component('category', require('./components/categories/Category.vue'));

Vue.component('posts', require('./components/posts/PostsList.vue'));
Vue.component('posts-form', require('./components/posts/PostsForm.vue'));
Vue.component('post', require('./components/posts/Post.vue'));

Vue.component('paginate', require('vuejs-paginate'));

const app = new Vue({
    el: '#app'
});
