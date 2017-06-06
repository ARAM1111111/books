<?php

namespace App\Http\Controllers;

use App\Book;
use App\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $books = Book::all();
        return view('pages.book.index',compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   

        $authors = Author::all();
        return view('pages.book.create',compact('authors'));
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
            'title'=>'required',
            'desc'=>'required|min:10',
            'name'=>'required',
        ]);


        //  $authors = Author::all();
        //  foreach ($authors as $key => $author) {
        //      $all_authors_id[] = $author->id;
        //  }
        //  if(in_array(6, $all_authors_id)) {
        //      dump('asasas');
        //  }
        // dump($all_authors_id);

        if($book = Book::create($request->except('name'))) {
            // Book::find($book->id)->authors()->save(new Author(['name'=>$request->name]));
             Book::find($book->id)->authors()->sync($request->name);
            return redirect()->route('book.index')->with("success","Book saved");
        } else return abort(401);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::findorFail($id);
        $authors = Author::all();

        foreach ($book->authors as  $author) {
            $author_id[] =  $author->id;
        }

        $checked_authors = $author_id;

        return view('pages.book.edit',compact('book', 'authors', 'checked_authors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required',
            'desc'=>'required|min:10',
            'name'=>'required',
        ]);

        $book = Book::findorFail($id);
        $author_id = $book->authors->first()->id;
        // dump($author_id);
        
        if($book->update($request->except('name'))) {
             // Author::where('id',$author_id)->update(['name'=>$request->name]);
             Book::find($book->id)->authors()->sync($request->name);
             return redirect()->route('book.index')->with("success","Book updated");
        } else return abort(401);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::findorFail($id); 
        if($book->authors->count() >0) {
            foreach ($book->authors as  $author) {
                $author_id[] =  $author->id;
            }
            $book->authors()->detach($author_id);
        }      
        

        $book->delete();
        return redirect()->route('book.index')->with("success","Book deleted");
    }
}
