@extends('layout')

@section('content')
    <h2>Update post</h2>
    <div class="col-md-12">
        <posts-form update="{{ $postId }}"></posts-form>
    </div>
@endsection