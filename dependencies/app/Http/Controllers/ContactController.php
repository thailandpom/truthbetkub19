<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
//Importing laravel-permission models

//Enables us to output flash messaging

class ContactController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = DB::table('contact')->get();
        return view('contact.index')->with('name', 'Contact')->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contact.create')->with('name', 'Contact');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return \Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

            DB::table('contact')->insertGetId(
                [
                    'name' => $request->name,
                    'type' => $request->type,
                    "created_at" => \Carbon\Carbon::now(),
                    "updated_at" => \Carbon\Carbon::now(),
                ]);
            return redirect()->route('contact.index')->with('flash_message', 'สร้างข้อมูลติดต่อเรียบร้อยแล้ว!!!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contacts = DB::table('contact')->where('id', $id)->first();
        return view('contact.edit')->with('name', 'Contact')->with('contacts', $contacts);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $id = $request->id;
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return \Redirect::back()->withInput()->withErrors($validation->messages());
        } else {

           
          DB::table('contact')->where('id', "=", $id)->update(array(
            'name' => $request->name,
            'type' => $request->type,
            "updated_at" => \Carbon\Carbon::now(),
        ));
            return redirect()->route('contact.index')->with('flash_message', 'แก้ไขข้อมูลติดต่อเรียบร้อยแล้ว!!!');
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
        DB::table('contact')->where('id', $id)->delete();
        return redirect()->route('contact.index')->with('flash_message', 'ลบข้อมูลติดต่อเรียบร้อยแล้ว');
    }
}
