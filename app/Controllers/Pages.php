<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function story()
    {
        return view('pages/our-story');
    }

    public function services()
    {
        return view('pages/what-we-do');
    }
    public function work(){
        return view("pages/our-work");
    }

    public function careers()
    {
        return view('pages/careers');
    }
}
