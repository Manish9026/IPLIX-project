<?= $this->extend('dashboard/layout/main.php') ?>


<?= $this->section('styles') ?>

<style>
    /* Fix horizontal scroll issues and ensure full screen coverage */
    body {
        overflow-x: hidden;
        /* Prevent horizontal scroll */
        min-height: 100vh;
        /* Ensure full screen coverage */
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="home-content" class="page-content p-4 lg:p-6 ">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <h3 class="text-xl font-semibold">Home Page Management</h3>

    </div>

    <!-- Hero Section -->

    <!-- Services Section -->
    <div class="glass-card p-6 rounded-xl mb-6">
        <h4 class="text-lg font-semibold mb-4 text-purple-400">Services Preview</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div class="bg-gray-800/50 p-4 rounded-lg">
                <div class="text-2xl mb-2">🎯</div>
                <h5 class="font-medium mb-2">Brand Strategy</h5>
                <p class="text-gray-400 text-sm">Defining your brand's core identity</p>
            </div>
            <div class="bg-gray-800/50 p-4 rounded-lg">
                <div class="text-2xl mb-2">💡</div>
                <h5 class="font-medium mb-2">Creative Campaigns</h5>
                <p class="text-gray-400 text-sm">Innovative marketing campaigns</p>
            </div>
            <div class="bg-gray-800/50 p-4 rounded-lg">
                <div class="text-2xl mb-2">👥</div>
                <h5 class="font-medium mb-2">Social Media</h5>
                <p class="text-gray-400 text-sm">Building engaged communities</p>
            </div>
            <div class="bg-gray-800/50 p-4 rounded-lg">
                <div class="text-2xl mb-2">🚀</div>
                <h5 class="font-medium mb-2">Digital Growth</h5>
                <p class="text-gray-400 text-sm">Data-driven strategies</p>
            </div>
        </div>
        <div class="flex space-x-2 mt-4">
            <button onclick="editItem('services-preview', 1)" class="action-btn bg-yellow-600 hover:bg-yellow-700 px-3 py-1 rounded text-sm">
                <i data-lucide="edit" class="w-4 h-4 mr-1"></i>Edit
            </button>
        </div>
    </div>
</div>
<?= $this->section('scripts') ?>






<?= $this->endSection() ?>
<?= $this->endSection() ?>