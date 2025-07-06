<!--  -->
<?php
// $jsonPath = FCPATH . 'path/to/work.json'; // Adjust path as needed

// $jsonData = json_decode(file_get_contents($jsonPath), true);
// $item = [
//     "id" => "tech-burner",
//     "catId" => "8",
//     "catTitle" => "hjsdjgfhsd",
//     "catDes" => "xcgdfgd",
//     "title" => "Tech helper",
//     "subTitles" => "",
//     "teamSize" => 0,
//     "duration" => "30 days",
//     "description" => "Transforming a tech reviewer into a digital icon with strategic brand development",
//     "image" => "https://images.unsplash.com/photo-1518770660439-4636190af475?w=600",
//     "tags" => [
//         "Brand Strategy",
//         // "Content Marketing"
//     ],
//     "link" => "./case-study",
//     "updated_at" => "2025-06-26 10:59:17",
//     "bannerMedia" => [
//         [
//             "url" => "uploads/workMedia/1750935557_617606edf4e2fc6ada2e.png",
//             "type" => "image/png"
//         ]
//     ],
//     "cardMedia" => [
//         [
//             "url" => "uploads/workMedia/1750935557_617606edf4e2fc6ada2e.png",
//             "type" => "image/png"
//         ]
//     ],
//     "result" => [
//         [
//             "id" => 1,
//             "icon" => "👥",
//             "value" => "50+",
//             "label" => "Team Members"
//         ]
//     ],
//     "challenges" => [
//         [
//             "title" => "",
//             "subTitle" => "",
//             "description" => ""
//         ]
//     ],
//     "impacts" => [
//         [
//             "title" => "",
//             "points" => [],
//             "description" => "",
//             "media" => [
//                 [
//                     "url" => "",
//                     "type" => ""
//                 ]
//             ]
//         ]
//     ],
//     "gradient" => "from-purple-400 to-pink-400",
//     "accentColor" => "purple-400",
//     "tagColor" => "purple-300",
//     "alterColor" => "pink-400"
// ];

?>


<?= $this->extend('dashboard/layout/main.php') ?>


<?= $this->section('styles') ?>

<style>

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>


<div id="work-content" class="page-content p-4 lg:p-6 ">

    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <h3 class="text-xl font-semibold">Portfolio Management</h3>
        <button onclick="showAddModal('project')" class="action-btn bg-pink-600 hover:bg-pink-700 px-4 py-2 rounded-lg transition-colors flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add New Work
        </button>
    </div>

    <div class="glass-card p-6 rounded-xl">
        <h4 class="text-lg font-semibold mb-4 text-pink-400">Work Categories</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-6">

            <?php if (!empty($projects) && is_array($projects)) : ?>
                <?php foreach ($projects as $service) : ?>
                    <div class="capitalize bg-gradient-to-r <?= 'from-' . esc($service['accentColor'] . '/20' ?? 'from-blue-400/20 ') ?>  <?= 'to-' . esc($service['alterColor'] . '/20' ?? 'to-cyan-400/20 ') ?>    p-4 rounded-lg border border-<?= esc($service['accentColor'] ?? 'blue-400') ?>/30 mb-4">


                        <div class="flex items-center justify-between mb-2">
                            <span class="text-2xl"><?= esc($service['icon'] ?? '💼') ?></span>
                            <span class="text-<?= esc($service['accentColor'] ?? 'blue-400') ?> text-sm">
                                <?= esc($service['projectCount'] ?? []) ?> Projects
                            </span>
                        </div>
                        <h5 class="font-medium text-<?= esc($service['accentColor'] ?? 'blue-400') ?>">
                            <?= esc($service['name']) ?>
                        </h5>
                        <p class="text-gray-400 text-sm mb-2 truncate"><?= esc($service['description']) ?></p>


                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="bg-yellow-100/20 text-yellow-600 p-4 rounded-lg border border-yellow-300/30">
                    <h5 class="text-lg font-semibold mb-1">No services found</h5>
                    <p class="text-sm">Start by adding your first service section.</p>
                </div>
            <?php endif; ?>




        </div>

        <h4 class="text-lg font-semibold mb-4 text-pink-400">Recent Works</h4>
        <div class="overflow-x-auto flex gap-4 flex-col-reverse">
            <table class="data-table w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left p-3">Project</th>
                        <th class="text-left p-3">Category</th>
                        <th class="text-left p-3">Description</th>
                        <th class="text-left p-3">Tags</th>
                        <th class="text-left p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php if (isset($workList) && count($workList) > 0 && is_array($workList)): ?>

                        <?php foreach ($workList as $item) : ?>
                            <tr>
                                <td class="p-3 font-medium"><?= esc($item['title']) ?? "" ?></td>
                                <td class="p-3">
                                    <span class="px-2 py-1 bg-blue-400/20 text-blue-400 rounded-full text-xs"><?= esc($item['catTitle']) ?? "" ?></span>
                                </td>
                                <td class="p-3 text-gray-400 max-w-xs truncate"><?= esc($item['description'] ?? "") ?? "" ?></td>
                                <td class="p-3">

                                    <div class="flex flex-wrap gap-1">
                                        <?php
                                        $moreCount = 0;
                                        $lastEl = '';

                                        if (isset($item['tags']) && is_array($item['tags']) && count($item['tags']) > 0):
                                            $tagCount = count($item['tags']);

                                            if ($tagCount > 1) {
                                                $moreCount = $tagCount - 1;
                                                $lastEl = '<span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs">'
                                                    . esc($moreCount . ' more') .
                                                    '</span>';
                                            }
                                        ?>
                                            <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs">
                                                <?= esc($item["tags"][0]) ?>
                                            </span>
                                            <?= $lastEl ?>
                                        <?php else : ?>
                                            <p>No Tags</p>
                                        <?php endif; ?>
                                    </div>

                                </td>
                                <td class="p-3">
                                    <div class="flex space-x-2">
                                        <button
                                            data-item="<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>"
                                            onclick="editItem('project', JSON.parse(this.dataset.item),'edit')" class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="edit" class="w-3 h-3"></i>
                                        </button>
                                        <button
                                            data-item="<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>"
                                            onclick="viewItem('project', JSON.parse(this.dataset.item),'edit')"
                                            class="action-btn bg-green-600 hover:bg-green-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="eye" class="w-3 h-3"></i>
                                        </button>
                                        <button onclick="deleteWorkItem('project', '<?= esc($item['id']) ?>')" class="action-btn bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="col-span-full text-center text-gray-400 flex flex-col items-center">
                            <h2>No projects found.</h2>
                            <p>Add your first project to get started!</p>
                        </div>
                    <?php endif; ?>


                </tbody>
            </table>
        </div>
    </div>
</div>
<?= $this->section('scripts') ?>

<script>
    window.servicesData = <?= json_encode($services, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
</script>
<script src="<?= base_url('assets/js/dashboard/work.js') ?>"></script>


<?= $this->endSection() ?>
<?= $this->endSection() ?>