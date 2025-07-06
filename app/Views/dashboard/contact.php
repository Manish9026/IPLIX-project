<?= $this->extend('dashboard/layout/main.php') ?>
<?php

use function PHPUnit\Framework\isEmpty;

$company = $info['company'] ?? [];
$contact = $info['contact'] ?? [];
$social = $info['social'] ?? [];
$clients = $info['clients'] ?? [];
?>

<?= $this->section('styles') ?>

<style>

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="contact-content" class="page-content p-4 lg:p-6 ">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <h3 class="text-xl font-semibold">Contact Management</h3>
        <button onclick="showAddModal('company')" class="action-btn bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg transition-colors flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add new section
        </button>
    </div>


    <?php

    if (isset($company)): ?>
        <section id="companyInfoDisplay" class="glass-card relative text-state-100 rounded-xl p-6 mb-10 ">
            <div class="">
                <h1 class="text-lg font-semibold mb-4 text-indigo-400">Company Profle</h1>
            </div>

            <div class="flex items-center space-x-6 mb-6">


                <!-- Logo Preview -->
                <div class="w-20 h-20 rounded-full bg-gray-100 overflow-hidden border border-gray-300 flex-shrink-0">
                    <img id="companyLogo" src="<?= base_url($company['logo']) ?>" alt="Company Logo" class="object-cover w-full h-full" />
                </div>

                <!-- Name & Subtitle -->
                <div>
                    <h2 id="companyName" class="text-xl font-semibold text-gray-50"><?= esc($company['name']) ?></h2>
                    <p id="companySubTitle" class="text-gray-400 text-sm"><?= esc($company['subTitle']) ?></p>
                </div>

                <!-- Edit Button -->
                <div class=" absolute top-5 right-5 ml-auto">
                    <button
                        data-company='<?= htmlspecialchars(json_encode($company ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)) ?>'
                        onclick="editItem('company',JSON.parse(this.dataset.company))"
                        class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600 transition">
                        ✏️ Edit
                    </button>
                </div>
            </div>

            <div class="flex flex-wrap justify-between w-full items-center">

            
               <div>
                <h3 class="font-semibold text-gray-200 mb-2">Company Address</h3>
                <p id="companyDescription" class="text-gray-300 text-sm leading-relaxed">    <i class="fa-solid fa-location-dot animate-pulse mr-4 text-indigo-600"></i> <?= esc($company['address']) ?></p>
            </div>

            <!-- Description -->
            <div>
                <h3 class="font-semibold text-gray-200 mb-2">Description</h3>
                <p id="companyDescription" class="text-gray-400 text-sm leading-relaxed"><?= esc($company['description']) ?></p>
            </div>
            </div>
        
        </section>
    <?php else : ?>
        <span class="glass-card mb-6 p-6 flex items-center justify-center flex-col rounded-xl gap-4">
            <h3>Add Company Data</h3>
            <button onclick="showAddModal('company')" class="action-btn bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg transition-colors flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add company section
            </button>
        </span>
    <?php endif; ?>

    <!-- Contact Information -->

    <?php

    if (isset($contact) && is_array($contact) && count($contact)): ?>
        <div class="glass-card p-6 rounded-xl mb-6">
            <span class="flex justify-between items-center ">
                <h4 class="text-lg font-semibold mb-4 text-indigo-400">Contact Information</h4>
                <button onclick="showAddModal('contact')" class="action-btn bg-indigo-600 hover:bg-indigo-700 px-4 py-2 -mt-4 rounded-lg transition-colors flex items-center">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Add contact
                </button>
            </span>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <?php foreach ($contact as $item) : ?>

                    <div class="bg-gray-800/50 p-4 rounded-lg">
                        <div class="flex items-center mb-3">
                            <i data-lucide="<?= esc($item['icon']) ?>" class=" <?= esc($item['icon']) ?> w-5 h-5 text-indigo-400 mr-3"></i>
                            <h5 class="font-medium"><?= esc($item['title']) ?></h5>
                        </div>
                        <p class="text-gray-400 truncate text-sm mb-3"><?= esc($item['value']) ?></p>
                        <p class="text-gray-400 text-xs mb-3"><?= esc($item['description']) ?></p>
                        <div class="flex space-x-2">
                            <button

                                data-contact='<?= htmlspecialchars(json_encode($item ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)) ?>'
                                onclick="editItem('contact',JSON.parse(this.dataset.contact))"

                                class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">Edit</button>

                            <button


                                onclick="onContactDelete('contact','<?= esc($item['id']) ?>')"

                                class="action-btn bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else : ?>
        <span class="glass-card mb-6 p-6 flex items-center justify-center flex-col rounded-xl gap-4">
            <h3>Add contact Data:-phone No,Email,Address</h3>
            <button onclick="showAddModal('contact')" class="action-btn bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg transition-colors flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add First Contact
            </button>
        </span>
    <?php endif; ?>

    <?php

    if (isset($social) && is_array($social) && count($social)): ?>
        <div class="glass-card p-6 rounded-xl mb-6">
            <span class="flex justify-between items-center ">
                <h4 class="text-lg font-semibold mb-4 text-indigo-400">Social Media Information</h4>
                <button onclick="showAddModal('social')" class="action-btn bg-indigo-600 hover:bg-indigo-700 px-4 py-2 -mt-4 rounded-lg transition-colors flex items-center">
                    <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                    Add social links
                </button>
            </span>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">

                <?php foreach ($social as $item) : ?>
                    <div class="p-4 bg-gray-800/50  rounded-lg shadow ">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-lg font-bold text-gray-200"><?= esc($item['title']) ?></h3>
                            <span class="text-sm px-2 py-1 rounded bg-<?= esc($item['color'] ?? 'blue') ?>-600" style="background:<?= esc($item['color'] ?? '#eee') ?> "><?= esc($item['color']) ?></span>
                        </div>
                        <p class="text-sm text-gray-300 break-all"><?= esc($item['link'] ?? '') ?></p>
                        <i data-lucide="<?= esc($item['icons']) ?>" class="<?= esc($item['icons']) ?> text-2xl mt-2 text-<?= esc($item['color'] ?? 'blue') ?>-600 text-[<?= esc($item['color'] ?? '#1DA1F2') ?>]"></i>
                        <div class="flex space-x-2">
                            <button

                                data-social='<?= htmlspecialchars(json_encode($item ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)) ?>'
                                onclick="editItem('social',JSON.parse(this.dataset.social))"

                                class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">Edit</button>

                            <button


                                onclick="deleteSocialItem('social','<?= esc($item['id']) ?>')"

                                class="action-btn bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs">Delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php else : ?>
        <span class="glass-card mb-6 p-6 flex items-center justify-center flex-col rounded-xl gap-4">
            <h3>Add Social Media Data:-facebook ,instagram,youtube,linkedin</h3>
            <button onclick="showAddModal('social')" class="action-btn bg-indigo-600 hover:bg-indigo-700 px-4 py-2 rounded-lg transition-colors flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add First Link
            </button>
        </span>
    <?php endif; ?>

    <!-- Contact Messages -->

    <?php

    if (isset($clients) && is_array($clients) && count($clients)): ?>


        <div class="glass-card p-6 rounded-xl">
            <h4 class="text-lg font-semibold mb-4 text-indigo-400">Recent Messages</h4>
            <div class="overflow-x-auto">
                <table class="data-table w-full">
                    <thead>
                        <tr class="border-b border-gray-700">
                            <th class="text-left p-3">Name</th>
                            <th class="text-left p-3">Email</th>
                            <th class="text-left p-3">Subject</th>
                            <th class="text-left p-3">Date</th>
                            <th class="text-left p-3">Status</th>
                            <th class="text-left p-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($clients as $item) : ?>
                            <tr>
                                <td class="p-3 font-medium"><?= esc($item['name'] ?? "") ?></td>
                                <td class="p-3 text-gray-400"><?= esc($item['email'] ?? "") ?></td>
                                <td class="p-3 min-w-[250px]"><?= esc($item['service'] ?? "") ?></td>
                                <td class="p-3 text-gray-400">2024-01-15</td>
                                <td class="p-3">
                                    <span class="px-2 py-1 border border-yellow-400/60 text-yellow-400 rounded-full text-xs"><?= esc($item['mobNo'] ?? "")?></span>
                                </td>
                                <td class="p-3">
                                    <div class="flex space-x-2">
                                        <button onclick="replyMessage(1)" class="action-btn bg-blue-600 hover:bg-blue-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="reply" class="w-3 h-3"></i>
                                        </button>
                                        <button 
                                          data-client='<?= htmlspecialchars(json_encode($item ?? [], JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP)) ?>'
                                onclick="viewItem('client',JSON.parse(this.dataset.client))"
                                        
                                        class="action-btn bg-green-600 hover:bg-green-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="eye" class="w-3 h-3"></i>
                                        </button>
                                        <button

                                            onclick="onContactDelete('client', '<?=esc($item['id'])?>')" class="action-btn bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>


    <?php else : ?>
        <span class="glass-card capitalize mb-6 p-6 flex items-center justify-center flex-col rounded-xl gap-4">
            <h3>no messages </h3>

        </span>
    <?php endif; ?>

</div>
<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/dashboard/contact.js') ?>"></script>


<?= $this->endSection() ?>
<?= $this->endSection() ?>