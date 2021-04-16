@extends('landingLayouts.app')

@section('content')
    <show-article :article-id="{{ $article->id }}"></show-article>
@endsection