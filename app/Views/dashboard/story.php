<?= $this->extend('dashboard/layout/main.php') ?>


<?= $this->section('styles') ?>

<style>

</style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div id="story-content" class="page-content p-4 lg:p-6 ">
    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-6 gap-4">
        <h3 class="text-xl font-semibold">Our Story Management</h3>
        <button onclick="showAddModal('timeline')" class="action-btn bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg transition-colors flex items-center">
            <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
            Add Timeline Event
        </button>
    </div>

    <!-- Timeline Events -->
    <div class="glass-card p-6 rounded-xl mb-6">
        <h4 class="text-lg font-semibold mb-4 text-purple-400">Timeline Events</h4>
        <div class="overflow-x-auto">
            <table class="data-table w-full">
                <thead>
                    <tr class="border-b border-gray-700">
                        <th class="text-left p-3">Year</th>
                        <th class="text-left p-3">Title</th>
                        <th class="text-left p-3">Description</th>
                        <th class="text-left p-3">Color</th>
                        <th class="text-left p-3">Actions</th>
                    </tr>
                </thead>
                <tbody id="story-timeline-table">
                    <?php if (!empty($story['timeline']) && is_array($story['timeline'])): ?>
                        <?php foreach ($story['timeline'] as $item): ?>
                            <?php
                            // Validate and sanitize fields
                            $id = isset($item['id']) ? (int)$item['id'] : 0;
                            $year = isset($item['year']) ? esc($item['year']) : 'N/A';
                            $title = isset($item['title']) ? esc($item['title']) : 'Untitled';
                            $desc = isset($item['description']) ? esc($item['description']) : 'No description';
                            $color = isset($item['accentColor']) ? esc($item['accentColor']) : 'gray-400';
                            ?>
                            <tr>
                                <td class="p-3 font-medium text-<?= $color ?>"><?= $year ?></td>
                                <td class="p-3"><?= $title ?></td>
                                <td class="p-3 text-gray-400"><?= $desc ?></td>
                                <td class="p-3">
                                    <span class="px-2 py-1 bg-<?= $color ?>/20 text-<?= $color ?> rounded-full text-xs"><?= $color ?></span>
                                </td>
                                <td class="p-3">
                                    <div class="flex space-x-2">
                                        <button
                                            onclick='editItem("timeline", JSON.parse(this.dataset.item))'
                                            data-item='<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>' class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="edit" class="w-3 h-3"></i>
                                        </button>
                                        <button

                                            onclick='viewItem("timeline", JSON.parse(this.dataset.item))'
                                            data-item='<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>'
                                            class="action-btn bg-green-600 hover:bg-green-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="eye" class="w-3 h-3"></i>
                                        </button>
                                        <button onclick="timelineDelete('timeline', <?= $id ?>)" class="action-btn bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs">
                                            <i data-lucide="trash-2" class="w-3 h-3"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="p-4 text-center text-gray-500">No timeline entries available.</td>
                        </tr>
                    <?php endif; ?>

                </tbody>
            </table>
        </div>
    </div>
    <!-- Add Stats  -->
    <div class="glass-card relative p-6 rounded-xl mb-6">
        <span class="flex mb-4 justify-between items-center ">
            <h4 class="text-lg font-semibold mb-4 text-purple-400">Orgix Stats</h4>
            <button onclick="showAddModal('stats')" class="action-btn bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg transition-colors flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add Stats
            </button>

        </span>


        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
            <?php if (!empty($story['stats'])): ?>
                <?php foreach ($story['stats'] as $index => $item): ?>

                    <div class="stat-card text-center p-4 sm:p-6 md:p-8 bg-slate-800/70 hover:shadow-md hover:shadow-blue-700 rounded-lg border border-gray-800 opacity-0"
                        data-stat="<?= esc($index) ?>">
                        <div class="text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-4"><?= esc($item['icon']) ?></div>
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 counter" data-target="<?= preg_replace('/\D/', '', $item['value']) ?>">
                            0
                        </div>
                        <div class="text-gray-400 text-xs sm:text-sm md:text-base"><?= esc($item['label']) ?></div>
                        <div class="flex space-x-2 items-center justify-center mt-3">
                            <button
                                onclick='editItem("stats", JSON.parse(this.dataset.item))'
                                data-item='<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>'

                                class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">Edit</button>
                            <button

                                onclick="statDelete(<?= $item['id'] ?>)"

                                class="action-btn bg-red-600 hover:bg-red-500 px-2 py-1 rounded text-xs">delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center text-gray-400">No stats available.</div>
            <?php endif; ?>

        </div>
    </div>

    <!-- Team Members -->
    <div class="glass-card p-6 rounded-xl mb-6">

        <span class="flex mb-4 justify-between items-center ">
            <h4 class="text-lg font-semibold mb-4 text-purple-400">Team Members</h4>
            <button onclick="showAddModal('team')" class="action-btn bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg transition-colors flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add Members
            </button>

        </span>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <?php

            $teamMembers = $story['team_members'] ?? [];

            if (is_array($teamMembers) && count($teamMembers) > 0):
            ?>

                <?php foreach ($teamMembers as $index => $member):
                    $name        = htmlspecialchars($member['name'] ?? 'Unnamed');
                    $role        = htmlspecialchars($member['role'] ?? 'No Role');
                    $emoji       = htmlspecialchars($member['emoji'] ?? '👤');
                    $desc        = htmlspecialchars($member['desc'] ?? 'No description available.');
                    $textColor   = htmlspecialchars($member['textColor'] ?? 'text-blue-400');
                    $color       = htmlspecialchars($member['color'] ?? 'from-blue-400 to-purple-600');
                    $profilePic  = htmlspecialchars($member['profilePic'] ?? '');
                ?>
                    <div
                        class="bg-gray-800/50 p-4 rounded-lg"
                        data-id="<?= $index ?>"
                        data-name="<?= $name ?>"
                        data-role="<?= $role ?>"
                        data-emoji="<?= $emoji ?>"
                        data-desc="<?= $desc ?>"
                        data-textcolor="<?= $textColor ?>"
                        data-color="<?= $color ?>"
                        data-profile="<?= $profilePic ?>">
                        <div class="text-2xl mb-2"><?= $emoji ?></div>
                        <h5 class="font-medium mb-1 text-white"><?= $name ?></h5>
                        <p class="text-sm mb-2 <?= $textColor ?>"><?= $role ?></p>
                        <p class="text-gray-400 text-xs"><?= $desc ?></p>

                        <?php if (!empty($profilePic)): ?>
                            <div class="mt-3">
                                <img src="<?= base_url($profilePic) ?>" alt="<?= $name ?> profile" class="w-16 h-16 rounded-full object-cover border border-gray-700" />
                            </div>
                        <?php endif; ?>

                        <div class="flex space-x-2 mt-3">
                            <button

                                onclick='editItem("team", JSON.parse(this.dataset.item))'
                                data-item='<?= htmlspecialchars(json_encode($member), ENT_QUOTES, 'UTF-8') ?>'


                                class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">Edit</button>
                            <button onclick='viewItem("team", <?= $index ?>)' class="action-btn bg-green-600 hover:bg-green-700 px-2 py-1 rounded text-xs">View</button>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="text-center text-gray-400 p-6">
                    <p class="text-lg">😕 No team members found.</p>
                    <p class="text-sm">Add your first team member to showcase your squad.</p>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <!-- gallery sction -->
 <div class="glass-card relative p-6 rounded-xl mb-6">
        <span class="flex mb-4 justify-between items-center ">
            <h4 class="text-lg font-semibold mb-4 text-purple-400">Orgix Gallery</h4>
            <button onclick="showAddModal('gallery')" class="action-btn bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg transition-colors flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add Gallery
            </button>

        </span>


    <?php if (!empty($story['gallery_items']) && is_array($story['gallery_items'])): ?>
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

    <?php foreach ($story['gallery_items'] as $item): ?>
        <?php
        // Validation & sanitization
        if (
            !isset($item['id'], $item['title'], $item['desc'], $item['media']) ||
            !is_array($item['media']) || empty($item['media'])
        ) {
            continue; // Skip invalid items
        }

        $id    = htmlspecialchars($item['id']);
        $title = htmlspecialchars($item['title']);
        $desc  = htmlspecialchars($item['desc']);
        $alt   = htmlspecialchars($item['alt'] ?? '');
        $hidden = $item['hidden'] ?? false;

        if ($hidden) continue; // Skip hidden items
        ?>

        <div class="bg-gray-800/50 rounded-lg p-4 relative shadow hover:shadow-lg transition-shadow">
            <!-- Media Preview (only first media) -->
            <div class="w-full h-48 bg-black rounded-lg overflow-hidden mb-3 relative">
                <?php
                $media = $item['media'][0] ?? null;
                $mediaUrl = htmlspecialchars($media['url'] ?? '');
                $mediaType = $media['type'] ?? '';
                ?>

                <?php if ($media && $mediaType === 'image'): ?>
                    <img src="<?= base_url($mediaUrl) ?>" alt="<?= $alt ?>" class="w-full h-full object-fill">
                <?php elseif ($media && $mediaType === 'video'): ?>
                    <video controls class="w-full h-full object-cover">
                        <source src="<?= base_url($mediaUrl) ?>" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                <?php else: ?>
                    <div class="w-full h-full bg-gray-700 flex items-center justify-center text-sm text-white italic">
                        No valid media
                    </div>
                <?php endif; ?>
            </div>

            <!-- Text Content -->
            <h4 class="text-white font-semibold text-lg mb-1"><?= $title ?></h4>
            <p class="text-gray-300 text-sm"><?= $desc ?></p>
            <p class="text-gray-500 text-xs mt-1 italic"><?= $alt ?></p>

            <!-- Action Buttons -->
            <div class="flex space-x-2 mt-3">
          <button onclick='editItem("gallery", <?= json_encode($item, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>)'
        class="bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs text-white transition">
    ✏️ Edit
</button>

                <button onclick="galleryDelete('gallery', '<?= $id ?>')"
                        class="bg-red-600 hover:bg-red-700 px-2 py-1 rounded text-xs text-white transition">
                    🗑 Delete
                </button>
            </div>
        </div>

    <?php endforeach; ?>

</div>
<?php else: ?>
    <div class="text-gray-400 italic">No gallery items available.</div>
<?php endif; ?>

    </div>

</div>
<?= $this->section('scripts') ?>
<script src="<?= base_url('assets/js/dashboard/story.js') ?>"></script>
<?= $this->endSection() ?>
<?= $this->endSection() ?>