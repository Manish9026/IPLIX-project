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
    .floating-icon {
      animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
      0%, 100% {
        transform: translateY(0);
      }
      50% {
        transform: translateY(-15px);
      }
    }
</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="home-content" class="page-content p-4 lg:p-6 ">


    <div class="mb-6">
  <label for="sectionSelect" class="block text-sm text-white mb-1">Select Hero Section</label>
  <select id="sectionSelect" onchange="fetchHeroData()"  class="form-input w-full p-3 rounded-lg bg-gray-800 text-white">
    <option hidden value="">Select Section</option>
    <option value="home">Home</option>
    <option value="services">Services</option>
    <option value="work">Work</option>
    <option value="career">Career</option>
    <option value="contact">Contact</option>
    <option value="story">Story</option>
  </select>
</div>


    <div id="heroDataContainer"></div>
 
</div>
<?= $this->section('scripts') ?>


  <script  src="<?= base_url('assets/js/dashboard/hero.js') ?>"></script>



<?= $this->endSection() ?>
<?= $this->endSection() ?>