@extends('layout')

@section('content')
    <h2>Update category</h2>
    <div class="col-md-12">
        <categories-form update="{{ $categoryId }}"></categories-form>
    </div>
@endsection