@extends('landingLayouts.app')

@section('content')
        <main>
            @include('partials._hero')
            <article-section :articles="{{ $articles }}" :all_categories="{{ $allCategories }}"></article-section>
            @include('partials._cta')
        </main>
@endsection