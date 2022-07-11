@extends('layouts.main')

@section('content')
    <div class="col-md-6 col-lg-4">
        <form action="{{ route('gallery.update', $item->id) }}" method="post" class="card" enctype="multipart/form-data">
            <div class="card-header">
                Add new image
            </div>
            <div class="card-body">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="" class="form-label">Image Name</label>
                    <input type="text" name="name" value="{{ old('name', $item->name) }}" class="form-control @error('name') is-invalid @enderror">
                    @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Upload Image</label>
                    <input type="file" name="image" value="{{ old('image', $item->image) }}" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image Description</label>
                    <textarea name="description" value="{{ old('description', $item->description) }}" maxlength="500" class="form-control @error('description') is-invalid @enderror">{{ $item->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Image Price</label>
                    <input type="number" name="price" value="{{ old('price', $item->price) }}" class="form-control @error('price') is-invalid @enderror" step=".01">
                    @error('price')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Update Collection</button>
                </div>
            </div>
        </form>
    </div>
@endsection