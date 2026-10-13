<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\View\View;

class BookController extends Controller
{
    public function show(string $slug): View
    {
        $book = Book::with(['author', 'category'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('books.show', compact('book'));
    }
}