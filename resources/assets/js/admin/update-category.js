ACMEStore.admin.updateCategory = function() {
    document.querySelector('.update-category').addEventListener('submit', (event) => {
        
        event.preventDefault();
        const id = event.target.dataset.id;
        const token = event.target.dataset.token;
        const name = event.target.querySelector('#category-name').value;
        const parentId = event.target.querySelector('#parent-category-id').value;

        console.log(id, token, name);

        const data = new FormData();
        data.append('name', name);
        data.append('token', token);
        data.append('parentId', parentId);
        // const data = {
        //     name,
        //     token,
        //     parentId
        // };
        (async () => {
            try {
                const request = await fetch(`http://acme.test/admin/products/categories/${id}/update`, {
                    method: "POST",
                    body: data
                });
                const response = console.log(request.status);
            } catch (error) {
                console.log('hiiiii', error)
            }
        })();
    });
};