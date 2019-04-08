(function() {
    'use strict';
    $(document).foundation();

    document.addEventListener('DOMContentLoaded', () => {
        const id = document.body.dataset.id;
        switch (id) {
            case 'update-category':
                ACMEStore.admin.updateCategory();
                break;
        
            default:
            console.log('no')
                break;
        }
    });
})();