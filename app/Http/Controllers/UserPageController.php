<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserPageController extends Controller
{
    /*
     * Function to return the homepage
     * @return view welcome.blade
     */
    public function getHomePage(){
        return view('welcome');
    }
    /*
    * Function to return the homepage
    * @return view doneer.blade
    */
    public function getDoneerPage(){
        return view('doneer');
    }
}
