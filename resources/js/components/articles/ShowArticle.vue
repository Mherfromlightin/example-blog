<template>
    <div class="relative bg-white" v-if="article">
        <div class="m-10 lg:absolute lg:inset-0">
            <div class="lg:absolute lg:inset-y-0 lg:left-0 lg:w-1/2">
                <img class="h-56 w-full object-cover lg:absolute lg:h-full"
                     :src="'/storage/articles/' + article.photo "
                     alt="">
            </div>
        </div>
        <div class="relative pt-12 pb-16 px-4 sm:pt-16 sm:px-6 lg:px-8 lg:max-w-7xl lg:mx-auto lg:grid lg:grid-cols-2">
            <div class="lg:col-start-2 lg:pl-8">
                <div class="text-base max-w-prose mx-auto lg:max-w-lg lg:ml-auto lg:mr-0">
                    <h5 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">Author
                        Name: {{ article.author.name}} </h5>
                    <h3 class="mt-7 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">Article
                        Title: {{ article.name}} </h3>

                    <h2 v-for="category in article.categories"
                        class="leading-6 text-indigo-600 font-semibold tracking-wide uppercase">{{ category.name }}</h2>

                    <p class="mt-2 text-lg text-gray-500">{{ article.description }}</p>
                    <p class="mt-2 text-sm text-gray-500 leading-6 text-indigo-400 font-semibold tracking-wide">
                        Published At: {{ " " + article.published_at | date }}</p>
                    <div>
                        <i class="fa fa-thumbs-o-down float-right inline-flex items-center ml-1 px-2.5 py-1.5 "
                           aria-hidden="true"
                           @click.prevent="syncDislike()"
                           :class="{ active: syncLikeForm.dislike }"
                        ><span>({{ dislikesCount }})</span></i>
                    </div>
                    <div>
                        <i class="fa fa-thumbs-o-up float-right inline-flex items-center ml-1 px-2.5 py-1.5 "
                           aria-hidden="true"
                           @click.prevent="syncLike()"
                           :class="{ active: syncLikeForm.like }"
                        ><span>({{ likesCount }})</span></i>
                    </div>

                    <div class="mt-5 prose prose-indigo text-gray-500">
                        <h1 class="text-2xl ">Comments</h1>
                        <div class="overflow-auto h-60">
                            <div v-for="comment in article.comments">
                                <hr>
                                <h3 class="text-lg font-extrabold">{{ comment.author.name }}</h3>
                                <p>{{ comment.body }}</p>
                            </div>
                        </div>

                        <div>
                            <form action="/comments" method="POST">
                                <div class="sm:col-span-2">
                                    <div class="mt-10">
                                        <textarea id="body" name="body" rows="4"
                                                  placeholder="Add comment"
                                                  class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"
                                                  v-model="createCommentForm.body"
                                        ></textarea>
                                    </div>
                                </div>
                                <button type="submit"
                                        class="float-right inline-flex items-center ml-1 px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500"
                                        @click.prevent="createComment">Publish
                                </button>
                            </form>
                            <a href="#" type="button"
                               @click.prevent="cancelComment"
                               class="float-right inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cancel
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: [
            'articleId'
        ],

        data() {
            return {
                syncLikeForm: new AppForm({
                    like: false,
                    dislike: false,
                }),

                createCommentForm: new AppForm({
                    body: null,
                }),

                article: null,
            }
        },

        mounted() {
            this.getArticle();
        },

        computed: {
            dislikesCount() {
                return this.article.likes.filter(like => like.dislike).length;
            },

            likesCount() {
                return this.article.likes.filter(like => like.like).length;
            },
        },

        methods: {
            getArticle() {
                axios.get("/articles/" + this.articleId).then(response => {
                    this.article = response.data.article;
                    this.syncLikeForm.like = response.data.article.user_like.like;
                    this.syncLikeForm.dislike = response.data.article.user_like.dislike;
                });
            },

            syncLike() {
                if (this.syncLikeForm.like) {
                    this.syncLikeForm.like = false;
                    this.syncLikeForm.dislike = false;
                } else if (this.syncLikeForm.dislike) {
                    this.syncLikeForm.like = true;
                    this.syncLikeForm.dislike = false;
                } else {
                    this.syncLikeForm.like = true;
                    this.syncLikeForm.dislike = false;
                }

                App.post("/articles/" + this.articleId + "/likes", this.syncLikeForm)
                    .then(() => {
                        this.getArticle()
                    });
            },

            syncDislike() {
                if (this.syncLikeForm.dislike) {
                    this.syncLikeForm.like = false;
                    this.syncLikeForm.dislike = false;
                } else if (this.syncLikeForm.like) {
                    this.syncLikeForm.like = false;
                    this.syncLikeForm.dislike = true;
                } else {
                    this.syncLikeForm.like = false;
                    this.syncLikeForm.dislike = true;
                }

                App.post("/articles/" + this.articleId + "/likes", this.syncLikeForm)
                    .then(() => {
                        this.getArticle()
                    });
            },

            createComment() {
                App.post("/articles/" + this.articleId + "/comments", this.createCommentForm)
                    .then(() => {
                        this.createCommentForm.body = null;
                        this.getArticle();
                    });
            },

            cancelComment() {
                this.createCommentForm.body = null;
            }
        },
    }
</script>

<style scoped>
    .active {
        color: dodgerblue;
    }
</style>
