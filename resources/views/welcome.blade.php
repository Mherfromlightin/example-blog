@extends('landingLayouts.app')

@section('content')
    <div class="relative overflow-hidden">
        @include('partials._header')
        <main>
            @include('partials._hero')
            <article-section :articles="{{ $articles }}" :all_categories="{{ $allCategories }}"></article-section>
            @include('partials._cta')
        </main>
        @include('partials._footer')
    </div>
@endsection