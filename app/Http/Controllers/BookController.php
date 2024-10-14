<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Book Inventory API",
 *     version="1.0.0",
 *     description="API documentation for managing a book inventory"
 * )
 *
 * @OA\Schema(
 *     schema="Book",
 *     type="object",
 *     title="Book",
 *     required={"title", "author", "isbn"},
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="title", type="string", example="The Great Gatsby"),
 *     @OA\Property(property="author", type="string", example="F. Scott Fitzgerald"),
 *     @OA\Property(property="isbn", type="string", example="978-3-16-148410-0"),
 *     @OA\Property(property="publisher", type="string", example="Charles Scribner's Sons"),
 *     @OA\Property(property="published_year", type="integer", example=1925),
 *     @OA\Property(property="pages", type="integer", example=180),
 *     @OA\Property(property="language", type="string", example="English"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2024-10-11T14:48:00.000Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2024-10-11T14:48:00.000Z")
 * )
 */
class BookController extends Controller
{
    /**
     * @OA\Get(
     *     path="/books",
     *     tags={"Books"},
     *     summary="Get list of books",
     *     @OA\Response(
     *         response=200,
     *         description="Successful operation",
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/Book"))
     *     )
     * )
     */
    public function index()
    {
        $books = Book::all(); // Fetch all books from the database
        return view('books.index', compact('books')); // Pass books data to the view
    }

    /**
     * @OA\Get(
     *     path="/books/create",
     *     tags={"Books"},
     *     summary="Show form to create a new book",
     *     @OA\Response(
     *         response=200,
     *         description="Form for creating a new book"
     *     )
     * )
     */
    public function create()
    {
        return view('books.create'); // Return the create book form view
    }

    /**
     * @OA\Post(
     *     path="/books",
     *     tags={"Books"},
     *     summary="Create a new book",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "author", "isbn"},
     *             @OA\Property(property="title", type="string", example="The Great Gatsby"),
     *             @OA\Property(property="author", type="string", example="F. Scott Fitzgerald"),
     *             @OA\Property(property="isbn", type="string", example="978-3-16-148410-0"),
     *             @OA\Property(property="published_year", type="integer", example=1925),
     *             @OA\Property(property="pages", type="integer", example=180),
     *             @OA\Property(property="language", type="string", example="English")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Book created successfully"
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books',
        ]);

        // Create a new book in the database
        Book::create($request->all());

        // Redirect to the books list with success message
        return redirect()->route('books.index')->with('success', 'Book added successfully.');
    }

    /**
     * @OA\Get(
     *     path="/books/{id}",
     *     tags={"Books"},
     *     summary="Display a specific book",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Book ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book details",
     *         @OA\JsonContent(ref="#/components/schemas/Book")
     *     )
     * )
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book')); // Show details of the selected book
    }

    /**
     * @OA\Get(
     *     path="/books/{id}/edit",
     *     tags={"Books"},
     *     summary="Show form to edit an existing book",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Book ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Form for editing a book"
     *     )
     * )
     */
    public function edit(Book $book)
    {
        return view('books.edit', compact('book')); // Show the edit form for the book
    }

    /**
     * @OA\Put(
     *     path="/books/{id}",
     *     tags={"Books"},
     *     summary="Update an existing book",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Book ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"title", "author", "isbn"},
     *             @OA\Property(property="title", type="string", example="The Great Gatsby"),
     *             @OA\Property(property="author", type="string", example="F. Scott Fitzgerald"),
     *             @OA\Property(property="isbn", type="string", example="978-3-16-148410-0")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book updated successfully"
     *     )
     * )
     */
    public function update(Request $request, Book $book)
    {
        // Validate the request data
        $request->validate([
            'title' => 'required',
            'author' => 'required',
            'isbn' => 'required|unique:books,isbn,' . $book->id,
        ]);

        // Update the book details
        $book->update($request->all());

        // Redirect to the books list with success message
        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    /**
     * @OA\Delete(
     *     path="/books/{id}",
     *     tags={"Books"},
     *     summary="Delete a specific book",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="Book ID",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Book deleted successfully"
     *     )
     * )
     */
    public function destroy(Book $book)
    {
        $book->delete(); // Delete the book from the database

        // Redirect to the books list with success message
        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
