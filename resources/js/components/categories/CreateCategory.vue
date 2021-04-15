<template>
    <div>
        <div class="rounded-md bg-red-50 p-4" v-if="createCategoryForm.errors.hasErrors()">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-red-400" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            <li v-if="createCategoryForm.errors.has('name')">
                                {{ createCategoryForm.errors.get('name') }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-md bg-green-50 p-4" v-if="createCategoryForm.successful">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg"
                         viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd"
                              d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                              clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-green-800">
                        Category created successfully!
                    </p>
                </div>
            </div>
        </div>

        <form class="space-y-8" method="POST" action="/admin/categories">
            <div class="space-y-8 sm:space-y-5">
                <div class="pt-8 space-y-6 sm:pt-10 sm:space-y-5">
                    <div class="space-y-6 sm:space-y-5">
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="name"
                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Name
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <input
                                        type="text"
                                        name="name"
                                        id="name"
                                        autocomplete="given-name"
                                        v-model="createCategoryForm.name"
                                        class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>
                        <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                            <label for="category"
                                   class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">
                                Parent Category
                            </label>
                            <div class="mt-1 sm:mt-0 sm:col-span-2">
                                <multiselect v-model="selectedCategory"
                                             id="category"
                                             :options="categories"
                                             placeholder="Select one"
                                             label="name"
                                             track-by="id"
                                             class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                                </multiselect>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pt-5">
                <div class="flex justify-end">
                    <a type="button"
                       href="/admin/categories"
                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit"
                            @click.prevent="createCategory"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import 'vue-multiselect/dist/vue-multiselect.min.css';

    export default {
        props: ['categories'],

        components: {
            Multiselect
        },

        data() {
            return {
                createCategoryForm: new AppForm({
                    name: null,
                    parentCategory: null,
                }),

                selectedCategory: [],
            }
        },

        methods: {
            createCategory() {
                if (this.selectedCategory) {
                    this.createCategoryForm.parentCategory = this.selectedCategory.id
                }

                App.post('/admin/categories', this.createCategoryForm)
                    .then(() => {
                        this.createCategoryForm.name = null;
                        this.selectedCategory = [];
                        this.createCategoryForm.parentCategory = null;
                    });
            }
        },
    }
</script>

<style scoped>
</style>
