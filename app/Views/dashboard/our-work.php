<!--  -->
<?php
// $jsonPath = FCPATH . 'path/to/work.json'; // Adjust path as needed

// $jsonData = json_decode(file_get_contents($jsonPath), true);

$projectRows = '';

if (!empty($projects) && is_array($projects)) {
    $hasProjects = false;

    foreach ($projects as $category) {
        if (!empty($category['projects']) && is_array($category['projects'])) {
            $hasProjects = true;
            foreach ($category['projects'] as $project) {
                $tags = '';
                if (!empty($project['tags']) && is_array($project['tags'])) {
                    foreach ($project['tags'] as $tag) {
                        $tags .= '<span class="px-2 py-1 bg-gray-600/20 text-gray-400 rounded-full text-xs">' . esc($tag) . '</span> ';
                    }
                }

                $projectRows .= '
                <tr class="capitalize">
                    <td class="p-3 font-medium">' . esc($project['title']) . '</td>
                    <td class="p-3">
                        <span class="px-2 py-1 bg-' . esc($category['accentColor'] ?? 'gray-400') . '/20 text-' . esc($category['accentColor'] ?? 'gray-400') . ' rounded-full text-xs">' . esc($category['name'] ?? 'Unknown') . '</span>
                    </td>
                    <td class="p-3 text-gray-400 max-w-xs truncate">' . esc($project['description']) . '</td>
                    <td class="p-3"><div class="flex flex-wrap gap-1">' . $tags . '</div></td>
                    <td class="p-3">
                        <div class="flex space-x-2">
                            <button onclick="editItem(\'project\', \'' . esc($project['id']) . '\')" class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">
                                <i data-lucide="edit" class="w-3 h-3"></i>
                            </button>
                            <button onclick="viewItem(\'project\', \'' . esc($project['id']) . '\')" class="action-btn bg-green-600 hover:bg-green-700 px-2 py-1 rounded text-xs">
                                <i data-lucide="eye" class="w-3 h-3"></i>
                            </button>
                            <button onclick="deleteWorkItem(\'project\', \'' . esc($project['id']) . '\')" class="action-btn bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs">
                                <i data-lucide="trash-2" class="w-3 h-3"></i>
                            </button>
                        </div>
                    </td>
                </tr>';
            }
        }
    }

    if (!$hasProjects) {
        $projectRows = '
        <tr>
            <td colspan="5" class="text-center p-6 text-gray-400 italic">
                🚫 No projects found. Add your first one to get started!
            </td>
        </tr>';
    }
} else {
    $projectRows = '
    <tr>
        <td colspan="5" class="text-center p-6 text-gray-400 italic">
            🚫 No categories or projects available.
        </td>
    </tr>';
}

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
            Add Project
        </button>
    </div>

    <div class="glass-card p-6 rounded-xl">
        <h4 class="text-lg font-semibold mb-4 text-pink-400">Project Categories</h4>
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

        <h4 class="text-lg font-semibold mb-4 text-pink-400">Recent Projects</h4>
        <div class="overflow-x-auto">
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

                    <?= $projectRows ?>

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