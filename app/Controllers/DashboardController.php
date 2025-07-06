<?php

namespace App\Controllers;

require_once APPPATH . 'Helpers/Utils.php';

use function PHPUnit\Framework\isEmpty;
use App\Helpers\Utils;
use App\Helpers\WorkService;

class DashboardController extends BaseController
{

    private static $workFile = "singleWork.json";
    private static $servicesFile = "services.json";
    private static $storyFile='story.json';
    private static $careerFile='career.json';
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

        return view('dashboard/story', ['story' => $jsonData]);
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

        $workList = Utils::read("singleWork.json");
        $services = Utils::read("services.json");
        $projects= WorkService::getMergedData();

        $result = Utils::getHeroData('home');
        $hero = !empty($result['data']) && isset($result['data']) ? $result["data"] : [];

        return view('dashboard/our-work', ['projects' => $projects,'services'=>$services, 'workList' => $workList, 'hero' => $hero]);
    }
    public function contact()
    {
        $filePath = WRITEPATH . 'data/contact.json';
        $data = file_exists($filePath)
            ? json_decode(file_get_contents($filePath), true)
            : [];
        return view('dashboard/contact', ["info" => $data]);
    }
    public function hero()
    {

        return view('dashboard/hero',);
    }
    public function manageWork()
    {


        return view('dashboard/singleWork',);
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
