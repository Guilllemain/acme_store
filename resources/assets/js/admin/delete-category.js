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