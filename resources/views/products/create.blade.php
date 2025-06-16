@extends('layouts.app')

@section('title', 'Create Product')

@section('content')
    <h1>Create Product</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('products.store') }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title:</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description:</label>
            <textarea name="description" class="form-control">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Price (£):</label>
            <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Category:</label>
            <select name="category" class="form-select">
                @php
                    $categories = ['electronics', 'books', 'clothing', 'furniture', 'food'];
                @endphp
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ old('category') === $cat ? 'selected' : '' }}>
                        {{ ucfirst($cat) }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create Product</button>
    </form>

    <br>
    <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to products</a>
@endsection
