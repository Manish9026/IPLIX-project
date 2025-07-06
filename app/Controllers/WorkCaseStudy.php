<?php

namespace App\Controllers;

use App\Helpers\Utils;
use App\Helpers\WorkService;

require_once APPPATH . 'Helpers/Utils.php';
class WorkCaseStudy extends BaseController
{
    private static $filePath = "singleWork.json";
    //     public function getAllWorks()
    // {
    //     $request = \Config\Services::request();
    //     $params = $request->getGet(); // Get query parameters

    //     try {



    //         $workList=Utils::read("singleWork.json");
    //         if(empty($workList) && !isset($workList)){
    //              return $this->response->setJSON([
    //                 'status' => false,
    //                 'message' => 'Work data not found.'
    //             ])->setStatusCode(404);
    //         }

    //         // If any query parameter exists, filter the list
    //         if (!empty($params)) {
    //             $filtered = array_filter($workList, function ($item) use ($params) {
    //                 $match = true;

    //                 if (isset($params['id'])) {
    //                     $match = $match && ($item['id'] === $params['id']);
    //                 }
    //                 if (isset($params['catId'])) {
    //                     $match = $match && (isset($item['catId']) && $item['catId'] === $params['catId']);
    //                 }
    //                 if (isset($params['title'])) {
    //                     $match = $match && (stripos($item['title'], $params['title']) !== false);
    //                 }
    //                 if (isset($params['catTitle'])) {
    //                     $match = $match && (stripos($item['catTitle'], $params['catTitle']) !== false);
    //                 }

    //                 return $match;
    //             });

    //             $result = array_values($filtered); // reindex array
    //         } else {
    //             $result = $workList;
    //         }

    //         return $this->response->setJSON([
    //             'status' => true,
    //             'count' => count($result),
    //             'data' => $result
    //         ]);
    //     } catch (\Throwable $e) {
    //         return $this->response->setJSON([
    //             'status' => false,
    //             'message' => 'Unexpected error',
    //             'error' => $e->getMessage()
    //         ])->setStatusCode(500);
    //     }
    // }

    // public function getAllWorks()
    // {
    //     $request = \Config\Services::request();
    //     $searchTerm = $request->getGet('search');

    //     try {
    //         $workList = Utils::read("singleWork.json");
    //         if (empty($workList) && !isset($workList)) {
    //             return $this->response->setJSON([
    //                 'status' => false,
    //                 'message' => 'Work data not found.'
    //             ])->setStatusCode(404);
    //         }

    //         // Apply filtering only if search term is present
    //         if (!empty($searchTerm)) {
    //             $searchPattern = '/' . preg_quote($searchTerm, '/') . '/i';

    //             $filtered = array_filter($workList, function ($item) use ($searchPattern) {
    //                 return (
    //                     (isset($item['id']) && preg_match($searchPattern, $item['id'])) ||
    //                     (isset($item['title']) && preg_match($searchPattern, $item['title'])) ||
    //                     (isset($item['catTitle']) && preg_match($searchPattern, $item['catTitle']))
    //                 );
    //             });

    //             $result = array_values($filtered); // reindex
    //         } else {
    //             $result = $workList;
    //         }

    //         return $this->response->setJSON([
    //             'status' => true,
    //             'count' => count($result),
    //             'data' => $result
    //         ]);
    //     } catch (\Throwable $e) {
    //         return $this->response->setJSON([
    //             'status' => false,
    //             'message' => 'Unexpected error',
    //             'error' => $e->getMessage()
    //         ])->setStatusCode(500);
    //     }
    // }

