<?= $this->extend('dashboard/layout/main.php') ?>


<?= $this->section('styles') ?>

    <style>
        /* Fix horizontal scroll issues and ensure full screen coverage */
        body {
            overflow-x: hidden; /* Prevent horizontal scroll */
            min-height: 100vh; /* Ensure full screen coverage */
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="overview-content" class="page-content p-4 lg:p-6">
            <!-- Metrics Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-6 mb-8">
                <div class="metric-card card-hover p-6 rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-blue-500/20 rounded-lg">
                            <i data-lucide="users" class="w-6 h-6 text-blue-400"></i>
                        </div>
                        <span class="counter text-2xl font-bold">1,234</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Total Visitors</h3>
                    <div class="flex items-center mt-2">
                        <i data-lucide="trending-up" class="w-4 h-4 text-green-400 mr-1"></i>
                        <span class="text-green-400 text-sm">+12%</span>
                    </div>
                </div>
                
                <div class="metric-card card-hover p-6 rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-purple-500/20 rounded-lg">
                            <i data-lucide="briefcase" class="w-6 h-6 text-purple-400"></i>
                        </div>
                        <span class="counter text-2xl font-bold">156</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Active Projects</h3>
                    <div class="flex items-center mt-2">
                        <i data-lucide="trending-up" class="w-4 h-4 text-green-400 mr-1"></i>
                        <span class="text-green-400 text-sm">+8%</span>
                    </div>
                </div>
                
                <div class="metric-card card-hover p-6 rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-green-500/20 rounded-lg">
                            <i data-lucide="dollar-sign" class="w-6 h-6 text-green-400"></i>
                        </div>
                        <span class="counter text-2xl font-bold">89,432</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Revenue ($)</h3>
                    <div class="flex items-center mt-2">
                        <i data-lucide="trending-up" class="w-4 h-4 text-green-400 mr-1"></i>
                        <span class="text-green-400 text-sm">+15%</span>
                    </div>
                </div>
                
                <div class="metric-card card-hover p-6 rounded-xl">
                    <div class="flex items-center justify-between mb-4">
                        <div class="p-3 bg-orange-500/20 rounded-lg">
                            <i data-lucide="star" class="w-6 h-6 text-orange-400"></i>
                        </div>
                        <span class="counter text-2xl font-bold">4.9</span>
                    </div>
                    <h3 class="text-gray-400 text-sm">Client Rating</h3>
                    <div class="flex items-center mt-2">
                        <i data-lucide="trending-up" class="w-4 h-4 text-green-400 mr-1"></i>
                        <span class="text-green-400 text-sm">+0.2</span>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
                <div class="glass-card p-6 rounded-xl">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <i data-lucide="zap" class="w-5 h-5 mr-2 text-yellow-400"></i>
                        Quick Actions
                    </h3>
                    <div class="grid grid-cols-2 gap-3">
                        <button class="quick-action-btn action-btn p-4 bg-blue-600/20 hover:bg-blue-600/30 rounded-lg border border-blue-600/30 transition-colors">
                            <i data-lucide="plus" class="w-5 h-5 mx-auto mb-2 text-blue-400"></i>
                            <span class="text-sm">New Project</span>
                        </button>
                        <button class="quick-action-btn action-btn p-4 bg-purple-600/20 hover:bg-purple-600/30 rounded-lg border border-purple-600/30 transition-colors">
                            <i data-lucide="users" class="w-5 h-5 mx-auto mb-2 text-purple-400"></i>
                            <span class="text-sm">Add Team</span>
                        </button>
                        <button class="quick-action-btn action-btn p-4 bg-green-600/20 hover:bg-green-600/30 rounded-lg border border-green-600/30 transition-colors">
                            <i data-lucide="bar-chart" class="w-5 h-5 mx-auto mb-2 text-green-400"></i>
                            <span class="text-sm">Analytics</span>
                        </button>
                        <button class="quick-action-btn action-btn p-4 bg-orange-600/20 hover:bg-orange-600/30 rounded-lg border border-orange-600/30 transition-colors">
                            <i data-lucide="settings" class="w-5 h-5 mx-auto mb-2 text-orange-400"></i>
                            <span class="text-sm">Settings</span>
                        </button>
                    </div>
                </div>
                
                <div class="glass-card p-6 rounded-xl">
                    <h3 class="text-lg font-semibold mb-4 flex items-center">
                        <i data-lucide="activity" class="w-5 h-5 mr-2 text-green-400"></i>
                        Recent Activity
                    </h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 p-3 bg-gray-800/50 rounded-lg">
                            <div class="w-2 h-2 bg-green-400 rounded-full"></div>
                            <span class="text-sm">New project created</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-800/50 rounded-lg">
                            <div class="w-2 h-2 bg-blue-400 rounded-full"></div>
                            <span class="text-sm">Team member added</span>
                        </div>
                        <div class="flex items-center space-x-3 p-3 bg-gray-800/50 rounded-lg">
                            <div class="w-2 h-2 bg-yellow-400 rounded-full"></div>
                            <span class="text-sm">Report generated</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

<?= $this->section('scripts') ?>

<?= $this->endSection() ?>
<?= $this->endSection() ?>