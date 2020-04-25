<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
//Importing laravel-permission models
use Spatie\Permission\Models\Permission;
//Enables us to output flash messaging

class PagesController extends Controller
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
      $pages = DB::table('pages')->get();
      return view('pages.index')->with('name', 'Pages')->with('pages', $pages);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('pages.create')->with('name', 'Pages');
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
        'slug' => 'required|string|max:255',
      ]);

      if ($validation->fails()) {
          return \Redirect::back()->withInput()->withErrors($validation->messages());
      } else {
        if ($request->hasFile('file')) {
          $imageFile = $request->file('file');
          $type = $imageFile->getClientOriginalExtension();
          if ($type != "") {
            $imageName = uniqid() . "." . preg_replace('/\s+/', '', $imageFile->getClientOriginalExtension());
            $imageFile->move(base_path('/../media/seo'), preg_replace('/\s+/', '', $imageName));

            DB::table('pages')->insertGetId(
            [
                'name' => $request->name,
                'slug' => $request->slug,
                'seo_title' => $request->seo_title,
                'seo_keyword' => $request->seo_keyword,
                'seo_description' => $request->seo_description,
                'seo_image' => $imageName,
                'page_static' => 1,
                'page_status' => 1,
                "created_at" => \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]);
            return redirect()->route('pages.index')->with('flash_message', 'สร้างหน้าเว็บเรียบร้อยแล้ว!!!');

          }
        }
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
      $pages = DB::table('pages')->where('page_id', $id)->first();
      return view('pages.edit')->with('name', 'Pages')->with('pages', $pages);
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

      $page_id = $request->page_id;
      $validation = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'slug' => 'required|string|max:255',
      ]);

      if ($validation->fails()) {
          return \Redirect::back()->withInput()->withErrors($validation->messages());
      } else {

        if ($request->hasFile('file')) {
          $imageFile = $request->file('file');
          $type = $imageFile->getClientOriginalExtension();
          if ($type != "") {
            $imageName = uniqid() . "." . preg_replace('/\s+/', '', $imageFile->getClientOriginalExtension());
            $imageFile->move(base_path('/../media/seo'), preg_replace('/\s+/', '', $imageName));

            DB::table('pages')->where('page_id', "=", $page_id)->update(array(
              'name' => $request->name,
              'slug' => $request->slug,
              'seo_title' => $request->seo_title,
              'seo_keyword' => $request->seo_keyword,
              'seo_description' => $request->seo_description,
              'seo_image' => $imageName,
              "updated_at" => \Carbon\Carbon::now(),
            ));
          }
        }else{
          DB::table('pages')->where('page_id', "=", $page_id)->update(array(
            'name' => $request->name,
            'slug' => $request->slug,
            'seo_title' => $request->seo_title,
            'seo_keyword' => $request->seo_keyword,
            'seo_description' => $request->seo_description,
            "updated_at" => \Carbon\Carbon::now(),
          ));
        }
        return redirect()->route('pages.index')->with('flash_message', 'แก้ไขหน้าเว็บเรียบร้อยแล้ว!!!');
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
      DB::table('pages')->where('page_id', $id)->delete();
      return redirect()->route('pages.index')->with('flash_message', 'ลบหน้าเว็บเรียบร้อยแล้ว');
    }
}
