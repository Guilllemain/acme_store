<template>
    <div class="mr-2">
        <a @click="isModalOpen = true" class="cursor-pointer">
            <i class="text-blue fas fa-edit"></i>
        </a>
        <modal-component @closeModal="isModalOpen = false" v-show="isModalOpen">
            <div class="bg-white px-16 py-8 rounded">
                <h3 class="mb-8 font-normal text-center">Edit category</h3>
                <form class="flex flex-col">
                    <label for="name" class="mb-2 block">Category name</label>
                    <input type="text" name="name" class="input mb-6" :value="selectedCategory.name">

                    <label for="parent_id" class="mb-2 block">Parent category</label>
                    <select class="input bg-white" name="parent_id">
                        <option v-if="!selectedCategory.parent_id">Select a parent category</option>
                        <option v-for="category in categories" :key="category.id" :value="category.id" :selected="category.id === selectedCategory.parent_id ? 'selected' : false">{{category.name}}</option>
                    </select>
                    <button class="btn mt-4" type="submit">Update</button>
                </form>
            </div>
        </modal-component>
    </div>
</template>

<script>
import axios from 'axios';
import qs from 'qs';
import ModalComponent from './ModalComponent.vue';

export default {
    components: {ModalComponent},
    props: {
        categories: {
            required: true,
            type: Array
        },
        selectedCategory: {
            required: true,
            type: Object
        },
        token: {
            required: true,
            type: String
        }
    },
    data() {
        return {
            isModalOpen: false
        }
    },
    methods: {
        async deleteCategory() {
            const response = await axios.post(`http://acme.test/admin/products/categories/${this.category.id}/delete`, qs.stringify({
                token: this.token
            }))
        }
    }
}
</script>

