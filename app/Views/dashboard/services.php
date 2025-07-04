<?= $this->extend('dashboard/layout/main.php') ?>


<?= $this->section('styles') ?>

<style>

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="services-content" class="page-content p-4 lg:p-6 ">
  <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
    <h3 class="text-xl font-semibold">Services Management</h3>
    <button onclick="showAddModal('services')" class="action-btn bg-cyan-600 hover:bg-cyan-700 px-4 py-2 rounded-lg transition-colors flex items-center">
      <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
      Add Service
    </button>
  </div>

  <div class="glass-card p-6 rounded-xl">
    <h4 class="text-lg font-semibold mb-4 text-cyan-400">Available Services</h4>
    <div class="overflow-x-auto">
      <table class="data-table w-full">
        <thead>
          <tr class="border-b border-gray-700">
            <th class="text-left p-3">Service</th>
            <th class="text-left p-3">Icon</th>
            <th class="text-left p-3">Description</th>
            <th class="text-left p-3">Features</th>
            <th class="text-left p-3">Actions</th>
          </tr>
        </thead>
        <tbody>

          <?php if (isset($data['services']) && is_array($data["services"])): ?>
            <?php foreach ($data['services'] as $service): ?>
              <!-- Example Output -->

              <tr>
                <td class="p-3 font-medium"><?= esc($service['title'] ?? 'No Title') ?></td>
                <td class="p-3 text-2xl"><?= esc($service['icon'] ?? '🎯') ?></td>
                <td class="p-3 text-gray-400 max-w-xs truncate"><?= esc($service["description"]) ?? "We help define your brand's core identity, positioning, and messaging strategy..."  ?></td>
                <td class="p-3">
                  <div class="flex flex-wrap gap-1">
                    <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs"><?= esc($service["features"][0]) ?? "No features" ?></span>
                    <span class="px-2 py-1 bg-blue-500/20 text-blue-400 rounded-full text-xs">
                      <?php if (isset($service["features"][1])): ?>
                        <!-- <?= esc($service["features"][1]) ?> -->
                        <?= esc(count($service["features"]) - 1 . " More" ?? '') ?>
                      <?php else: ?>
                        No additional features
                      <?php endif; ?>


                    </span>
                  </div>
                </td>
                <td class="p-3">
                  <div class="flex space-x-2">
                    <button onclick="editItem('service', <?= esc($service['id']) ?>)" class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">
                      <i data-lucide="edit" class="w-3 h-3"></i>
                    </button>
                    <button onclick="viewItem('service', <?= esc($service['id']) ?>)" class="action-btn bg-green-600 hover:bg-green-700 px-2 py-1 rounded text-xs">
                      <i data-lucide="eye" class="w-3 h-3"></i>
                    </button>
                    <button onclick="deleteServices('service', <?= esc($service['id']) ?>)" class="action-btn bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs">
                      <i data-lucide="trash-2" class="w-3 h-3"></i>
                    </button>
                  </div>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <p>No services found.</p>
          <?php endif; ?>


        </tbody>
      </table>
    </div>
  </div>
</div>
<?= $this->section('scripts') ?>


  <script  src="<?= base_url('assets/js/dashboard/services.js') ?>"></script>

  <?= $this->endSection() ?>
  <?= $this->endSection() ?>