@extends('layouts.app')

@section('header')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Article
        </h2>
    </div>
@endsection

@section('content')
    <div class="relative bg-white">
        <div class="lg:absolute lg:inset-0">
            <div class="lg:absolute lg:inset-y-0 lg:left-0 lg:w-1/2">
                <img class="h-56 w-full object-cover lg:absolute lg:h-full"
                     src="{{ asset("storage/articles/{$article->photo}") }}"
                     alt="">
            </div>
        </div>
        <div class="relative pt-12 pb-16 px-4 sm:pt-16 sm:px-6 lg:px-8 lg:max-w-7xl lg:mx-auto lg:grid lg:grid-cols-2">
            <div class="lg:col-start-2 lg:pl-8">
                <div class="text-base max-w-prose mx-auto lg:max-w-lg lg:ml-auto lg:mr-0">

                    <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $article->author->name }}</h3>
                    <h2 class="leading-6 text-indigo-600 font-semibold tracking-wide uppercase">{{ $article->published_at->format('M d, Y') }}</h2>
                    @foreach($article->categories as $category)
                        <h2 class="leading-6 text-indigo-600 font-semibold tracking-wide uppercase">{{ $category->name }}</h2>
                    @endforeach
                    <h3 class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $article->name }}</h3>
                    <p class="mt-8 text-lg text-gray-500">{{ $article->description }}</p>
                    <button type="submit"
                            class="float-right inline-flex items-center ml-1 px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                        Like
                    </button>
                    <button type="submit"
                            class="float-right inline-flex items-center ml-1 px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                        Dislike
                    </button>
                    <div class="mt-5 prose prose-indigo text-gray-500">
                        <h1>Comments</h1>
                        @foreach($article->comments as $comment)
                            <p>{{ $comment->author->name }}</p>
                            <hr>
                            <p>{{ $comment->body }}</p>
                        @endforeach
                        <form action="/comments" method="POST">
                            @csrf
                            <input type="hidden" name="article_id" value="{{ $article->id }}">
                            <input type="hidden" name="author_id" value="{{ $article->author->id }}">
                            <div class="sm:col-span-2">
                                <label for="body" class="block text-sm font-medium text-gray-700">Comment</label>
                                <div class="mt-1">
                                <textarea id="body" name="body" rows="4"
                                          class="py-3 px-4 block w-full shadow-sm focus:ring-indigo-500 focus:border-indigo-500 border-gray-300 rounded-md"></textarea>
                                </div>
                            </div>
                            <button type="submit"
                                    class="float-right inline-flex items-center ml-1 px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-green-700 bg-green-100 hover:bg-green-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                                Publish
                            </button>
                        </form>
                        <a href="#" type="button"
                           class="float-right inline-flex items-center px-2.5 py-1.5 border border-transparent text-xs font-medium rounded text-red-700 bg-red-100 hover:bg-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection