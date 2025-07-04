<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class StoryController extends Controller
{

    private $jsonPath;
    protected $session;
    protected $helpers = ['url', 'form'];
        public function __construct()
    {
        $this->jsonPath = WRITEPATH . 'data/story.json'; // CI4 safe path
        $this->session = \Config\Services::session();
    }
}