@extends('layout')

@section('content')
    <h1>{{ $book->title }}</h1>
    <p>Author: {{ $book->author }}</p>
    <p>ISBN: {{ $book->isbn }}</p>
    <p>Publisher: {{ $book->publisher }}</p>
    <p>Published Year: {{ $book->published_year }}</p>
    <p>Pages: {{ $book->pages }}</p>
    <p>Language: {{ $book->language }}</p>

    <a href="{{ route('books.index') }}">Back to Books List</a>
@endsection
