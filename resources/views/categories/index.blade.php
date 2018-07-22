@extends('layout')

@section('content')
    <div class="col-md-12">
        <a href="{{ route('categories.create') }}" class="btn btn-success w-100 mb-3">Add new category <i class="fa fa-plus"></i></a>
    </div>
    <div class="col-md-12">
        <categories></categories>
    </div>
@endsection