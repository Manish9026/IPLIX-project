<?php

namespace App\Controllers;

use App\Helpers\Utils;

class Pages extends BaseController
{
    public function heroData($section)
    {

        helper('utils');

        $result = \App\Helpers\Utils::getHeroData($section);

        return ['hero' => $result['data'] ?? []];
    }

    public function index(): string
    {
        return view('pages/index', $this->heroData("home"));
    }
    public function story()
    {
        $file = WRITEPATH . 'data/story.json';

        if (!file_exists($file)) {
            throw new \RuntimeException("File not found: $file");
        }

        $json = file_get_contents($file);
        $decoded = json_decode($json, true);

        // $data['timeline'] = $decoded['timeline'] ?? [];
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

        $file = WRITEPATH . 'data/services.json';
        if (!file_exists($file)) {
            throw new \RuntimeException("File not found: $file");
        }
        $decoded = json_decode(file_get_contents($file), true);

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
        $file = WRITEPATH . 'data/work.json';
        if (!file_exists($file)) {
            throw new \RuntimeException("File not found: $file");
        }
        $decoded = json_decode(file_get_contents($file), true);
        $heroContent = $decoded['hero_content'] ?? [
            'title' => 'Our',
            'gradient_text' => 'Work',
            'description' => 'Explore our diverse portfolio of innovative projects that showcase our expertise in brand strategy, creative campaigns, and digital growth. Each project reflects our commitment to excellence and our passion for helping brands succeed.'
        ];
        $projects = $decoded['projects'] ?? [];

        return view("pages/our-work", array_merge(compact('projects', 'heroContent'), $this->heroData("work")));
    }

    public function careers()
    {
        $file = WRITEPATH . 'data/career.json';

        if (!file_exists($file)) {
            throw new \RuntimeException("File not found: $file");
        }

        $json = file_get_contents($file);
        $decoded = json_decode($json, true);
        $heroContent = $decoded['hero_content'] ?? [
            'title' => 'Your Future Starts Here',
            'gradient_text' => 'Work',
            'description' => 'Join a team of innovators, creators, and leaders. We\'re not just building careers—we\'re shaping the future of digital excellence.'
        ];
        $perks = $decoded['perks'] ?? [];
        $openPositions = $decoded['open_positions'] ?? [];
        return view('pages/careers', array_merge(compact('heroContent', 'perks', 'openPositions'), $this->heroData("career")));
    }

    public function contact()
    {

         $file = WRITEPATH . 'data/services.json';
        if (!file_exists($file)) {
            throw new \RuntimeException("File not found: $file");
        }
        $decoded = json_decode(file_get_contents($file), true);

        return view('pages/contact',array_merge($this->heroData("contact"),[
            "services"=> $decoded['services'] ?? []
        ]));
    }

    public function dashboard()
    {
        // This is a placeholder for the dashboard view
        // You can add your dashboard logic here
        return view('dashboard/index');
    }
}
