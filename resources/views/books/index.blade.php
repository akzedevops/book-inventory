@extends('layout')

@section('content')
    <h1>Books</h1>
    <a href="{{ route('books.create') }}">Add New Book</a>

    @if (session('success'))
        <div>
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach ($books as $book)
            <li>
                <strong>{{ $book->title }}</strong> by {{ $book->author }}
                <a href="{{ route('books.show', $book->id) }}">View</a> |
                <a href="{{ route('books.edit', $book->id) }}">Edit</a>
                <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection
