<?php

namespace App\Http\Controllers;

use App\Http\Resources\noteresources;
use App\Models\Notes;
use Illuminate\Http\Request;

class notescontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes=Notes::paginate(10);
        return noteresources::collection($notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $notes=new Notes();
        $notes->title=$request->title;
        $notes->subject=$request->subject;
        if($notes->save()){
            return new noteresources($notes);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notes=Notes::findorFail($id);
        return new noteresources($notes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        $notes=Notes::findorFail($id);
        $notes->title=$request->title;
        $notes->subject=$request->subject;
        if($notes->save())
        {
            return new noteresources($notes);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notes=Notes::findorFail($id);
        if($notes->delete){
            return new noteresources($notes);
        }
    }
}
