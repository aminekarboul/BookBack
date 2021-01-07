<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function show(Book $book)
    {
        return $book;
    }

    public function store(Request $request)
    {
        {
            $user = auth()->guard('api')->user();
            $idd = $user->id;       
            
            $book = new Book;
            $book->title = $request->title;
            $book->author = $request->author;
            $book->description = $request->description;
            $book->idUser = $idd;
            $book->save();
            return response()->json(["message" => "Book record created"], 201);
        }
    }

    public function update(Request $request, Book $book)
    {
        $book->update($request->all());

        return response()->json($book);
    }

    public function delete(Book $book)
    {
        $book->delete();

        return response()->json(null, 204);
    }
}
