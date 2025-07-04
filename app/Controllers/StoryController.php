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
    public  function getRandomTailwindColorSet(): array
    {
        $colors = ['red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose'];
        $baseColor = $colors[array_rand($colors)];
        $altColor  = $colors[array_rand($colors)];

        return [
            'gradient'    => "from-{$baseColor}-400 to-{$altColor}-400",
            'accentColor' => "{$baseColor}-400",
            'tagColor'    => "{$baseColor}-300",
            'alterColor'  => $altColor,
            'baseColor' => $baseColor
        ];
    }
    public function addTimeline()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        try {
            // Step 1: Validate request input
            $validation->setRules([
                'year'        => 'required',
                'color'       => 'required',
                'title'       => 'required',
                'description' => 'required',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validation->getErrors()
                ])->setStatusCode(422);
            }

            // Step 2: Load existing JSON data
            $jsonPath = $this->jsonPath;
            $jsonData = [];

            if (file_exists($jsonPath)) {
                $jsonContent = file_get_contents($jsonPath);
                $jsonData = json_decode($jsonContent, true);

                // Handle JSON decode error
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Invalid JSON format in storage file.',
                        'error' => json_last_error_msg()
                    ])->setStatusCode(500);
                }
            }

            // Ensure timeline key exists
            if (!isset($jsonData['timeline']) || !is_array($jsonData['timeline'])) {
                $jsonData['timeline'] = [];
            }

            // Step 3: Prepare new timeline entry
            $newTimeline = array_merge($this->getRandomTailwindColorSet(), [
                'id'          => count($jsonData['timeline']) + 1,
                'year'        => $request->getPost('year'),
                'color'       => $request->getPost('color'),
                'title'       => $request->getPost('title'),
                'description' => $request->getPost('description'),
            ]);

            // Step 4: Append new item
            $jsonData['timeline'][] = $newTimeline;

            // Step 5: Save updated JSON
            $saveSuccess = file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

            if ($saveSuccess === false) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save data to file.'
                ])->setStatusCode(500);
            }

            // Step 6: Return success response
            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Timeline added successfully',
                'data'    => $newTimeline
            ])->setStatusCode(201);
        } catch (\Throwable $e) {
            // Catch any unexpected server error
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function saveTimeline()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        try {
            // Step 1: Validate request input
            $validation->setRules([
                'year'        => 'required',
                'color'       => 'required',
                'title'       => 'required',
                'description' => 'required',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validation->getErrors()
                ])->setStatusCode(422);
            }

            // Step 2: Load existing JSON data
            $jsonPath = $this->jsonPath;
            $jsonData = [];

            if (file_exists($jsonPath)) {
                $jsonContent = file_get_contents($jsonPath);
                $jsonData = json_decode($jsonContent, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Invalid JSON format in storage file.',
                        'error' => json_last_error_msg()
                    ])->setStatusCode(500);
                }
            }

            // Step 3: Ensure timeline array exists
            if (!isset($jsonData['timeline']) || !is_array($jsonData['timeline'])) {
                $jsonData['timeline'] = [];
            }

            $inputId = $request->getPost('id');

            if (!empty($inputId)) {
                // -------------------------------
                // 🔁 UPDATE Mode
                // -------------------------------
                $updated = false;

                foreach ($jsonData['timeline'] as &$item) {
                    if ($item['id'] == $inputId) {
                        // Only update changed fields
                        $item['year']        = $request->getPost('year') ?? $item['year'];
                        $item['color']       = $request->getPost('color') ?? $item['color'];
                        $item['title']       = $request->getPost('title') ?? $item['title'];
                        $item['description'] = $request->getPost('description') ?? $item['description'];
                        $updated = true;
                        break;
                    }
                }

                if (!$updated) {
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Timeline item with given ID not found.'
                    ])->setStatusCode(404);
                }

                $message = 'Timeline updated successfully';
                $responseData = $item;
            } else {
                // -------------------------------
                // ➕ ADD Mode
                // -------------------------------
                $newTimeline = array_merge($this->getRandomTailwindColorSet(), [
                    'id'          => count($jsonData['timeline']) + 1,
                    'year'        => $request->getPost('year'),
                    'color'       => $request->getPost('color'),
                    'title'       => $request->getPost('title'),
                    'description' => $request->getPost('description'),
                ]);

                $jsonData['timeline'][] = $newTimeline;
                $message = 'Timeline added successfully';
                $responseData = $newTimeline;
            }

            // Step 4: Save JSON
            $saved = file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

            if ($saved === false) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to write data to file.'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => $message,
                'data'    => $responseData
            ])->setStatusCode(201);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Server error occurred',
                'error'   => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function deleteTimeline($id = null)
    {
        try {
            // Validate ID
            if (!$id || !is_numeric($id)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Invalid or missing timeline ID.'
                ])->setStatusCode(400);
            }

            $jsonPath = $this->jsonPath;
            $jsonData = [];

            // Load existing file
            if (file_exists($jsonPath)) {
                $jsonContent = file_get_contents($jsonPath);
                $jsonData = json_decode($jsonContent, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Invalid JSON format.',
                        'error' => json_last_error_msg()
                    ])->setStatusCode(500);
                }
            }

            // Ensure timeline array exists
            if (!isset($jsonData['timeline']) || !is_array($jsonData['timeline'])) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Timeline data not found.'
                ])->setStatusCode(404);
            }

            // Find and delete the item
            $originalCount = count($jsonData['timeline']);
            $jsonData['timeline'] = array_values(array_filter($jsonData['timeline'], function ($item) use ($id) {
                return $item['id'] != $id;
            }));

            if (count($jsonData['timeline']) === $originalCount) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Timeline item not found.'
                ])->setStatusCode(404);
            }

            // Save back to file
            $saved = file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

            if (!$saved) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save updated data.'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Timeline item deleted successfully.'
            ])->setStatusCode(200);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Server error occurred.',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }


    // stats controller

    public function saveStats()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        try {
            // Validate input fields
            $validation->setRules([
                'icon'  => 'required|string',
                'value' => 'required|string',
                'label' => 'required|string',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validation->getErrors()
                ])->setStatusCode(422);
            }

            // Load existing JSON data
            $jsonPath = $this->jsonPath;
            $jsonData = [];

            if (file_exists($jsonPath)) {
                $jsonRaw = file_get_contents($jsonPath);
                $jsonData = json_decode($jsonRaw, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    return $this->response->setJSON([
                        'status'  => false,
                        'message' => 'Invalid JSON format',
                        'error'   => json_last_error_msg()
                    ])->setStatusCode(500);
                }
            }

            // Ensure stats array exists
            if (!isset($jsonData['stats']) || !is_array($jsonData['stats'])) {
                $jsonData['stats'] = [];
            }

            $id = $request->getPost('id'); // optional for update
            $isUpdate = !empty($id) && is_numeric($id);
            $updated = false;

            if ($isUpdate) {
                // Update mode
                foreach ($jsonData['stats'] as &$stat) {
                    if ((int)$stat['id'] === (int)$id) {
                        $stat['icon']  = $request->getPost('icon')  ?? $stat['icon'];
                        $stat['value'] = $request->getPost('value') ?? $stat['value'];
                        $stat['label'] = $request->getPost('label') ?? $stat['label'];
                        $updated = true;
                        break;
                    }
                }

                if (!$updated) {
                    return $this->response->setJSON([
                        'status' => false,
                        'message' => 'Stat not found for update'
                    ])->setStatusCode(404);
                }
            } else {
                // Add mode
                $newId = count($jsonData['stats']) > 0
                    ? max(array_column($jsonData['stats'], 'id')) + 1
                    : 1;

                $newStat = [
                    'id'    => $newId,
                    'icon'  => $request->getPost('icon'),
                    'value' => $request->getPost('value'),
                    'label' => $request->getPost('label'),
                ];

                $jsonData['stats'][] = $newStat;
            }

            // Save back to file
            $saved = file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            if (!$saved) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Failed to write to JSON file'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => $isUpdate ? 'Stat updated successfully' : 'Stat added successfully',
                'data'    => $isUpdate ? $stat : $newStat
            ])->setStatusCode($isUpdate ? 200 : 201);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Server error',
                'error'   => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function deleteStat()
    {
        $request = \Config\Services::request();

        try {
            // 1. Validate ID
            $id = $request->getPost('id');

            if (empty($id) || !is_numeric($id)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Invalid or missing ID'
                ])->setStatusCode(400);
            }

            // 2. Load JSON data
            $jsonPath = $this->jsonPath;
            $jsonData = [];

            if (!file_exists($jsonPath)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Data file not found.'
                ])->setStatusCode(404);
            }

            $jsonRaw = file_get_contents($jsonPath);
            $jsonData = json_decode($jsonRaw, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Invalid JSON structure',
                    'error' => json_last_error_msg()
                ])->setStatusCode(500);
            }

            // 3. Check and filter stat
            if (!isset($jsonData['stats']) || !is_array($jsonData['stats'])) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'No stats found to delete.'
                ])->setStatusCode(404);
            }

            $originalCount = count($jsonData['stats']);
            $jsonData['stats'] = array_filter($jsonData['stats'], function ($stat) use ($id) {
                return (int)$stat['id'] !== (int)$id;
            });

            if (count($jsonData['stats']) === $originalCount) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Stat with specified ID not found.'
                ])->setStatusCode(404);
            }

            // 4. Reindex and Save
            $jsonData['stats'] = array_values($jsonData['stats']); // reindex array
            $saveSuccess = file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            if (!$saveSuccess) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save updated data'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Stat deleted successfully'
            ])->setStatusCode(200);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Server error occurred',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    // team controller

    public function saveTeamMember()
    {
        $request    = \Config\Services::request();
        $validation = \Config\Services::validation();

        try {
            // 1. Validation Rules
            $validation->setRules([
                'name'       => 'required|min_length[3]',
                'role'       => 'required|min_length[3]',
                'emoji'      => 'required',
                'desc'       => 'required|min_length[10]',
                'profilePic' => 'permit_empty|uploaded[profilePic]|max_size[profilePic,2048]|is_image[profilePic]'
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validation->getErrors()
                ])->setStatusCode(422);
            }

            // 2. Load existing JSON
            $jsonPath = WRITEPATH . 'data/story.json';
            $jsonData = [];

            if (file_exists($jsonPath)) {
                $jsonRaw  = file_get_contents($jsonPath);
                $jsonData = json_decode($jsonRaw, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    return $this->response->setJSON([
                        'status'  => false,
                        'message' => 'Invalid JSON',
                        'error'   => json_last_error_msg()
                    ])->setStatusCode(500);
                }
            }

            if (!isset($jsonData['team_members']) || !is_array($jsonData['team_members'])) {
                $jsonData['team_members'] = [];
            }

            // 3. Extract form data
            $name  = $request->getPost('name');
            $role  = $request->getPost('role');
            $emoji = $request->getPost('emoji');
            $desc  = $request->getPost('desc');
            $id    = $request->getPost('id');

            // 4. Handle file upload
            $profileFile = $request->getFile('profilePic');
            $profilePath = null;

            if ($profileFile && $profileFile->isValid() && !$profileFile->hasMoved()) {
                $newName    = $profileFile->getRandomName();
                $uploadPath = FCPATH . 'uploads/story/team/';
                $profileFile->move($uploadPath, $newName);
                $profilePath = 'uploads/story/team/' . $newName;
            }

            // 5. Color data
            $colors    = ['blue', 'purple', 'green', 'orange', 'cyan', 'pink', 'red', 'teal'];
            $baseColor = $colors[array_rand($colors)];
            $altColor  = $colors[array_rand($colors)];

            $colorData = [
                'color'     => "from-$baseColor-400 to-$altColor-600",
                'textColor' => "text-$baseColor-400"
            ];

            $isUpdated = false;
            $message = 'Team member added successfully';

            // 6. Update if ID matches
            if ($id !== null && !empty($id)) {
                foreach ($jsonData['team_members'] as &$member) {
                    if (isset($member['id']) && $member['id'] == $id) {

                        if ($member['name'] !== $name) $member['name'] = $name;
                        if ($member['role'] !== $role) $member['role'] = $role;
                        if ($member['emoji'] !== $emoji) $member['emoji'] = $emoji;
                        if ($member['desc'] !== $desc) $member['desc'] = $desc;

                        if ($profilePath) {
                            if (isset($member['profilePic']) && file_exists(FCPATH . $member['profilePic'])) {
                                unlink(FCPATH . $member['profilePic']); // Delete old image
                            }
                            $member['profilePic'] = $profilePath;
                        }

                        if (!isset($member['color'])) $member = array_merge($member, $colorData);

                        $message = 'Team member updated successfully';
                        $isUpdated = true;
                        break;
                    }
                }
            }

            // 7. Add new member
            if (!$isUpdated) {
                $newMember = array_merge([
                    'id'         => uniqid(),
                    'name'       => $name,
                    'role'       => $role,
                    'emoji'      => $emoji,
                    'desc'       => $desc,
                    'profilePic' => $profilePath,
                ], $colorData);

                $jsonData['team_members'][] = $newMember;
            }

            // 8. Save to file
            $saved = file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            if (!$saved) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Failed to save file'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => $message,
            ])->setStatusCode(201);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Server error',
                'error'   => $e->getMessage()
            ])->setStatusCode(500);
        }
    }



    // gallery controller

    public function saveGallery()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();
        helper('filesystem');

        try {
            $validation->setRules([
                'title' => 'required|min_length[3]',
                'desc' => 'required|min_length[5]',
                'alt' => 'required',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation error',
                    'errors' => $validation->getErrors()
                ])->setStatusCode(422);
            }

            $id       = $request->getPost('id');
            $title    = $request->getPost('title');
            $desc     = $request->getPost('desc');
            $alt      = $request->getPost('alt');
            $hidden   = $request->getPost('hidden') === 'true';
            $remove   = json_decode($request->getPost('removeMedia') ?? '[]', true);

            $jsonPath = WRITEPATH . 'data/story.json';
            $json     = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];

            if (!isset($json['gallery_items'])) $json['gallery_items'] = [];

            $uploadPath = FCPATH . 'uploads/story/gallery/';
            if (!is_dir($uploadPath)) mkdir($uploadPath, 0777, true);

            // Remove media files if requested
            if ($remove) {
                foreach ($remove as $file) {
                    $filePath = FCPATH . $file;
                    if (file_exists($filePath)) unlink($filePath);
                }
            }

            // Handle media uploads
            $uploadedMedia = [];
            $mediaFiles = $request->getFiles();
            if (isset($mediaFiles['media'])) {
                foreach ($mediaFiles['media'] as $file) {
                    if ($file->isValid() && !$file->hasMoved()) {
                        $type = strpos($file->getMimeType(), 'video') !== false ? 'video' : 'image';
                        $newName = uniqid() . '.' . $file->getExtension();
                        $file->move($uploadPath, $newName);
                        $uploadedMedia[] = [
                            'url' => 'uploads/story/gallery/' . $newName,
                            'type' => $type
                        ];
                    }
                }
            }

            // Prepare final item
            $item = [
                'title' => $title,
                'desc' => $desc,
                'alt' => $alt,
                'hidden' => $hidden
            ];

            if ($id) {
                // Update
                foreach ($json['gallery_items'] as &$gallery) {
                    if ($gallery['id'] == $id) {
                        $gallery = array_merge($gallery, $item);
                        // Merge existing media minus removed
                        $gallery['media'] = array_values(array_filter(
                            $gallery['media'] ?? [],
                            fn($m) => !in_array($m['url'], $remove)
                        ));
                        $gallery['media'] = array_merge($gallery['media'], $uploadedMedia);
                        break;
                    }
                }
            } else {
                // New Entry
                $item['id'] = uniqid();
                $item['media'] = $uploadedMedia;
                $json['gallery_items'][] = $item;
            }

            file_put_contents($jsonPath, json_encode($json, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            return $this->response->setJSON([
                'status' => true,
                'message' => $id ? "Gallery item updated." : "Gallery item added."
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Server error',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
    public function deleteGallery($id = null)
    {
        try {
            if (!$id) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Missing gallery ID.'
                ])->setStatusCode(400);
            }

            $jsonPath = WRITEPATH . 'data/story.json';

            if (!file_exists($jsonPath)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'JSON file not found.'
                ])->setStatusCode(404);
            }

            $jsonContent = file_get_contents($jsonPath);
            $jsonData = json_decode($jsonContent, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Invalid JSON format.',
                    'error' => json_last_error_msg()
                ])->setStatusCode(500);
            }

            if (!isset($jsonData['gallery_items']) || !is_array($jsonData['gallery_items'])) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'No gallery items found.'
                ])->setStatusCode(404);
            }

            // Find index by id
            $index = array_search($id, array_column($jsonData['gallery_items'], 'id'));

            if ($index === false) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Gallery item not found.'
                ])->setStatusCode(404);
            }

            $galleryItem = $jsonData['gallery_items'][$index];

            // Delete media files if stored locally
            if (!empty($galleryItem['media']) && is_array($galleryItem['media'])) {
                foreach ($galleryItem['media'] as $media) {
                    if (isset($media['url']) && strpos($media['url'], 'uploads/gallery/') !== false) {
                        $mediaPath = FCPATH . $media['url'];
                        if (file_exists($mediaPath)) {
                            @unlink($mediaPath);
                        }
                    }
                }
            }

            // Remove item
            array_splice($jsonData['gallery_items'], $index, 1);

            // Save updated JSON
            $save = file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

            if (!$save) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save updated JSON.'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Gallery item deleted successfully.'
            ])->setStatusCode(200);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Server error occurred.',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
