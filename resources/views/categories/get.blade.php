@extends('layout')

@section('content')
    <div class="col-md-12">
        <a href="{{ route('posts.create') }}" class="btn btn-success w-100 mb-3">Add new post <i class="fa fa-plus"></i></a>
    </div>
    <div class="col-md-12">
        <category id="{{ $categoryId }}"></category>
    </div>
@endsection