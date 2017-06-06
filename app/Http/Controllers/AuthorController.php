<?php

namespace App\Http\Controllers;

use App\Author;
use App\Book;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $authors =Author::all();
        return view('pages.author.index',compact('authors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.author.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,[
            'name'=>'required',
        ]);
  
        if($author = Author::create($request->except('_token'))) {
            return redirect()->route('author.index')->with("success","Author saved");
        } else return abort(401);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show(Author $author)
    {
       return view('pages.author.show',compact('author')); 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Author::findorFail($id);
        return view('pages.author.edit',compact('author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Author $author)
    {
         $this->validate($request,[
            'name'=>'required',
        ]);
  
        if($author->update($request->except('_token'))) {          
             return redirect()->route('author.index')->with("success","Author updated");
        } else return abort(401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy(Author $author)
    {
        // After deleted author,his book havent any writter then delete book 
        if($author->books->count() > 0) {
           foreach ($author->books as  $book) {
               $books_id[] =  $book->id;
           }
           $author->books()->detach($books_id);

           foreach ($books_id as $id) {
              if(Book::findorFail($id)->authors->count() == 0) {
                    Book::findorFail($id)->delete();
              }
           }
        }

        $author->delete();
        return redirect()->route('author.index')->with("success","Author deleted");
    }
}
