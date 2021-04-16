<template>
    <div class="relative bg-gray-50 py-16 sm:py-24 lg:py-32">
        <div class="relative">
            <div class="text-center mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:px-8 lg:max-w-7xl">
                <p class="mt-2 text-3xl font-extrabold text-gray-900 tracking-tight sm:text-4xl">
                    Blogs
                </p>
                <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-start sm:border-t sm:border-gray-200 sm:pt-5">
                    <div class="mt-1 sm:mt-0 sm:col-span-2">
                        <multiselect v-model="selectedCategory"
                                     @select="searchArticles"
                                     :value="selectedCategory"
                                     id="category"
                                     :searchable="true"
                                     :options="all_categories"
                                     placeholder="Select category for search article"
                                     label="name"
                                     track-by="id"
                                     class="max-w-lg block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:max-w-xs sm:text-sm border-gray-300 rounded-md">
                        </multiselect>
                    </div>
                </div>
            </div>
            <div class="mt-12 mx-auto max-w-md px-4 grid gap-8 sm:max-w-lg sm:px-6 lg:px-8 lg:grid-cols-3 lg:max-w-7xl">

                <div v-for="article in articleList" class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                    <a :href="'/articles/'+ article.id">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover"
                                 :src="'/storage/articles/' + article.photo " alt="">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                               <div class="flex">
                                   <p v-for="category in article.categories" class="text-sm font-medium text-cyan-600">
                                       {{ category.name  + ', '}}
                                   </p>
                               </div>
                                <p class="text-xl font-semibold text-gray-900">
                                    {{ article.name }}
                                </p>
                                <p class="mt-3 text-base text-gray-500 ellipsis">
                                    {{ article.description }}
                                </p>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full"
                                         src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixqx=RmpqVB6rzB&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                         alt="Roel Aufderehar">
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        {{ article.author.name }}
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <time datetime="2020-03-16">
                                            {{ article.published_at | date }}
                                        </time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Multiselect from 'vue-multiselect';
    import 'vue-multiselect/dist/vue-multiselect.min.css';

    export default {
        props: [
            'articles',
            'all_categories',
        ],

        components: {
            Multiselect
        },

        data() {
            return {
                selectedCategory: [],
                articleList: [],
            }
        },

        mounted() {
            this.articleList = this.articles
        },

        methods: {
            searchArticles() {
                this.$nextTick(() => {
                    axios.get("/articles/search", {params: {category_id: this.selectedCategory.id}}).then(response => {
                        this.articleList = response.data
                    });
                });
            }
        }
    }
</script>

<style scoped>
</style>
