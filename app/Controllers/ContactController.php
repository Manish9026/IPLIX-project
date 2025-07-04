<?php

namespace App\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Files\File;

class ContactController extends BaseController
{
    protected $jsonPath;

    public function __construct()
    {
        $this->jsonPath = WRITEPATH . 'data/contact.json';
        helper(['filesystem', 'text']);
    }

    private function readJson()
    {
        if (!file_exists($this->jsonPath)) {
            return [
                "company" => [],
                "contact" => [],
                "social" => [],
                "clients"=>[]
            ];
        }

        $raw = file_get_contents($this->jsonPath);
        $data = json_decode($raw, true);
        return is_array($data) ? $data : [];
    }
    private function writeJson(array $data): bool
    {
        return file_put_contents($this->jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
    }

    public function saveCompanyInfo()
    {
        $request = service('request');
        $validation = \Config\Services::validation();

        try {
            // Validate input
            $validation->setRules([
                'name'        => 'required|min_length[2]',
                'subTitle'    => 'permit_empty|string',
                'description' => 'required|min_length[10]',
                'logo'        => 'uploaded[logo]|is_image[logo]|max_size[logo,2048]', // Optional
            ]);

            // Skip logo validation if not uploaded
            if (!$request->getFile('logo')->isValid()) {
                unset($validation->getRules()['logo']);
            }

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validation->getErrors()
                ])->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Read posted data
            $name = $request->getPost('name');
            $subTitle = $request->getPost('subTitle') ?? '';
            $description = $request->getPost('description');
            $newLogoPath = null;

            // Load existing JSON
            $jsonPath = WRITEPATH . 'data/contact.json';
            $contactData = file_exists($jsonPath)
                ? json_decode(file_get_contents($jsonPath), true)
                : [];

            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to parse contact.json',
                    'error' => json_last_error_msg()
                ])->setStatusCode(500);
            }

            // Upload new logo if present
            $logoFile = $request->getFile('logo');
            if ($logoFile && $logoFile->isValid() && !$logoFile->hasMoved()) {
                $uploadPath = FCPATH . 'uploads/contact/company/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0777, true);
                }

                // Remove old file
                if (!empty($contactData['company']['logo'])) {
                    $oldPath = FCPATH . $contactData['company']['logo'];
                    if (file_exists($oldPath)) {
                        unlink($oldPath);
                    }
                }

                $newName = 'logo_' . time() . '.' . $logoFile->getExtension();
                $logoFile->move($uploadPath, $newName);
                $newLogoPath = 'uploads/contact/company/' . $newName;
            }

            // Update data
            $contactData['company'] = [
                'name' => $name,
                'subTitle' => $subTitle,
                'description' => $description,
                'logo' => $newLogoPath ?? ($contactData['company']['logo'] ?? '')
            ];

            // Save updated JSON
            file_put_contents($jsonPath, json_encode($contactData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Company info saved successfully',
                'data' => $contactData['company']
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Unexpected server error',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }




    public function saveContact()
    {
        $request = $this->request;
        $validation = \Config\Services::validation();

        try {
            $validation->setRules([
                'title' => 'required|string|min_length[2]',
                'value' => 'required|string',
                'icon' => 'permit_empty|string',
                'description' => 'permit_empty|string',
                'id' => 'permit_empty|string'
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validation->getErrors()
                ])->setStatusCode(422);
            }

            $id = $request->getPost('id') ?: uniqid();
            $title = $request->getPost('title');
            $icon = $request->getPost('icon');
            $value = $request->getPost('value');
            $description = $request->getPost('description');

            $data = $this->readJson();

            // Ensure array exists
            if (!isset($data['contact']) || !is_array($data['contact'])) {
                $data['contact'] = [];
            }

            // Check if updating existing contact
            $updated = false;
            foreach ($data['contact'] as &$item) {
                if ($item['id'] === $id) {
                    $item['title'] = $title;
                    $item['icon'] = $icon;
                    $item['value'] = $value;
                    $item['description'] = $description;
                    $updated = true;
                    break;
                }
            }

            // If not updated, it's new
            if (!$updated) {
                $data['contact'][] = [
                    'id' => $id,
                    'title' => $title,
                    'icon' => $icon,
                    'value' => $value,
                    'description' => $description
                ];
            }

            // Save back to JSON file
            $saved = file_put_contents($this->jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            if (!$saved) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save contact'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => $updated ? 'Contact updated' : 'Contact added',
                'data' => $data['contact']
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Unexpected error',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
    public function deleteContact($id)
    {
        try {
            $data = $this->readJson();

            if (!isset($data['contact'])) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'No contact data found'
                ])->setStatusCode(404);
            }

            $beforeCount = count($data['contact']);
            $data['contact'] = array_filter($data['contact'], fn($c) => $c['id'] !== $id);
            $afterCount = count($data['contact']);

            if ($beforeCount === $afterCount) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Contact not found'
                ])->setStatusCode(404);
            }

            file_put_contents($this->jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Contact deleted successfully',
                'data' => $data['contact']
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Error deleting contact',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    // social media controllers
    public function saveSocial(): ResponseInterface
    {
        $request = service('request');
        $validation = \Config\Services::validation();

        try {
            $validation->setRules([
                'title'  => 'required|min_length[2]',
                'link'   => 'permit_empty|valid_url',
                'icons'  => 'required|min_length[2]',
                'color'  => 'permit_empty',
                'isLink' => 'in_list[0,1]'
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validation->getErrors()
                ])->setStatusCode(422);
            }

            $data = $request->getPost();
            $id = $data['id'] ?? null;

            $json = $this->readJson();
            $social = $json['social'] ?? [];

            $entry = [
                'id'     => $id ??  uniqid(),
                'title'  => trim($data['title']),
                'link'   => trim($data['link'] ?? ''),
                'icons'  => trim($data['icons']),
                'color'  => trim($data['color'] ?? ''),
                'isLink' => $data['isLink'] ?? '1'
            ];

            $updated = false;

            foreach ($social as &$item) {
                if ($item['id'] === $id) {
                    $item = $entry;
                    $updated = true;
                    break;
                }
            }

            if (!$updated) {
                $social[] = $entry;
            }

            $json['social'] = $social;
            $this->writeJson($json);

            return $this->response->setJSON([
                'status' => true,
                'message' => $updated ? 'Updated successfully' : 'Added successfully',
                'data' => $entry
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Failed to save social data',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
    public function deleteSocial($id = null): ResponseInterface
    {
        try {
            if (!$id) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'ID is required'
                ])->setStatusCode(400);
            }

            $json = $this->readJson();
            $social = $json['social'] ?? [];

            $filtered = array_filter($social, fn($item) => $item['id'] !== $id);

            if (count($filtered) === count($social)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Item not found'
                ])->setStatusCode(404);
            }

            $json['social'] = array_values($filtered);
            $this->writeJson($json);

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Deleted successfully'
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Failed to delete item',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    // client fumctions


    // POST: /api/contact/clients/save
    public function saveClient()
    {
        $request = $this->request;

        try {
            $validation = \Config\Services::validation();
            $validation->setRules([
                'name'    => 'required|min_length[2]',
                'email'   => 'required|valid_email',
                'message' => 'required|min_length[5]',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validation->getErrors()
                ])->setStatusCode(ResponseInterface::HTTP_UNPROCESSABLE_ENTITY);
            }

            // Extract input
            $id       = $request->getPost('id') ?: uniqid();
            $name     = trim($request->getPost('name'));
            $email    = trim($request->getPost('email'));
            $service  = trim($request->getPost('service') ?? '');
            $mobNo    = trim($request->getPost('mobNo') ?? '');
            $message  = trim($request->getPost('message'));

            // Load file
              $data = $this->readJson();
            

            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'JSON Decode Error',
                    'error' => json_last_error_msg()
                ])->setStatusCode(500);
            }

            if (!isset($data['clients']) || !is_array($data['clients'])) {
                $data['clients'] = [];
            }

            // Check if updating existing
            $index = array_search($id, array_column($data['clients'], 'id'));

            $newClient = [
                'id'      => $id,
                'name'    => $name,
                'email'   => $email,
                'service' => $service,
                'mobNo'   => $mobNo,
                'message' => $message,
            ];

            if ($index !== false) {
                $data['clients'][$index] = $newClient;
            } else {
                $data['clients'][] = $newClient;
            }

            // Save JSON
            $saved=$this->writeJson($data);
            // $saved = file_put_contents($this->jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            if (!$saved) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save client'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Client saved successfully',
                'data' => $newClient
            ])->setStatusCode(201);
        } catch (\Throwable $e) {
            log_message('error', '[ClientsController::save] ' . $e->getMessage());
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    // DELETE: /api/contact/clients/delete
    public function deleteClient()
    {
        $request = $this->request;
        $id = $request->getPost('id');

        if (!$id) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Client ID is required'
            ])->setStatusCode(400);
        }

        $data = file_exists($this->jsonPath) ? json_decode(file_get_contents($this->jsonPath), true) : [];

        if (!isset($data['clients']) || !is_array($data['clients'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Clients list is empty'
            ])->setStatusCode(404);
        }

        $index = array_search($id, array_column($data['clients'], 'id'));

        if ($index === false) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Client not found'
            ])->setStatusCode(404);
        }

        array_splice($data['clients'], $index, 1);
        file_put_contents($this->jsonPath, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Client deleted successfully'
        ]);
    }
}
