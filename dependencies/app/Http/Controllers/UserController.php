<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\User;
use Auth;
//Importing laravel-permission models
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
//Enables us to output flash messaging
use Session;

class UserController extends Controller {

    public function __construct() {
        $this->middleware(['auth']); //isAdmin middleware lets only users with a //specific permission permission to access these resources
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //Get all users and pass it to the view
        $users = User::orderBy('id', 'desc')->where('id', '!=', 1)->get();
        return view('users.index')->with('name', "Users")->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //Get all roles and pass it to the view
        // $roles = Role::get();
        return view('users.create')->with('name', "Users");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {


        $user = User::create($request->only('email', 'name', 'password')); //Retrieving only 
        return redirect()->route('users.index')
                        ->with('flash_message', 'Insert Data successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        return redirect()->route('users.index')->with('name', "Users");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $user = User::findOrFail($id); //Get user with specified id

        return view('users.edit', compact('user'))->with('name', "Users"); //pass user and roles data to view
    }

    public function edit_profile($id) {
        $user = User::findOrFail($id); //Get user with specified id

        return view('users.edit_profile', compact('user'))->with('name', "Users"); //pass user and roles data to view
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $id = $request->id;
        $user = User::findOrFail($id); //Get role specified by id
        // $user = DB::table('users')->where('id', $id)->get();
        // return dd($request->password);
        $input = $request->only(['name', 'email', 'password']); 
        DB::table('users')->where('id', "=", $id)->update(array(
            "name" => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ));
        return redirect()->route('users.index')
                        ->with('flash_message', 'Update Data successfully');
    }

    public function profile_store(Request $request) {
        $user_id = $request->user_id;
        $users = DB::table('users')->select('id')->where('id', $user_id)->first();
        // validate the input
//         $validation = Validator::make($request->all(), [
//                     'name' => 'required|string|max:255',
//                     'email' => 'required|string|email|max:255|unique:users,email,' . $users->id,
//                     'password_current' => 'required|string|min:6',
//         ]);
// // redirect on validation error
//         if ($validation->fails()) {
//             // change below as required
//             return \Redirect::back()->withInput()->withErrors($validation->messages());
//         } else {

        $check = DB::table('users')->where('id', $users->id)->first();
        // $test = (\Hash::check($request->password_current, $check->password));
        //return dd($test);
        if (\Hash::check($request->password_current, $check->password)) {

            if (isset($request->password) and ! empty($request->password)) {
                if ($request->password == $request->password_confirmation) {
                    DB::table('users')->where('id', $users->id)->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'password' => bcrypt($request->password),
                        "updated_at" => \Carbon\Carbon::now()
                    ]);
                } else {
                    return redirect()->route('edit_profile', $user_id)->with('flash_message_errors', 'รหัสผ่าน และ ยืนยันรหัสผ่าน ไม่ตรงกัน');
                }
            } else {
                DB::table('users')->where('id', $users->id)->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    "updated_at" => \Carbon\Carbon::now()
                ]);
            }
            return redirect()->route('edit_profile', $user_id)->with('flash_message', 'Update Profile successfully');
        } else {
            return redirect()->route('edit_profile', $user_id)->with('flash_message_errors', 'รหัสผ่านปัจจุบันไม่ถูกต้อง');
        }
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //Find a user with a given id and delete
        $user = User::findOrFail($id);

        if ($user->email == Auth::user()->email) {
            return redirect()->route('users.index')
                            ->with('danger', 'ไม่สามารถลบบัญชีผู้ใช้นี้ได้ เนื่องจากคุณกำลังเข้าสู่ระบบด้วยบัญชีผู้ใช้นี้');
        } else {
            $user->delete();
            return redirect()->route('users.index')
                            ->with('flash_message', 'Delete Data successfully');
        }
    }

    public function destroyMany(Request $request) {
        if ($request->multi_id != null) {
            $users = User::findOrFail($request->multi_id);

            //Make it impossible to delete this specific permission
            $msg = "";
            $count_error = 0;
            $count_delete = 0;
            foreach ($users as $user) {
                if ($user->email == Auth::user()->email) {
                    $msg .= $user->email;
                    $count_error++;
                } else {
                    $user->delete();
                    $count_delete++;
                }
            }
            if ($count_error != 0 && $count_delete != 0) {
                return redirect()->route('users.index')
                                ->with(['flash_message' =>
                                    'Users deleted.', 'danger' => 'ไม่สามารถลบบัญชี ' . $msg . " เนื่องจากคุณกำลังเข้าสู่ระบบด้วยบัญชีผู้ใช้นี้"]);
            } else if ($count_error == 0 && $count_delete != 0) {
                return redirect()->route('users.index')
                                ->with(['flash_message' =>
                                    'Delete Data successfully']);
            } else if ($count_error != 0 && $count_delete == 0) {
                return redirect()->route('users.index')
                                ->with(['danger' => 'ไม่สามารถลบบัญชี ' . $msg . " เนื่องจากคุณกำลังเข้าสู่ระบบด้วยบัญชีผู้ใช้นี้"]);
            }
        } else {
            return redirect()->route('users.index')
                            ->with('warning', 'กรุณาเลือกบัญชีผู้ใช้อย่างน้อย 1 บัญชี');
        }
    }

}
