<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
 

class UsersController extends Controller
{
    //added by sradha
    function loadView($name=""){
      
if (View::exists('users')) {
    return view('users',['name'=>$name]);
}else{
    echo "view not found";
}
       
    }
}
