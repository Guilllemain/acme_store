<template>
    <form @submit.prevent="deleteCategory">
        <button type="submit"><i class="fas fa-times"></i></button>
    </form>
</template>

<script>
import axios from 'axios';
import qs from 'qs';

export default {
    props: {
        category: {
            required: true,
            type: Object
        },
        token: {
            required: true,
            type: String
        }
    },
    methods: {
        async deleteCategory() {
            const response = await axios.post(`http://acme.test/admin/products/categories/${this.category.id}/delete`, qs.stringify({
                token: this.token,
            }))
        }
    }
}
</script>

