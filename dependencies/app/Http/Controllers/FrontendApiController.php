<?php

namespace App\Http\Controllers;

use App;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendmailContact;

class FrontendApiController extends Controller
{

  public function getPage($slug) 
  {
    $pages = DB::table('pages')->where('slug', $slug)->first();
      return response()->json([
          'pages' => $pages,
      ], 200);
  }

  public function getContent($slug) 
  { 
    $pages = DB::table('pages')->where('slug', $slug)->first();
    $page_id = $pages->page_id;
    $widgets = DB::table('widget')->where('widget.page_fk_id', $page_id)->orderBy('order_widget', 'asc')->get();
    for($i = 0 ; $i < count($widgets) ; $i++) {
      $widget_contents = DB::table('widget_content')
      ->where('widget_content.widget_fk_Id', $widgets[$i]->widget_id)
      ->get();

      $slides = DB::table('image_slide')
      ->where('widget_id', $widgets[$i]->widget_id)
      ->where('status', 1)
      ->orderBy('order_num', 'asc')->get();
      $widgets[$i]->items = $widget_contents;
      $widgets[$i]->slides = $slides;
      
    }
      return response()->json([
          'widgets' => $widgets,
      ], 200);
  }

  public function getContact() 
  {
    $contacts = DB::table('contact')->get();
    $settings = DB::table('settings')->first();
      return response()->json([
          'contacts' => $contacts,
          'settings' => $settings,
      ], 200);
  }


}