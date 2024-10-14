@extends('layout')

@section('content')
    <h1>Add New Book</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.store') }}" method="POST">
        @csrf
        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ old('title') }}">

        <label for="author">Author:</label>
        <input type="text" name="author" id="author" value="{{ old('author') }}">

        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" id="isbn" value="{{ old('isbn') }}">

        <label for="publisher">Publisher:</label>
        <input type="text" name="publisher" id="publisher" value="{{ old('publisher') }}">

        <label for="published_year">Published Year:</label>
        <input type="number" name="published_year" id="published_year" value="{{ old('published_year') }}">

        <label for="pages">Pages:</label>
        <input type="number" name="pages" id="pages" value="{{ old('pages') }}">

        <label for="language">Language:</label>
        <input type="text" name="language" id="language" value="{{ old('language') }}">

        <button type="submit">Add Book</button>
    </form>

    <a href="{{ route('books.index') }}">Back to Books List</a>
@endsection
