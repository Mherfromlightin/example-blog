@extends('layouts.app')

@section('header')
    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Create Category
        </h2>
    </div>
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white">
                    <create-category :categories="{{ $categories }}"></create-category>
                </div>
            </div>
        </div>
    </div>
@endsection