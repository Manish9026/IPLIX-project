<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Helpers\Utils;
class HeroController extends Controller
{

    private $jsonPath;
    protected $session;
    protected $helpers = ['url', 'form'];
        public function __construct()
    {
        $this->jsonPath = WRITEPATH . 'data/heroContent.json'; // CI4 safe path
        $this->session = \Config\Services::session();
    }

    public function saveHeroContent()
{
    $request = \Config\Services::request();
    $validation = \Config\Services::validation();

    try {
        // 1. Validate required fields
        $validation->setRules([
            'section'        => 'required|in_list[home,story,services,work,contact,career]',
            'title'          => 'required|min_length[2]',
            // 'gradientTitle'  => 'required|min_length[2]',
            // 'subTitle'       => 'required|min_length[2]',
            // 'description'    => 'required|min_length[10]',
        ]);

        if (!$validation->withRequest($request)->run()) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Validation failed',
                'errors'  => $validation->getErrors()
            ])->setStatusCode(422);
        }

        // 2. Extract form data
        $section = $request->getPost('section');
        $id      = $request->getPost('id') ?: uniqid();
        $title   = $request->getPost('title');
        $gradientTitle = $request->getPost('gradientTitle') ?? "";
        $subTitle = $request->getPost('subTitle');
        $description = $request->getPost('description') ?? "";
        $btns = $request->getPost('btn'); // Optional array of buttons

        // 3. Load JSON
        $jsonPath = WRITEPATH . 'data/heroContent.json';
        $jsonData = [];

        if (file_exists($jsonPath)) {
            $jsonRaw = file_get_contents($jsonPath);
            $jsonData = json_decode($jsonRaw, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'JSON Decode Error',
                    'error' => json_last_error_msg()
                ])->setStatusCode(500);
            }
        }

        // 4. Ensure section exists
        if (!isset($jsonData[$section]) || !is_array($jsonData[$section])) {
            $jsonData[$section] = [];
        }

        // 5. Prepare new/updated content
        $newData = [
            'id'            => $id,
            'title'         => $title,
            'gradientTitle' => $gradientTitle,
            'subTitle'      => $subTitle,
            'description'   => $description,
        ];

        // 6. Handle button array
        $newData['btn'] = [];

        if (is_array($btns)) {
            foreach ($btns as $btn) {
                if (!empty($btn['label']) && !empty($btn['link'])) {
                    $newData['btn'][] = [
                        'label'  => $btn['label'],
                        'link'   => $btn['link'],
                        'design' => $btn['design'] ?? 'primary'
                    ];
                }
            }
        }

        // 7. Compare and update only changed fields
        $existing = $jsonData[$section];
        foreach ($newData as $key => $value) {
            if (!isset($existing[$key]) || $existing[$key] !== $value) {
                $jsonData[$section][$key] = $value;
            }
        }

        // 8. Save to JSON file
        $saved = file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        if (!$saved) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Failed to save file'
            ])->setStatusCode(500);
        }

        return $this->response->setJSON([
            'status' => true,
            'message' => "Hero content for '$section' saved successfully",
            'data' => $jsonData[$section]
        ])->setStatusCode(201);

    } catch (\Throwable $e) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Unexpected server error',
            'error' => $e->getMessage()
        ])->setStatusCode(500);
    }
}

public function getHeroData($section = null)
{
    if (!$section) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Section parameter is required.'
        ])->setStatusCode(400);
    }

    helper('utils'); // Make sure your getHeroData helper is loaded

    $result = \App\Helpers\Utils::getHeroData($section);

    return $this->response->setJSON($result)->setStatusCode($result['status'] ? 200 : 404);
}

}