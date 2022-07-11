@extends('layouts.main')

@section('content')
    <a href="{{ route('gallery.create') }}" class="btn btn-primary my-2">Add new image</a>
    <div class="card mb-5 my-3">
        <div class="card-body p-0 text-center">
            <table class="table table-striped table-hover m-0">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach($galleries as $item)
                        <tr>
                            <td> {{ $item->id }} </td>
                            <td> {{ $item->name }} </td>
                            <td> <img src="{{ asset('/images/'.$item->image) }}" width="300px" height="150px" alt="{{ $item->name }}"> </td>
                            <td> {{ $item->description }} </td>
                            <td> 
                            @if($item->price != null)
                                {{ $item->price }} 
                            @else
                                -
                            @endif
                            </td>
                            <td>
                                <div style="display: flex; justify-content: center; grid-column-gap: 10px">
                                    <a href="{{ route('gallery.show', $item->id) }}" class="btn btn-warning btn-sm">View</a>
                                    <a href="{{ route('gallery.edit', $item->id) }}" class="btn btn-primary btn-sm">Update</a>
                                    <form action="{{ route('gallery.destroy', $item->id) }}" method="post">
                                        @csrf
                                        @method('delete')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</a>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection