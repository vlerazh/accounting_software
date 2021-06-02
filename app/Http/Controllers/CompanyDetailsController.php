<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CompanyDetailsController extends Controller
{
   public function details(){
       return config('company');
   }
}
