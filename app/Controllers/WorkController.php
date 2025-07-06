<?php

namespace App\Controllers;
require_once APPPATH . 'Helpers/Utils.php';

use CodeIgniter\Controller;
use App\Helpers\Utils;
use App\Helpers\WorkService;

class WorkController extends BaseController
{

    private $jsonPath;
    protected $session;
    protected $helpers = ['url', 'form'];
    protected static $servicesPath = 'services.json';
    protected static $workPath = 'singleWork.json';


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
                        'projectCount' => $category["projectCount"] ?? 0
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


    public function renderWorkDashboard($id)
    {

        $workList = Utils::read("singleWork.json");
        if (empty($workList) && !isset($workList)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Work data not found.'
            ])->setStatusCode(404);
        }

        // echo $workList;
        $work = null;
        foreach ($workList as $item) {
            if ($item['id'] === $id) {
                $work = $item;
                break;
            }
        }

        if (!$work) {
            return $this->response->setStatusCode(404)->setBody('Work not found');
        }

        return view('dashboard/layout/worklayout', ['work' => $work]);
        //  return view('dashboard/singleWork',);
    }


    public function saveWork()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        try {
            // 1. Validate basic fields
            $validation->setRules([
                'title'       => 'required|min_length[2]',
                'description' => 'required|min_length[10]',
                'categoryId'       => 'required',
                'categoryTitle'    => 'required',
                // 'catDes'      => 'required',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validation->getErrors()
                ])->setStatusCode(422);
            }

            // 2. Extract fields
            $id           = $request->getPost('id') ?: "";
            $title        = $request->getPost('title');
            $description  = $request->getPost('description');
            $catId        = $request->getPost('categoryId');
            $catTitle     = $request->getPost('categoryTitle');
            $catDes       = $request->getPost('catDes');
            $tags         = $request->getPost('tags') ?? [];


            $workEntry = [
                'id'          => $id,
                'title'       => $title,
                'description' => $description,
                'catId'  => $catId,
                'catTitle'    => $catTitle,
                'catDes'      => $catDes,
                'tags'        => is_array($tags) ? $tags : explode(',', $tags),
                'cardMedia'   => [],
                'updated_at'  => date('Y-m-d H:i:s'),
            ];

            $gradientColors = Utils::getRandorColorSet();
            // 3. Handle Media
            $cardMedia = $request->getFiles()['Files'] ?? [];
            foreach ($cardMedia as $media) {
                if ($media->isValid() && !$media->hasMoved()) {
                    $result = Utils::uploadMedia($media, 'uploads/workMedia/');
                    if (isset($result['error'])) {
                        return $this->response->setJSON([
                            'status' => false,
                            'message' => $result['error'],
                            'error' => $result['error']
                        ])->setStatusCode(400);
                    }
                    $workEntry['cardMedia'][] = $result;
                }
            }
            // 4. Load existing work.json
            $workData = Utils::read(self::$workPath);

            // 5. Check if the work with this ID already exists
            $existingIndex = null;
            if (!empty($id))
                $existingIndex = array_search($id, array_column($workData, 'id'));



            if ($existingIndex !== false && !empty($id)) {
                // Update only changed fields
                log_message("error", "if part");

                $existingData = $workData[$existingIndex];
                foreach ($workEntry as $key => $val) {
                    if (!isset($existingData[$key]) || $existingData[$key] !== $val) {
                        $workData[$existingIndex][$key] = $val;
                    }
                }
            } else {
                log_message("error", "elsepart");
                // Add new entry
                $workData[] = array_merge($workEntry, ["id" => uniqid(), 'created_at'  => date('Y-m-d H:i:s'),], $gradientColors);
            }

            // 6. Save updated JSON
            $saved = Utils::write(self::$workPath, $workData);

            if (!$saved) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save JSON file'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => !empty($id) ? 'Work updated successfully' : 'New work added successfully',
                'data' => $workEntry
            ])->setStatusCode(201);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Unexpected server error',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function deleteWork($workId=null)
    {
        $request = \Config\Services::request();

        try {
            // $workId = $request->getPost('id');

            if (!$workId) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Missing work ID',
                ])->setStatusCode(400);
            }

            $workData = Utils::read(self::$workPath);

            if (!is_array($workData)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Invalid JSON format'
                ])->setStatusCode(500);
            }

            $initialCount = count($workData);
            $deletedMedia = [];

            $workData = array_filter($workData, function ($item) use ($workId, &$deletedMedia) {
                if ($item['id'] === $workId) {

                    // 🧹 Delete media from cardMedia
                    if (!empty($item['cardMedia'])) {
                        foreach ($item['cardMedia'] as $media) {
                            if (!empty($media['url']) && file_exists($media['url'])) {
                                unlink($media['url']);
                                $deletedMedia[] = $media['url'];
                            }
                        }
                    }

                    // 🧹 Delete media from bannerMedia
                    if (!empty($item['bannerMedia'])) {
                        foreach ($item['bannerMedia'] as $media) {
                            if (!empty($media['url']) && file_exists($media['url'])) {
                                unlink($media['url']);
                                $deletedMedia[] = $media['url'];
                            }
                        }
                    }

                    // 🧹 Delete images/videos from impacts[].media
                    if (!empty($item['impacts']) && is_array($item['impacts'])) {
                        foreach ($item['impacts'] as $impact) {
                            if (!empty($impact['media'])) {
                                foreach ($impact['media'] as $media) {
                                    if (!empty($media['url']) && file_exists($media['url'])) {
                                        unlink($media['url']);
                                        $deletedMedia[] = $media['url'];
                                    }
                                }
                            }
                        }
                    }

                    // 🧹 Delete icons from result[].icon (if icon is a local file path)
                    if (!empty($item['result']) && is_array($item['result'])) {
                        foreach ($item['result'] as $res) {
                            if (!empty($res['icon']) && file_exists($res['icon'])) {
                                unlink($res['icon']);
                                $deletedMedia[] = $res['icon'];
                            }
                        }
                    }

                    // 🧹 Delete single hero image (if exists)
                    if (!empty($item['image']) && file_exists($item['image'])) {
                        unlink($item['image']);
                        $deletedMedia[] = $item['image'];
                    }

                    return false; // remove this item
                }
                return true;
            });

            $workData = array_values($workData); // reindex

            if (count($workData) === $initialCount) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Work not found or already deleted'
                ])->setStatusCode(404);
            }

            $saved = Utils::write(self::$workPath, $workData);

            if (!$saved) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to update work file'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => 'Work and associated media deleted',
                'deletedMedia' => $deletedMedia
            ])->setStatusCode(200);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Unexpected error',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }





    public function combineServiceAndWork()
    {

        // return 'hello';
    $projects=WorkService::getMergedData();

        return $this->response->setJSON($projects);
    }


}
