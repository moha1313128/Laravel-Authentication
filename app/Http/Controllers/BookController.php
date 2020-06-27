<?php

namespace App\Http\Controllers;

use App\Http\Controllers\BaseController as BaseController;
use Illuminate\Http\Request;
use App\Book;
use Validator;
    
class BookController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return $this->sendResponse($books->toArray(), 'Books Viewed');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name'  => 'required',
            'details' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('error', $validator->errors());
        }

        $book = Book::create($input);
        return $this->sendResponse($book->toArray(), 'Book Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Booke::find($id);

        if(is_null($book)){
            return $this->sendError('error', 'Book Not Found');
        }

        return $this->sendResponse($book->toArray(), 'Book Showed');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name'  => 'required',
            'details' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('error', $validator->errors());
        }

        $book->name = $input['name'];
        $book->details = $input['details'];
        $book->save();

        return $this->sendResponse($book->toArray(), 'Book Updated');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return $this->sendResponse($book->toArray(), 'Book Deleted');
    }
}
