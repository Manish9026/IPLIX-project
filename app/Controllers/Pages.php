<?php

namespace App\Controllers;
require_once APPPATH . 'Helpers/Utils.php';

use App\Helpers\Utils;
use App\Helpers\WorkService;


class Pages extends BaseController
{
    private static $workFile = "singleWork.json";
    private static $servicesFile = "services.json";
    private static $storyFile='story.json';
    private static $careerFile='career.json';



    public function heroData($section)
    {

        helper('utils');

        $result = \App\Helpers\Utils::getHeroData($section);

        return ['hero' => $result['data'] ?? []];
    }

    public function index(): string
    {
        $workList=Utils::read(self::$workFile);
        $services=Utils::read(self::$servicesFile)['services'] ?? [];

        
        return view('pages/index', array_merge($this->heroData("home"),[
            'services'=>Utils::getRandomList($services,5,'title'),
            'workList'=>Utils::getRandomList($workList,5,'id'),
        ]));
    }
    public function story()
    {

        $decoded = Utils::read(self::$storyFile) ?? [];
        $stats = $decoded['stats'] ?? [];
        $timeline = $decoded['timeline'] ?? [];
        $ourMission = $decoded['our_mission'] ?? [
            'title' => 'Our Mission',
            'description' => 'To empower businesses with innovative digital marketing solutions that drive growth and sustainability.',
            'image' => 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?w=600'
        ];
        $teamMembers = $decoded['team_members'] ?? [];
        $galleryItems = $decoded['gallery_items'] ?? [];

        return view(
            'pages/our-story',
            array_merge(
                compact('stats', 'timeline', 'ourMission', 'teamMembers', 'galleryItems'),
                $this->heroData("story")
            )
        );
        // return view('pages/our-story',);
    }

    public function services()
    {


        $decoded = Utils::read(self::$servicesFile) ?? [];

        $heroContent = $decoded['hero_content'] ?? [
            'title' => 'What We Do',
            'description' => 'We are a full-service creative agency dedicated to helping brands connect with their audience through innovative strategies and compelling storytelling. Our team of experts combines creativity with data-driven insights to deliver exceptional results.'
        ];
        $services = $decoded['services'] ?? [];
        $workflow = $decoded['workflow'] ?? [];

        return view('pages/what-we-do', array_merge(compact('services', 'workflow', 'heroContent'), $this->heroData("services")));
    }
    public function work()
    {

        $projects=WorkService::getMergedData();
        return view("pages/our-work", array_merge(compact('projects', ), $this->heroData("work")));
    }

    public function careers()
    {
        $career = Utils::read(self::$careerFile) ?? [];
        $perks = $career['perks'] ?? [];
        $openPositions = $career['open_positions'] ?? [];
        return view('pages/careers', array_merge(compact('perks', 'openPositions'), $this->heroData("career")));
    }

    public function contact()
    {


        $serviceData=Utils::read(self::$servicesFile) ?? [];
        $contact=Utils::read("contact.json");
        return view('pages/contact',array_merge($this->heroData("contact"),[
            "services"=> $serviceData['services'] ?? [],
            "info"=>$contact
        ]));
    }
    public function workCaseStudy($title=null){

        try{
            
            if(!empty($title)){
                $workList = WorkService::getWorks($title);
                if(empty($workList) || count($workList)<=0 || !is_array($workList)) throw new \Exception("Something went wrong!");

                return view('pages/singleWork',["workList"=>$workList[0]]);
            }


        }catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Unexpected error',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }

    }

    public function dashboard()
    {
        // This is a placeholder for the dashboard view
        // You can add your dashboard logic here
        return view('dashboard/index');
    }
}
