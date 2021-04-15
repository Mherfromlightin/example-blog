@extends('landingLayouts.app')

@section('content')
    <div class="relative overflow-hidden">
        <header class="relative">
            @include('partials._menu')
        </header>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <create-article :categories="{{ $categories }}"></create-article>
                    </div>
                </div>
            </div>
        </div>
        @include('partials._footer')
    </div>
@endsection