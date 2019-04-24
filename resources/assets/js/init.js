import Vue from 'vue';

Vue.component('delete-category', require('./components/DeleteCategory.vue').default);
Vue.component('update-category', require('./components/UpdateCategory.vue').default);

const app = new Vue({
    el: '#app',
});