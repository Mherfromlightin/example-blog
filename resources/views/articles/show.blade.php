@extends('landingLayouts.app')

@section('content')
    <div class="relative overflow-hidden">
        <header class="relative">
            @include('partials._menu')
        </header>
        <show-article :article-id="{{ $article->id }}"></show-article>
        @include('partials._footer')
    </div>
@endsection