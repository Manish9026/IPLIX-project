<?php

namespace App\Controllers;

use CodeIgniter\Controller;

class WorkController extends Controller
{

    private $jsonPath;
    protected $session;
    protected $helpers = ['url', 'form'];

    public function __construct()
    {
        $this->jsonPath = WRITEPATH . 'data/work.json'; // CI4 safe path
        $this->session = \Config\Services::session();
    }

    public function getSingleProject($projectId)
{
    $jsonPath = $this->jsonPath;
    // Check if file exists
    if (!file_exists($jsonPath)) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Project data file not found'
        ])->setStatusCode(500);
    }

    $jsonData = json_decode(file_get_contents($jsonPath), true);

    if (!isset($jsonData['projects']) || !is_array($jsonData['projects'])) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Invalid data format'
        ])->setStatusCode(500);
    }

    // Search project by ID
    foreach ($jsonData['projects'] as $category) {
        if (!isset($category['projects']) || !is_array($category['projects'])) continue;

        foreach ($category['projects'] as $project) {
            if ($project['id'] === $projectId) {
                // Include category info if needed
                $project['category'] = [
                    'categoryId' => $category['categoryId'] ?? null,
                    'name'       => $category['name'] ?? null,
                    'accentColor' => $category['accentColor'] ?? null,
                    'projectCount'=> $category["projectCount"] ?? 0
                ];

                return $this->response->setJSON([
                    'status' => true,
                    'message' => 'Project found',
                    'data' => $project
                ]);
            }
        }
    }

    // Not found
    return $this->response->setJSON([
        'status' => false,
        'message' => 'Project not found'
    ])->setStatusCode(404);
}


    public function editProject($projectId)
{
    $request = \Config\Services::request();
    $jsonPath = WRITEPATH . 'data/work.json';

    if (!file_exists($jsonPath)) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Data file not found'
        ])->setStatusCode(500);
    }

    $jsonData = json_decode(file_get_contents($jsonPath), true);

    if (!isset($jsonData['projects']) || !is_array($jsonData['projects'])) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Invalid data format'
        ])->setStatusCode(500);
    }

    $updatedFields = [];
    $found = false;

    foreach ($jsonData['projects'] as $catIndex => &$category) {
        if (!isset($category['projects']) || !is_array($category['projects'])) continue;

        foreach ($category['projects'] as $projIndex => &$project) {
            if ($project['id'] === $projectId) {
                $found = true;

                // Compare each field, only update if changed
                $fieldsToUpdate = ['title', 'description', 'tags'];

                foreach ($fieldsToUpdate as $field) {
                    $newValue = $request->getPost($field);
                    if ($newValue !== null) {
                        if ($field === 'tags') {
                            $newValueArray = array_map('trim', explode(',', $newValue));
                            if ($project[$field] !== $newValueArray) {
                                $project[$field] = $newValueArray;
                                $updatedFields[$field] = $newValueArray;
                            }
                        } else {
                            if ($project[$field] !== $newValue) {
                                $project[$field] = $newValue;
                                $updatedFields[$field] = $newValue;
                            }
                        }
                    }
                }

                // Update media if new files uploaded
                $uploadedFiles = $request->getFiles();
                $mediaPaths = [];
                $mediaTypes = [];

                if (isset($uploadedFiles['mediaFiles'])) {
                    foreach ($uploadedFiles['mediaFiles'] as $file) {
                        if ($file->isValid() && !$file->hasMoved()) {
                            $newName = $file->getRandomName();
                            $uploadPath = FCPATH . 'uploads/workMedia/';
                            $file->move($uploadPath, $newName);
                            $mediaPaths[] = 'uploads/workMedia/' . $newName;
                            $mediaTypes[] = $file->getMimeType();
                        }
                    }

                    if (!empty($mediaPaths)) {
                        $project['media'] = $mediaPaths;
                        $project['mediaType'] = $mediaTypes;
                        $updatedFields['media'] = $mediaPaths;
                    }
                }

                if (!empty($updatedFields)) {
                    $project['updated_at'] = date('Y-m-d H:i:s');
                    $updatedFields['updated_at'] = $project['updated_at'];
                }

                break 2;
            }
        }
    }

    if (!$found) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Project not found'
        ])->setStatusCode(404);
    }

    if (empty($updatedFields)) {
        return $this->response->setJSON([
            'status' => true,
            'message' => 'No changes detected'
        ]);
    }

    // Save changes
    file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

    return $this->response->setJSON([
        'status' => true,
        'message' => 'Project updated successfully',
        'updated' => $updatedFields
    ]);
}


    public function addProject()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        // Validation
        $validation->setRules([
            'title'       => 'required',
            'description' => 'required',
            'categoryId'  => 'required',
            'tags'        => 'required'
        ]);

        if (!$validation->withRequest($request)->run()) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Validation failed',
                'errors' => $validation->getErrors()
            ])->setStatusCode(422);
        }

        // Load JSON
        $jsonPath = WRITEPATH . 'data/work.json';
        $jsonData = file_exists($jsonPath) ? json_decode(file_get_contents($jsonPath), true) : [];

        if (!isset($jsonData['projects']) || !is_array($jsonData['projects'])) {
            $jsonData['projects'] = [];
        }

        $categoryId = $request->getPost('categoryId');
        $categoryTitle = $request->getPost('categoryTitle') ?? 'Untitled Category';

        // File upload
        $uploadedFiles = $request->getFiles();
        $mediaPaths = [];
        $mediaTypes = [];

        if (isset($uploadedFiles['mediaFiles'])) {
            foreach ($uploadedFiles['mediaFiles'] as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $newName = $file->getRandomName();
                    $uploadPath = FCPATH . 'uploads/workMedia/';
                    $file->move($uploadPath, $newName);
                    $mediaPaths[] = 'uploads/workMedia/' . $newName;
                    $mediaTypes[] = $file->getMimeType();
                }
            }
        }

        // Tag processing
        $tagsArray = array_map('trim', explode(',', $request->getPost('tags')));

        // New project item
        $newProject = [
            'id'          => uniqid(),
            'title'       => $request->getPost('title'),
            'description' => $request->getPost('description'),
            'media'       => $mediaPaths,
            'tags'        => $tagsArray,
            'mediaType'   => $mediaTypes,
            'image'=>"",
            "link"=>"",
            'created_at'  => date('Y-m-d H:i:s'),
            'updated_at'  => date('Y-m-d H:i:s'),
            'isActive'    => true,
        ];

        // Tailwind color
        function getRandomTailwindColorSet(): array
        {
            $colors = ['red', 'orange', 'amber', 'yellow', 'lime', 'green', 'emerald', 'teal', 'cyan', 'sky', 'blue', 'indigo', 'violet', 'purple', 'fuchsia', 'pink', 'rose'];
            $baseColor = $colors[array_rand($colors)];
            $altColor  = $colors[array_rand($colors)];

            return [
                'gradient'    => "from-{$baseColor}-400 to-{$altColor}-400",
                'accentColor' => "{$baseColor}-400",
                'tagColor'    => "{$baseColor}-300",
                'alterColor'  => $altColor
            ];
        }

        //  Check if category exists
        $categoryIndex = null;
        foreach ($jsonData['projects'] as $index => $cat) {
            if (isset($cat['categoryId']) && $cat['categoryId'] == $categoryId) {
                $categoryIndex = $index;
                break;
            }
        }

        if ($categoryIndex !== null) {
            //  Category exists → Push project
            $jsonData['projects'][$categoryIndex]['projects'][] = $newProject;
            $jsonData['projects'][$categoryIndex]['projectCount'] = count($jsonData['projects'][$categoryIndex]['projects']);
            $jsonData['projects'][$categoryIndex]['updated_at'] = date('Y-m-d H:i:s');
        } else {
            //  Category doesn't exist → Create structure
            $newCategory = [
                'id'            => uniqid(),
                'categoryId'    => $categoryId,
                'name'         => $categoryTitle,
                'description'   =>  $request->getPost('catDes'),
                'icon'         =>  $request->getPost('catIcon') ?? '',
                'projects'      => [$newProject],
                'projectCount' => 1,
                'created_at'    => date('Y-m-d H:i:s'),
                'updated_at'    => date('Y-m-d H:i:s'),
                'isActive'      => true,
            ];

            $jsonData['projects'][] = array_merge($newCategory, getRandomTailwindColorSet());
        }

        // Save back to file
        file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

        return $this->response->setJSON([
            'status'  => true,
            'message' => 'Project added successfully',
            'data'    => $newProject
        ])->setStatusCode(201);
    }


    public function deleteProject($projectId)
    {


        $jsonPath =$this->jsonPath ;
        if (!file_exists($jsonPath)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Data file not found.'
            ])->setStatusCode(404);
        }

        $jsonData = json_decode(file_get_contents($jsonPath), true);

        if (!isset($jsonData['projects']) || !is_array($jsonData['projects'])) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Invalid project data.'
            ])->setStatusCode(422);
        }

        $found = false;

        // Loop through categories
        foreach ($jsonData['projects'] as &$category) {
            if (!isset($category['projects']) || !is_array($category['projects'])) {
                continue;
            }

            foreach ($category['projects'] as $index => $project) {
                if ($project['id'] === $projectId) {
                    // Remove file if media exists
                    if (isset($project['media']) && is_array($project['media'])) {
                        foreach ($project['media'] as $filePath) {
                            $fullPath = FCPATH . $filePath;
                            if (file_exists($fullPath)) {
                                unlink($fullPath);
                            }
                        }
                    }

                    // Remove the project
                    array_splice($category['projects'], $index, 1);
                    $category['projectCount'] = count($category['projects']);
                    $category['updated_at'] = date('Y-m-d H:i:s');
                    $found = true;
                    break 2;
                }
            }
        }

        if (!$found) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Project not found.'
            ])->setStatusCode(404);
        }

        // Save updated data
        file_put_contents($jsonPath, json_encode($jsonData, JSON_PRETTY_PRINT));

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Project deleted successfully.'
        ])->setStatusCode(200);
    }
}
