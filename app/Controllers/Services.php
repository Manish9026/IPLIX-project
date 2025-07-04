<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class Services extends Controller
{
    private $jsonPath;
    protected $session;
    protected $helpers = ['url', 'form'];

    public function __construct()
    {
        $this->jsonPath = WRITEPATH . 'data/services.json'; // CI4 safe path
        $this->session = \Config\Services::session();
    }

    private function requireLogin()
    {
        if (!$this->session->get('is_logged_in')) {
            return redirect()->to('/login');
        }
    }

    public function index()
    {
        $this->requireLogin();

        $data['media'] = file_exists($this->jsonPath)
            ? json_decode(file_get_contents($this->jsonPath), true)
            : [];

        return view('media_list', $data);
    }

    public function getById($id)
    {
        $filePath = WRITEPATH . 'data/services.json';

        if (!file_exists($filePath)) {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'File not found']);
        }

        $json = file_get_contents($filePath);
        if (empty($json)) {
            return $this->response->setStatusCode(500)->setJSON(['message' => 'File is empty']);
        }
        $services = json_decode($json, true);

        $found = null;
        foreach ($services["services"] as $service) {
            if ($service['id'] == $id) {
                $found = $service;
                break;
            }
        }

        if ($found) {
            return $this->response->setJSON($found);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['message' => 'Not found']);
        }
    }

    public function create()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        // Validate request
        $validation->setRules([
            'title'       => 'required',
            'description' => 'required',
            'icon'        => 'required',
            'features'    => 'required',
            'media' => 'uploaded[media]|max_size[media,10240]|mime_in[media,image/jpeg,image/png,video/mp4,video/webm]'
        ]);

        if (!$validation->withRequest($request)->run()) {
            log_message('error', 'Validation Failed: ' . print_r($validation->getErrors(), true));
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validation->getErrors()
            ])->setStatusCode(422);
        }

        // Load JSON
        $jsonData = file_exists($this->jsonPath) ? json_decode(file_get_contents($this->jsonPath), true) : [];

        if (!isset($jsonData['services']) || !is_array($jsonData['services'])) {
            $jsonData['services'] = [];
        }

        // Generate unique ID
        $newId = count($jsonData['services']) > 0 ? max(array_column($jsonData['services'], 'id')) + 1 : 1;

        // Handle file upload
        $file = $request->getFile('media');
        $mediaPath = '';
        $mediaType = "";
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $uploadPath = FCPATH . 'uploads/servicesmedia';
            $file->move($uploadPath, $newName);
            $mediaPath = 'uploads/servicesmedia/' . $newName;
            $mediaType = $file->getMimeType();
        }

        // Process features
        $featuresArray = array_map('trim', explode(',', $request->getPost('features')));
        function getRandomTailwindColorSet(): array
        {
            $colors = [
                'red',
                'orange',
                'amber',
                'yellow',
                'lime',
                'green',
                'emerald',
                'teal',
                'cyan',
                'sky',
                'blue',
                'indigo',
                'violet',
                'purple',
                'fuchsia',
                'pink',
                'rose'
            ];

            $baseColor = $colors[array_rand($colors)];
            $altColor  = $colors[array_rand($colors)];

            return [
                'gradient'    => "from-{$baseColor}-400 to-{$altColor}-400",
                'accentColor' => "{$baseColor}-400",
                'tagColor'    => "{$baseColor}-300",
                'alterColor' => $altColor
            ];
        }

        // Prepare new service object
        $newService = [
            'id'          => $newId,
            'title'       => $request->getPost('title'),
            'description' => $request->getPost('description'),
            'icon'        => $request->getPost('icon'),
            'media'       => $mediaPath,
            'features'    => $featuresArray,
            'isReversed'  => $request->getPost('isReversed') === 'on',
            'mediaType' => $mediaType,
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
            'isActive'   => true
        ];

        $jsonData['services'][] =   array_merge($newService, getRandomTailwindColorSet());

        // Save JSON
        file_put_contents($this->jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Service added successfully',
            'data'    => $newService
        ])->setStatusCode(201);
    }

    public function update($id)
    {
        $this->requireLogin();

        $request = \Config\Services::request();
        $title = $request->getPost('title');
        $description = $request->getPost('description');
        $file = $request->getFile('file');

        $items = json_decode(file_get_contents($this->jsonPath), true);

        foreach ($items as &$item) {
            if ($item['id'] == $id) {
                $item['title'] = $title;
                $item['description'] = $description;

                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $file->move(FCPATH . 'uploads/services_media', $newName);
                    $item['file'] = 'uploads/services_media/' . $newName;
                    $item['type'] = $file->getMimeType();
                }

                break;
            }
        }

        file_put_contents($this->jsonPath, json_encode($items, JSON_PRETTY_PRINT));
        return redirect()->to('/media')->with('success', 'Media updated successfully.');
    }

    public function delete($id)
    {
        // $jsonPath = WRITEPATH . 'data/data.json';

        if (!file_exists($this->jsonPath)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Data file not found'
            ])->setStatusCode(500);
        }

        $jsonData = json_decode(file_get_contents($this->jsonPath), true);

        if (!isset($jsonData['services']) || !is_array($jsonData['services'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid data structure'
            ])->setStatusCode(500);
        }

        $newServices = [];
        $deleted = false;

        foreach ($jsonData['services'] as $service) {
            if ($service['id'] == $id) {
                $deleted = true;

                // Delete associated media file
                if (isset($service['media']) && !empty($service['media'])) {
                    $filePath = FCPATH . $service['media'];
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
            } else {
                $newServices[] = $service;
            }
        }

        if (!$deleted) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Service not found'
            ])->setStatusCode(404);
        }

        $jsonData['services'] = $newServices;

        // Save updated JSON
        file_put_contents($this->jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Service deleted successfully'
        ])->setStatusCode(200);
    }
}
