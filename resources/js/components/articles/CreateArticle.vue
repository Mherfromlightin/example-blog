<template>
    <div>
        <div class="rounded-md bg-red-50 p-4" v-if="createArticleForm.errors.hasErrors()">
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
                    <h3 class="text-sm font-medium text-red-800">
                        There were {{ createArticleForm.errors.all().count() }} errors with your submission
                    </h3>
                    <div class="mt-2 text-sm text-red-700">
                        <ul class="list-disc pl-5 space-y-1">
                            <li v-for="error in createArticleForm.errors.all()">
                                {{ error }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="rounded-md bg-green-50 p-4" v-if="createArticleForm.successful">
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
                        Article created successfully!
                    </p>
                </div>
            </div>
        </div>

        <form class="space-y-8 divide-y divide-gray-200" method="POST" action="/articles"
              enctype="multipart/form-data">
            <div class="space-y-8 divide-y divide-gray-200">
                <div class="pt-8">
                    <div>
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Create Article
                        </h3>
                    </div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-3">
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                Name
                            </label>
                            <div class="mt-1">
                                <input type="text"
                                       name="name"
                                       id="name"
                                       autocomplete="given-name"
                                       v-model="createArticleForm.name"
                                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                            </div>
                        </div>

                        <div class="sm:col-span-3">
                            <label for="category" class="block text-sm font-medium text-gray-700">
                                Category
                            </label>
                            <div class="mt-1">
                                <multiselect v-model="selectedCategories"
                                             id="category"
                                             :options="categories"
                                             :multiple="true"
                                             :close-on-select="false"
                                             :clear-on-select="false"
                                             :preserve-search="true"
                                             placeholder="Select categories"
                                             label="name"
                                             track-by="id"
                                             :preselect-first="false">
                                </multiselect>
                            </div>
                        </div>

                        <div class="sm:col-span-6">
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea id="description"
                                          name="description"
                                          rows="3"
                                          v-model="createArticleForm.description"
                                          class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="mt-6 grid grid-cols-1 gap-y-6 gap-x-4 sm:grid-cols-6">
                        <div class="sm:col-span-6">
                            <label for="photo" class="block text-sm font-medium text-gray-700">
                                Photo
                            </label>
                            <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                                <div class="space-y-1 text-center">

                                    <div class="flex text-sm text-gray-600">
                                        <label for="photo"
                                               class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>
                                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor"
                                                     fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                      stroke-width="2" stroke-linecap="round"
                                                      stroke-linejoin="round"/>
                                                </svg>
                                            </span>
                                            <input id="photo" name="photo" type="file" class="sr-only"
                                                   @change="selectFile"
                                            >
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">
                                        PNG, JPG, GIF up to 10MB
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-5">
                <div class="flex justify-end">
                    <a type="button"
                       href="/admin/articles"
                       class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Cancel
                    </a>
                    <button type="submit"
                            @click.prevent="createArticle"
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
                createArticleForm: new AppForm({
                    name: null,
                    categories: null,
                    description: null,
                    photo: null,
                }),
                selectedCategories: [],
            }
        },

        methods: {
            selectFile(event) {
                this.createArticleForm.photo = event.target.files[0]
            },

            createArticle() {
                if (this.selectedCategories) {
                    this.createArticleForm.categories = this.selectedCategories.map(category => {
                        return category.id;
                    });
                }

                const formData = new FormData();
                formData.append('photo', this.createArticleForm.photo);
                formData.append('name', this.createArticleForm.name);
                formData.append('description', this.createArticleForm.description);
                formData.append('categories', this.createArticleForm.categories);

                axios.post('/articles', formData)
                    .then(() => {
                        this.createArticleForm.name = null;
                        this.createArticleForm.categories = null;
                        this.createArticleForm.description = null;
                        this.createArticleForm.photo = null;

                        this.selectedCategories = [];
                    });
            }
        },
    }
</script>

<style scoped>
</style>
