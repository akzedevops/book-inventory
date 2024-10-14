@extends('layout')

@section('content')
    <h1>Edit Book</h1>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Title:</label>
        <input type="text" name="title" id="title" value="{{ $book->title }}">

        <label for="author">Author:</label>
        <input type="text" name="author" id="author" value="{{ $book->author }}">

        <label for="isbn">ISBN:</label>
        <input type="text" name="isbn" id="isbn" value="{{ $book->isbn }}">

        <label for="publisher">Publisher:</label>
        <input type="text" name="publisher" id="publisher" value="{{ $book->publisher }}">

        <label for="published_year">Published Year:</label>
        <input type="number" name="published_year" id="published_year" value="{{ $book->published_year }}">

        <label for="pages">Pages:</label>
        <input type="number" name="pages" id="pages" value="{{ $book->pages }}">

        <label for="language">Language:</label>
        <input type="text" name="language" id="language" value="{{ $book->language }}">

        <button type="submit">Update Book</button>
    </form>

    <a href="{{ route('books.index') }}">Back to Books List</a>
@endsection
