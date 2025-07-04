<?= $this->extend('dashboard/layout/main.php') ?>


<?= $this->section('styles') ?>

<style>

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
  <div id="careers-content" class="page-content p-4 lg:p-6 ">
            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
                <h3 class="text-xl font-semibold">Careers Management</h3>
                <button onclick="showAddModal('careers')" class="action-btn bg-green-600 hover:bg-green-700 px-4 py-2 rounded-lg transition-colors flex items-center">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Add Job Position
                </button>
            </div>

            <!-- Perks Section -->
            <div class="glass-card p-6 rounded-xl mb-6">
                <h4 class="text-lg font-semibold mb-4 text-green-400">Company Perks</h4>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <div class="text-2xl mb-2">🏖️</div>
                        <h5 class="font-medium mb-2">Unlimited Leave</h5>
                        <p class="text-gray-400 text-sm">Take time off when you need it. We trust you to manage your time.</p>
                        <div class="flex space-x-2 mt-3">
                            <button onclick="editItem('perk', 1)" class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">Edit</button>
                        </div>
                    </div>
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <div class="text-2xl mb-2">🌎</div>
                        <h5 class="font-medium mb-2">Remote Friendly</h5>
                        <p class="text-gray-400 text-sm">Work from anywhere in the world with flexible hours.</p>
                        <div class="flex space-x-2 mt-3">
                            <button onclick="editItem('perk', 2)" class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">Edit</button>
                        </div>
                    </div>
                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <div class="text-2xl mb-2">🎨</div>
                        <h5 class="font-medium mb-2">Creative Freedom</h5>
                        <p class="text-gray-400 text-sm">Your ideas matter. Space and tools for creative visions.</p>
                        <div class="flex space-x-2 mt-3">
                            <button onclick="editItem('perk', 3)" class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">Edit</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Open Positions -->
            <div class="glass-card p-6 rounded-xl">
                <h4 class="text-lg font-semibold mb-4 text-green-400">Open Positions</h4>
                <div class="overflow-x-auto">
                    <table class="data-table w-full">
                        <thead>
                            <tr class="border-b border-gray-700">
                                <th class="text-left p-3">Position</th>
                                <th class="text-left p-3">Description</th>
                                <th class="text-left p-3">Location</th>
                                <th class="text-left p-3">Experience</th>
                                <th class="text-left p-3">Tags</th>
                                <th class="text-left p-3">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="p-3 font-medium">Senior Creative Director</td>
                                <td class="p-3 text-gray-400 max-w-xs truncate">Lead creative vision for major brand campaigns</td>
                                <td class="p-3">Remote</td>
                                <td class="p-3">5+ years</td>
                                <td class="p-3">
                                    <div class="flex flex-wrap gap-1">
                                        <span class="px-2 py-1 bg-blue-400/20 text-blue-400 rounded-full text-xs">Full-time</span>
                                        <span class="px-2 py-1 bg-purple-400/20 text-purple-400 rounded-full text-xs">Remote</span>
                                    </div>
                                </td>
                                <td class="p-3">
                                    <div class="flex space-x-2">
                                        <button onclick="editItem('job', 1)" class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="edit" class="w-3 h-3"></i>
                                        </button>
                                        <button onclick="viewItem('job', 1)" class="action-btn bg-green-600 hover:bg-green-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="eye" class="w-3 h-3"></i>
                                        </button>
                                        <button onclick="deleteItem('job', 1)" class="action-btn bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
<?= $this->section('scripts') ?>

<script>
    const generateAddForm = (formType) => {

        const form = {
            "home": `<form class="space-y-4" onsubmit="handleFormSubmit(event, 'home')">
                <div>
                    <label class="block text-sm font-medium mb-2">Section Type</label>
                    <select class="w-full p-3 form-input rounded-lg text-white" name="sectionType">
                        <option>Hero Section</option>
                        <option>Services</option>
                        <option>About</option>
                        <option>CTA</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Title</label>
                    <input type="text" name="title" class="w-full p-3 form-input rounded-lg text-white" placeholder="Enter title">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="description" class="w-full p-3 form-input rounded-lg text-white h-24" placeholder="Enter description"></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 rounded-lg transition-colors">Add Section</button>
                </div>
            </form>`,
        }
        return form[formType] || '';
    }
    const generateEditForm = (formType, itemId) => {
        const form = {
            "hero": `<form class="space-y-4" onsubmit="handleFormSubmit(event, 'hero', ${itemId})">
                <div>
                    <label class="block text-sm font-medium mb-2">Main Title</label>
                    <input type="text" name="mainTitle" class="w-full p-3 form-input rounded-lg text-white" value="Building Digital Icons">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Subtitle</label>
                    <input type="text" name="subtitle" class="w-full p-3 form-input rounded-lg text-white" value="Transforming brands into cultural phenomena">
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Description</label>
                    <textarea name="description" class="w-full p-3 form-input rounded-lg text-white h-24">Transforming brands into cultural phenomena through strategic storytelling and innovative campaigns.</textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeModal()" class="px-4 py-2 bg-gray-600 hover:bg-gray-700 rounded-lg transition-colors">Cancel</button>
                    <button type="submit" class="px-4 py-2 bg-yellow-600 hover:bg-yellow-700 rounded-lg transition-colors">Save Changes</button>
                </div>
            </form>`,
        }
        return form[formType] || '';
    }

    const generateViewContent = (formType, itemId) => {
        const content = {
            "hero": `<div class="space-y-4">
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <h4 class="font-medium mb-2">Details for ${formType.charAt(0).toUpperCase() + formType.slice(1)} #${itemId}</h4>
                        <div class="space-y-2 text-sm text-gray-300">
                            <p><strong>Title:</strong> Sample ${formType} title</p>
                            <p><strong>Status:</strong> <span class="px-2 py-1 bg-green-500/20 text-green-400 rounded-full text-xs">Active</span></p>
                            <p><strong>Created:</strong> ${new Date().toLocaleDateString()}</p>
                            <p><strong>Last Modified:</strong> ${new Date().toLocaleDateString()}</p>
                        </div>
                    </div>
                    <div class="bg-gray-800/50 rounded-lg p-4">
                        <h4 class="font-medium mb-2">Description</h4>
                        <p class="text-gray-300 text-sm">This is a sample description for ${formType} #${itemId}. It contains detailed information about the item and its purpose.</p>
                    </div>
                </div>`,
        }
        return content[formType] || '';
    }
</script>

<?= $this->endSection() ?>
<?= $this->endSection() ?>