  public function getAllWorks($title = null)
{
    $request = \Config\Services::request();
    $search = $request->getGet('searchTerm');

    try {
        $workList = WorkService::getWorks($title, $search);

        if (empty($workList)) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'No matching work data found.'
            ])->setStatusCode(404);
        }

        return $this->response->setJSON([
            'status' => true,
            'count' => count($workList),
            'data' => $workList
        ]);
    } catch (\Throwable $e) {
        return $this->response->setJSON([
            'status' => false,
            'message' => 'Unexpected error',
            'error' => $e->getMessage()
        ])->setStatusCode(500);
    }
}



    public function saveHero()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        try {
            // 1. Validate basic fields
            $validation->setRules([
                'title'     => 'required|min_length[2]',
                'category'  => 'required|min_length[2]',
                'team_size' => 'permit_empty|numeric',
                'duration'  => 'permit_empty',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validation->getErrors()
                ])->setStatusCode(422);
            }

            // 2. Prepare data
            $id        = $request->getPost('id') ?: uniqid('work_');
            $category  = $request->getPost('category');
            $title     = $request->getPost('title');
            $subtitle  = $request->getPost('subtitle') ?? '';
            $duration  = $request->getPost('duration') ?? '';
            $teamSize  = (int) $request->getPost('team_size') ?? 0;


            $workList = [];

            // load data
            $workList = Utils::read(self::$filePath);
            if (empty($workItems)) {

                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'JSON Decode Error',
                ])->setStatusCode(404);
            }
            // 4. Find if record exists
            $existingIndex = array_search($id, array_column($workList, 'id'));

            // 5. Construct new data
            $newData = [
                'id'          => $id,
                'catTitle'    => $category,
                'title'       => $title,
                'subTitles'   => $subtitle,
                'duration'    => $duration,
                'teamSize'    => $teamSize,
                'updated_at'  => date('Y-m-d H:i:s'),
                'gradient'    => 'from-purple-400 to-pink-400',
                'accentColor' => 'purple-400',
                'tagColor'    => 'purple-300',
                'alterColor'  => 'pink-400',
                'link'        => './case-study',
                'bannerMedia' => [],
                'cardMedia'   => [],
                'result'      => [],
                'challenges'  => [],
                'impacts'     => [],
            ];


            $storePath = 'uploads/workMedia/';
            // 7. Upload banner media (multiple)

            $bannerMedia = $request->getFiles()['bannerMedia'] ?? [];
            foreach ($bannerMedia as $media) {
                if ($media->isValid() && !$media->hasMoved()) {
                    $result = Utils::uploadMedia($media, $storePath);
                    if (isset($result['error'])) {
                        return $this->response->setJSON([
                            'status' => false,
                            'message' => "Banner Error:" . $result['error'],
                            'error' => $result['error']
                        ])->setStatusCode(400);
                    }
                    $newData['bannerMedia'][] = $result;
                }
            }


            // 8. Upload card media (multiple)
            $cardMedia = $request->getFiles()['cardMedia'] ?? [];
            foreach ($cardMedia as $media) {
                if ($media->isValid() && !$media->hasMoved()) {
                    $result = Utils::uploadMedia($media, $storePath);
                    if (isset($result['error'])) {
                        return $this->response->setJSON([
                            'status' => false,
                            'message' => $result['error'],
                            'error' => $result['error']
                        ])->setStatusCode(400);
                    }
                    $newData['cardMedia'][] = $result;
                }
            }

            // 9. Save or update
            if ($existingIndex !== false) {
                // Only update changed fields
                $existing = $workList[$existingIndex];
                foreach ($newData as $key => $val) {
                    if (!isset($existing[$key]) || $existing[$key] !== $val) {
                        $workList[$existingIndex][$key] = $val;
                    }
                }
                $message = 'Work item updated';
            } else {
                $workList[] = $newData;
                $message = 'Work item created';
            }

            // 10. Save to JSON
            $saved = Utils::write(self::$filePath, $workList);
            if (!$saved) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save data to JSON'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status' => true,
                'message' => $message,
                'data' => $newData
            ])->setStatusCode($existingIndex !== false ? 200 : 201);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Unexpected server error',
                'error' => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    // work result in stats

    public function saveStatToWork()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        try {
            // 1. Validate
            $validation->setRules([
                'workId' => 'required',
                'icon'   => 'required',
                'value'  => 'required',
                'label'  => 'required',
                'title'=>'required',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Validation failed',
                    'errors'  => $validation->getErrors()
                ])->setStatusCode(422);
            }

            // 2. Get form data
            $workId = $request->getPost('workId');
            $statId = $request->getPost('id'); // Optional - if present, update
            $icon   = trim($request->getPost('icon'));
            $value  = trim($request->getPost('value'));
            $label  = trim($request->getPost('label'));
            $title  = trim($request->getPost('title'));


            $workItems = Utils::read(self::$filePath);
            if (empty($workItems)) {

                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'work.json file not found'
                ])->setStatusCode(404);
            }

            if (!is_array($workItems)) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to decode JSON',
                    'error' => json_last_error_msg()
                ])->setStatusCode(500);
            }

            $updated = false;
            $newStat = [];

            // 3. Loop to find and update/create in the correct work item
            foreach ($workItems as &$work) {
                if ($work['id'] === $workId) {
                    $work['result'] = $work['result'] ?? [];

                    if ($statId) {
                        // Update mode
                        foreach ($work['result'] as &$stat) {
                            if ((string)$stat['id'] === (string)$statId) {

                                $stat['icon']  = $icon;
                                $stat['value'] = $value;
                                $stat['label'] = $label;
                                 $stat['title']= $title;
                                $newStat = $stat;
                                $updated = true;
                                break;
                            }
                        }
                    }

                    if (!$updated) {
                        // Create new stat
                        $newStat = [
                            'id'    => uniqid(),
                            'icon'  => $icon,
                            'value' => $value,
                            'label' => $label,
                            'title'=>$title

                        ];
                        $work['result'][] = $newStat;
                        $updated = true;
                    }

                    break;
                }
            }

            if (!$updated) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Work item not found or failed to update'
                ])->setStatusCode(404);
            }

            // 4. Save updated JSON
            // $saved = file_put_contents($jsonPath, json_encode($workItems, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
            $saved = Utils::write(self::$filePath, $workItems);
            if (!$saved) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to save data'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => $statId ? 'Stat updated successfully' : 'Stat added successfully',
                'data'    => $newStat
            ])->setStatusCode($statId ? 200 : 201);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Unexpected error',
                'error'   => $e->getMessage()
            ])->setStatusCode(500);
        }
    }

    public function deleteStatFromWork()
    {
        $request = \Config\Services::request();

        try {
            $workId = $request->getPost('workId');
            $statId = $request->getPost('id');

            log_message('error', 'Delete Stat Error: ' . $workId . "," . $statId);


            // ✅ Validate inputs
            if (empty($workId) || empty($statId)) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Missing required fields: workId or statId'
                ])->setStatusCode(422);
            }


            $workItems = Utils::read(self::$filePath);
            if (empty($workItems)) {

                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'work.json file not found'
                ])->setStatusCode(404);
            }

            if (json_last_error() !== JSON_ERROR_NONE || !is_array($workItems)) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Invalid JSON structure',
                    'error'   => json_last_error_msg()
                ])->setStatusCode(500);
            }

            $found = false;
            $statDeleted = false;

            foreach ($workItems as &$work) {
                if ((string)$work['id'] === (string) $workId) {
                    if (!isset($work['result']) || !is_array($work['result'])) {
                        return $this->response->setJSON([
                            'status' => false,
                            'message' => 'No stat list found in the selected work item'
                        ])->setStatusCode(404);
                    }

                    $originalCount = count($work['result']);

                    $work['result'] = array_values(array_filter($work['result'], function ($item) use ($statId) {
                        return isset($item['id']) && (string)$item['id'] !== (string)$statId;
                    }));

                    if (count($work['result']) < $originalCount) {
                        $found = true;
                        $statDeleted = true;
                    } else {
                        $found = true;
                        $statDeleted = false;
                    }

                    break;
                }
            }

            if (!$found) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Work item not found'
                ])->setStatusCode(404);
            }

            if (!$statDeleted) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Stat not found or already deleted'
                ])->setStatusCode(404);
            }

            // ✅ Save updated JSON
            $saved = Utils::write(self::$filePath, $workItems);

            if (!$saved) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Failed to save changes to JSON file. Check file permissions.'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Stat deleted successfully'
            ])->setStatusCode(200);
        } catch (\Throwable $e) {
            log_message('error', 'Delete Stat Error: ' . $e->getMessage());

            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Unexpected server error',
                'error'   => $e->getMessage()
            ])->setStatusCode(500);
        }
    }


    // impact component 

    public function saveImpact()
    {
        $request = \Config\Services::request();
        $validation = \Config\Services::validation();

        try {
            // 1. Validate required fields
            $validation->setRules([
                'workId'         => 'required',
                'impact_title'   => 'required|min_length[2]',
                'impact_points'  => 'required',
            ]);

            if (!$validation->withRequest($request)->run()) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Validation failed',
                    'errors' => $validation->getErrors()
                ])->setStatusCode(422);
            }

            // 2. Retrieve POST values
            $workId     = $request->getPost('workId');
            $impactId   = $request->getPost('id') ?? ""; // Optional (if updating)
            $title      = $request->getPost('impact_title');
            $subTitle   = $request->getPost('impact_subtitle') ?? '';
            $description = $request->getPost('impact_description') ?? '';
            $pointsRaw  = $request->getPost('impact_points') ?? '';
            $points     = array_filter(array_map('trim', explode("\n", $pointsRaw)));

            // 3. Handle file uploads
            $mediaFiles = $request->getFiles()['impactMedia'] ?? [];
            $uploadDir  = 'uploads/workMedia/';
            $mediaList  = [];

            foreach ($mediaFiles as $file) {
                if ($file->isValid() && !$file->hasMoved()) {
                    $result = Utils::uploadMedia($file, $uploadDir);
                    $mediaList[] = $result;
                }
            }

            $workItems = Utils::read(self::$filePath);
            if (empty($workItems)) {

                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'work.json file not found'
                ])->setStatusCode(404);
            }
            // 5. Locate the work item
            $found = false;
            foreach ($workItems as &$work) {
                if ($work['id'] === $workId) {
                    $found = true;
                    $work['impacts'] = $work['impacts'] ?? [];

                    $updated = false;

                    if ($impactId) {
                        // Update existing
                        foreach ($work['impacts'] as &$impact) {
                            if ($impact['id'] === $impactId) {
                                $impact['title']       = $title;
                                $impact['subTitle']    = $subTitle;
                                $impact['description'] = $description;
                                $impact['points']      = $points;
                                $impact['media']       = array_merge($impact['media'] ?? [], $mediaList);
                                $updated = true;
                                break;
                            }
                        }
                    }

                    if (!$updated) {
                        // Add new impact
                        $newImpact = [
                            'id'          => uniqid(),
                            'title'       => $title,
                            'subTitle'    => $subTitle,
                            'description' => $description,
                            'points'      => $points,
                            'media'       => $mediaList
                        ];
                        $work['impacts'][] = $newImpact;
                    }

                    break;
                }
            }

            if (!$found) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Work item not found'
                ])->setStatusCode(404);
            }

            // 6. Save back to file
            $saved = Utils::write(self::$filePath, $workItems);
            if (!$saved) {
                return $this->response->setJSON([
                    'status' => false,
                    'message' => 'Failed to write to JSON file'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => $impactId ? 'Impact updated' : 'Impact added successfully'
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status' => false,
                'message' => 'Unexpected error occurred',
                'error'   => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
    public function deleteImpact()
    {
        $request = \Config\Services::request();

        try {
            $workId   = $request->getPost('workId');
            $impactId = $request->getPost('impactId');

            if (!$workId || !$impactId) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Missing workId or impactId'
                ])->setStatusCode(422);
            }


            $workItems = Utils::read(self::$filePath);
            if (!is_array($workItems)) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Failed to decode JSON',
                    'error'   => json_last_error_msg()
                ])->setStatusCode(500);
            }

            $deleted = false;

            foreach ($workItems as &$work) {
                if ($work['id'] === $workId && isset($work['impacts']) && is_array($work['impacts'])) {
                    foreach ($work['impacts'] as $index => $impact) {
                        if ($impact['id'] === $impactId) {
                            // 🗑 Delete associated media files
                            if (!empty($impact['media'])) {
                                foreach ($impact['media'] as $media) {
                                    if (!empty($media['url'])) {
                                        $filePath = FCPATH . $media['url'];
                                        if (file_exists($filePath)) {
                                            unlink($filePath);
                                        }
                                    }
                                }
                            }

                            // 🧹 Remove the impact from array
                            array_splice($work['impacts'], $index, 1);
                            $deleted = true;
                            break;
                        }
                    }
                    break;
                }
            }

            if (!$deleted) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Impact not found'
                ])->setStatusCode(404);
            }

            // 💾 Save updated file
            $saved = Utils::write(self::$filePath, $workItems);
            if (!$saved) {
                return $this->response->setJSON([
                    'status'  => false,
                    'message' => 'Failed to write to file'
                ])->setStatusCode(500);
            }

            return $this->response->setJSON([
                'status'  => true,
                'message' => 'Impact deleted successfully'
            ]);
        } catch (\Throwable $e) {
            return $this->response->setJSON([
                'status'  => false,
                'message' => 'Unexpected server error',
                'error'   => $e->getMessage()
            ])->setStatusCode(500);
        }
    }
}
