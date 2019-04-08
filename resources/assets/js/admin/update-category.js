ACMEStore.admin.updateCategory = function() {
    document.querySelector('.update-category').addEventListener('submit', (event) => {
        
        event.preventDefault();
        const id = event.target.dataset.id;
        const token = event.target.dataset.token;
        const name = event.target.querySelector('#category-name').value;
        const parentId = event.target.querySelector('#parent-category-id').value;

        const notifications = document.querySelector('.notifications');

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
                if (!response.ok) {
                    const ul = document.createElement('ul');
                    Object.keys(json).forEach(error => {
                        const li = document.createElement('li');
                        li.appendChild(document.createTextNode(json[error][0]));
                        ul.appendChild(li);
                        console.log(json[error][0]);
                    });
                    notifications.style.display = 'block';
                    notifications.appendChild(ul);
                } else {
                    notifications.appendChild(document.createTextNode(json.success));
                }
        })();
    });
};