<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

//Importing laravel-permission models

//Enables us to output flash messaging

class SettingController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $settings = DB::table('settings')->where('id', 1)->first();
        return view('setting.edit')->with('name', 'Setting')->with('settings', $settings);
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
        $id = 1;

        DB::table('settings')->where('id', "=", $id)->update(array(
            'register' => $request->register,
            'login' => $request->login,
            "updated_at" => \Carbon\Carbon::now(),
        ));
        return redirect()->route('settings.show', 'manage')
            ->with('flash_message', 'แก้ไขข้อมูลตั้งค่าเรียบร้อยแล้ว!!!');

    }

}
