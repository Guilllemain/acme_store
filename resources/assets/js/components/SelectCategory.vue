<template>
    <div class="w-1/4 mx-12">
        <label for="category_id">Category</label>
        <div class="relative">
            <select class="input bg-white" v-model="selectedCategoryId">
            <option disabled value="">Select a category</option>
                <option v-for="category in mainCategories"
                        :value="category['id']" 
                        :key="category['id']"
                    >
                    {{category['name']}}
                </option>
            </select>
            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="relative">
            <select class="input bg-white" v-model="selectedSubCategoryId">
            <option disabled value="">Select a subcategory</option>
                <option v-for="category in subCategories" :value="category['id']" :key="category['id']">{{category['name']}}</option>
            </select>
            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
        <div class="relative">
            <select class="input bg-white" name="category_id">
            <option disabled value="NULL" selected>Select a subsubcategory</option>
                <option v-for="category in subsubCategories" :value="category['id']" :key="category['id']" :selected="oldCategoriesValues.level3.id">{{category['name']}}</option>
            </select>
            <div class="pointer-events-none absolute pin-y pin-r flex items-center px-2 text-grey-darker">
                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        categories: {
            required: true,
        },
        category_id: {
            required: false
        }
    },
    data() {
        return {
            selectedCategoryId: '',
            selectedSubCategoryId: '',
            oldCategoriesValues: {}
        }
    },
    mounted() {
        this.oldCategoriesValues.level3 = this.categories.find(category => category.id === this.category_id);
        this.oldCategoriesValues.level2 = this.categories.find(category => category.id === this.oldCategoriesValues.level3.parent_id);
        this.oldCategoriesValues.level1 = this.categories.find(category => category.id === this.oldCategoriesValues.level2.parent_id);
        this.selectedCategoryId = this.oldCategoriesValues.level1.id;
        this.selectedSubCategoryId = this.oldCategoriesValues.level2.id;
    },
    computed: {
        mainCategories() {
            return this.categories.filter(category => !category.parent_id);
        },
        subCategories() {
            return this.categories.filter(category => category.parent_id === this.selectedCategoryId);
        },
        subsubCategories() {
            return this.categories.filter(category => category.parent_id === this.selectedSubCategoryId);
        }
    }
}
</script>

