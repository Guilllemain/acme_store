(function() {
    'use strict';

    window.ACMEStore = {
        global: {},
        admin: {}
    };
})();
ACMEStore.admin.deleteCategory = function() {
    document.querySelector('.delete-category').addEventListener('submit', event => {
        event.preventDefault();
        const id = event.target.dataset.id;
        const token = event.target.dataset.token;
        const notifications = document.querySelector('.notifications');
        
        const data = new FormData();
        data.append('token', token);

        (async () => {
            const response = await fetch(`http://acme.test/admin/products/categories/${id}/delete`, {
                method: "POST",
                body: data
            });
            const json = await response.json();

            notifications.style.display = 'block';

            if (!response.ok) {
                console.error(json);
            } else {
                notifications.classList.remove('alert');
                notifications.classList.add('success');
                notifications.insertBefore(document.createTextNode(json.success), notifications.firstChild);
            }
        })();
    })
};
ACMEStore.admin.updateCategory = function() {
    document.querySelector('.update-category').addEventListener('submit', event => {
        console.log('hiiii')
        event.preventDefault();
        const id = event.target.dataset.id;
        const token = event.target.dataset.token;
        const name = event.target.querySelector('#category-name').value;
        const parentId = event.target.querySelector('#parent-category-id').value;

        const notifications = document.querySelector('.notifications');
        while (notifications.firstChild.tagName !== 'BUTTON') {
            notifications.removeChild(notifications.firstChild);
        }

        const data = new FormData();
        data.append('name', name);
        data.append('token', token);
        data.append('parentId', parentId);
 
        (async () => {
                const response = await fetch(`http://acme.test/admin/products/categories/${id}/update`, {
                    method: "POST",
                    body: data
                });
                const json = await response.json();

                notifications.style.display = 'block';
            
                if (!response.ok) {
                    const ul = document.createElement('ul');
                    Object.keys(json).forEach(error => {
                        const li = document.createElement('li');
                        li.appendChild(document.createTextNode(json[error][0]));
                        ul.appendChild(li);
                        console.log(json[error][0]);
                    });
                    notifications.classList.remove('success');
                    notifications.classList.add('alert');
                    notifications.insertBefore(ul, notifications.firstChild);
                } else {
                    notifications.classList.remove('alert');
                    notifications.classList.add('success');
                    notifications.insertBefore(document.createTextNode(json.success), notifications.firstChild);
                }
        })();
    });
};