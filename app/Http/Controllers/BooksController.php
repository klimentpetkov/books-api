<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Constants;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Book::paginate(10), Constants::STATUS_PARTIAL_CONTENT);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $data = $request->only(['title', 'description', 'author']);
        $validator = $this->getValidator($data);
        if ($validator->fails())
            return response()->json($validator->errors(), Constants::STATUS_BAD_REQUEST);

        if (!Book()::create($data))
            return response()->json(['message' => Constants::RESOURCE_NOT_SAVED], Constants::STATUS_SERVICE_UNAVAILABLE);

        return response()->json(['message' => Constants::RESOURCE_SAVED], Constants::STATUS_OBJECT_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$book = Book::find($id))
            return response()->json(['message' => Constants::RESOURCE_NOT_FOUND], Constants::STATUS_NOT_FOUND);

        return response()->json(['data'=> $book], Constants::STATUS_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
     public function update(Request $request, $id)
     {

         if (!$book = Book::find($id))
             return response()->json(['message' => Constants::RESOURCE_NOT_FOUND], Constants::STATUS_NOT_FOUND);

         $data = array_replace_recursive($book->toArray(), request()->all());
         $validator = $this->getValidator($data);

         if ($validator->fails())
             return response()->json($validator->errors(), Constants::STATUS_BAD_REQUEST);

         unset($data['id']);
         $book->update($data);

         return response()->json(['message' => Constants::RESOURCE_SAVED], Constants::STATUS_OK);
     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!$book = Book::find($id))
            return response()->json(['message' => Constants::RESOURCE_NOT_FOUND], Constants::STATUS_NOT_FOUND);

        $book->delete();
        return response()->json(['message' => Constants::RESOURCE_DELETED], Constants::STATUS_NO_CONTENT);
    }

    /**
     * Returns a prepared validator for validating book data
     * @param $requestData array
     * @return \Illuminate\Support\Facades\Validator
     */
    private function getValidator($requestData)
    {
        return Validator::make($requestData,[
            'title' => 'required|max:255',
            'description' => 'required',
            'author.first_name' => 'required|max:255',
            'author.last_name' => 'required|max:255'
        ]);
    }
}
