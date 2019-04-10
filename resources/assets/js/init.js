import Vue from 'vue';
import DeleteCategory from './components/DeleteCategory.vue';
import UpdateCategory from './components/UpdateCategory.vue';

const app = new Vue({
    el: '#app',
    components: {
        DeleteCategory,
        UpdateCategory,
    },
});

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        const id = document.body.dataset.id;
        switch (id) {
            case 'update-category':
                break;
        
            default:
            console.log('no')
                break;
        }
    });
})();