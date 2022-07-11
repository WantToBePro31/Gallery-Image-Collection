@extends('layouts.main')

@section('content')
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-header">
                Detail Image
            </div>
            <div class="card-body">
                <p>Image Name : <strong> {{ $item->name }} </strong></p>
                <p>Image Display: <img src="{{ asset('/images/'.$item->image) }}" width="300px" height="150px" alt="{{ $item->name }}"> </p>
                <p>Image Description : {{ $item->description }} </p>
                <p>Image Price :
                    @if($item->price != null)
                        {{ $item->price }} 
                    @else
                        -
                    @endif
                </p>
            </div>
        </div>
    </div>
@endsection