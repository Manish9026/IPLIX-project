<?php

namespace App\Controllers;

use function PHPUnit\Framework\isEmpty;
use App\Helpers\Utils;

class DashboardController extends BaseController
{
    public function index()
    {
        return view('dashboard/index');
    }

    public function home()
    {
        
         return view('dashboard/home',);
    }
    public function story()
    {

    $jsonPath = WRITEPATH . 'data/story.json';
    $jsonData = [];

    if (file_exists($jsonPath)) {
        $content = file_get_contents($jsonPath);
        $jsonData = json_decode($content, true);
    }

     return view('dashboard/story',['story' => $jsonData]);
    }
    public function services()
    {
        $filePath = WRITEPATH . 'data/services.json';
        $data = file_exists($filePath)
            ? json_decode(file_get_contents($filePath), true)
            : [];

        return view('dashboard/services', ['data' => $data]);
    }

    public function career()
    {
        return view('dashboard/career');
    }
    public function ourWork()
    {
        $filePath = WRITEPATH . 'data/work.json';
        $servicesPath = WRITEPATH . 'data/services.json';
        $services = file_exists($servicesPath)
            ? json_decode(file_get_contents($servicesPath), true)
            : [];
        // $services=$services['services'];
        $data = file_exists($filePath)
            ? json_decode(file_get_contents($filePath), true)
            : [];
                    $result = Utils::getHeroData('home');
         $hero=!empty($result['data']) && isset($result['data'])?$result["data"]:[];
        // echo(isEmpty($data['data']));

        return view('dashboard/our-work', ['services' => $services["services"],'projects'=> $data["projects"],'hero'=>$hero]);
            //   return view('dashboard/our-work', ['projects'=> $data["projects"]]);
    }
    public function contact()
    {
         $filePath = WRITEPATH . 'data/contact.json';
         $data = file_exists($filePath)
            ? json_decode(file_get_contents($filePath), true)
            : [];
        return view('dashboard/contact',["info"=>$data]);
    }
    public function hero(){

         return view('dashboard/hero',);
    }


    // public function about()
    // {
    //     return view('dashboard/about');
    // }

    // public function notifications()
    // {
    //    return view('dashboard/services');
    // }
}
