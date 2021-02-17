<?php

namespace App\Http\Controllers;

use App\Classes\IdentifyTemplateClass;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
   public function selectTemplate(Request $request){
    
        $data = array();

        $db = json_decode($request->item, true);
        $d = $db['item'];
        
        //Store date, time, venue, title, items of the last meeting from front end into an array 
        array_push($data,$d["date"]);
        array_push($data,$d["time"]); 
        array_push($data,$d["venue"]);
        array_push($data,$d["title"]);
        array_push($data,$d["last"]);
        
        //Store and move uploaded file from front end. Store the file name into an array
        $file = $request->file->getClientOriginalName();
        $request->file->move(public_path('temp'), $file);
        array_push($data, $file);

      //   //Store meeting URL from front end into an array
        array_push($data, $d["url"]);

        //Store list of items in an array
        array_push($data,$d["l1"]);
        array_push($data,$d["l2"]);
        array_push($data,$d["l3"]);

      //   //Store minute item (only for T4) into the array
        array_push($data,$d["min"]);

      //   //Store and move uploaded image from front end. Store the file name into an array
        $image = $request->image->getClientOriginalName();
        $request->image->move(public_path('temp'), $image);
        array_push($data, $image);

      //   //Store template name from front end into an array
        array_push($data, $d["template"]);

      //   //Pass the array into IdentifyTemplateClass
        $obj = new IdentifyTemplateClass();
        $res = $obj->identifyTemplate($data);

        return $res;
   }
}
