<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Translator;

class TranslatorsController extends Controller
{
function __construct()
    {
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Translators = Translator::all();
        return view('backend.pages.Translators.index', compact('Translators'));
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
        $request->validate([
            'name' => 'required|max:50',
            'link' => 'nullable|url',
            'description' => 'nullable',
            'book_id'=>'nullable'
        ]);


        $Translators = new Translator();
        $Translators->name = $request->name;
        $Translators->link = $request->link;
            $Translators->book_id=1;

        $Translators->description = $request->description;

        $Translators->save();

        session()->flash('success', 'Translators has been created !!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $request->validate([
            'name' => 'required|max:50',
            'link' => 'nullable|url',
            'description' => 'nullable',
        ]);

        $Translators = Translator::find($id);
        $Translators->name = $request->name;
        $Translators->link = $request->link;
        $Translators->description = $request->description;
        $Translators->save();

        session()->flash('success', 'Translators has been updated !!');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Translators = Translator::find($id);
        $Translators->delete();

        session()->flash('success', 'Translators has been deleted !!');
        return back();
    }
}
