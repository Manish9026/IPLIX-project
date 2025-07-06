<?php
$result = $work['result'] ?? [];
$impactList = $work['impacts'] ?? [];
?>

<div class="">

    <section class="glass-card p-4 flex flex-col mb-6 gap-2 rounded-xl sm:gap-4 relative z-[1]">

        <span class="absolute top-5 right-5"><button onclick="showAddModal('hero')" class="bg-yellow-500 px-4 py-1 capitalize rounded-md hover:bg-yellow-700 transition-color duration-500 ease">edit</button></span>

        <h2 class="text-3xl font-bold text-start mb-4 capitalize">hero Content of Work page</h2>
        <div class=" rounded-lg  max-w-6xl ">

            <div class=" rounded-lg !max-h-[400px]">
                <!-- Swiper -->
                <div class=" swiper mySwiper  overflow-hidden ">
                    <p class="text-xl font-bold text-start mb-4 capitalize">Background images</p>
                    <div style="max-height:200px;" class="swiper-wrapper">

                        <!-- Slide 1: Image -->
                        <div class="swiper-slide">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlajdvGN2O3agy3ehZ5hdjEjJfz8sZ5KAImA&s" class="rounded-xl w-full h-full object-cover" alt="Nature" />
                        </div>

                        <!-- Slide 2: Video -->
                        <div class="swiper-slide aspect-video">
                            <video controls class="w-full h-full object-cover">
                                <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" />
                            </video>
                        </div>

                        <!-- Slide 3: Image -->
                        <div class="swiper-slide aspect-video">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHhsajqTcB0HkHarF5IzXFiAYICNPiSsm3tQ&s" class="w-full h-full object-cover" alt="Tech" />
                        </div>

                    </div>

                    <!-- Pagination & Navigation -->
                    <div class="swiper-pagination"></div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>

            </div>

        </div>
        <div class="">
            <div class=" swiper card-swiper  overflow-hidden">
                <p class="text-xl font-bold text-start mb-4 capitalize">Background images</p>
                <div class="swiper-wrapper">

                    <!-- Slide 1: Image -->
                    <div class="swiper-slide w-[200px] !rounded-lg  aspect-video ">

                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlajdvGN2O3agy3ehZ5hdjEjJfz8sZ5KAImA&s" class="w-full h-full object-cover rounded-lg" alt="Nature" />


                    </div>
                    <div class="swiper-slide w-[200px] !rounded-lg  aspect-video ">

                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlajdvGN2O3agy3ehZ5hdjEjJfz8sZ5KAImA&s" class="w-full h-full object-cover rounded-lg" alt="Nature" />


                    </div>
                    <div class="swiper-slide w-[200px] !rounded-lg  aspect-video ">

                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSlajdvGN2O3agy3ehZ5hdjEjJfz8sZ5KAImA&s" class="w-full h-full object-cover rounded-lg" alt="Nature" />


                    </div>
                    <!-- Slide 2: Video -->
                    <div class="swiper-slide w-[200px] aspect-video">
                        <video controls class="w-full h-full object-cover">
                            <source src="https://www.w3schools.com/html/mov_bbb.mp4" type="video/mp4" />
                        </video>
                    </div>

                    <!-- Slide 3: Image -->
                    <div class="swiper-slide aspect-video">
                        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSHhsajqTcB0HkHarF5IzXFiAYICNPiSsm3tQ&s" class="w-full h-full object-cover" alt="Tech" />
                    </div>

                </div>

                <!-- Pagination & Navigation -->
                <div class="swiper-pagination"></div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
            </div>

        </div>

        <div class="mt-2 px-4 py-6 flex flex-wrap flex-1 gap-4">
            <span class="flex flex-col gap-2">
                <h2 class="text-xl font-bold">Work Title</h2>
                <span class="text-sm font-medium flex-1 form-input p-4 rounded-md focus:border-blue-600 border-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, ex.</span>
            </span>
            <span class="flex flex-col gap-2">
                <h2 class="text-xl font-bold">Description</h2>
                <span class="text-sm font-medium form-input p-4 rounded-md focus:border-blue-600 border-2">Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem, ex.</span>
            </span>

        </div>

    </section>



    <section class="glass-card relative p-6 rounded-xl mb-6">
        <span class="flex mb-4 justify-between items-center ">
            <h4 class="text-lg font-semibold mb-4 text-purple-400">Orgix Stats</h4>
            <button onclick="showAddModal('stats','param1','2','3')" class="action-btn bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg transition-colors flex items-center">
                <i data-lucide="plus" class="w-4 h-4 mr-2"></i>
                Add Stats
            </button>

        </span>


        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 md:gap-8">
            <?php if (!empty($result)): ?>
                <?php foreach ($result as $index => $item): ?>

                    <div class="stat-card text-center p-4 sm:p-6 md:p-8 bg-slate-800/70 hover:shadow-md hover:shadow-blue-700 rounded-lg border border-gray-800 opacity-0"
                        data-stat="<?= esc($index) ?>">
                        <div class="text-2xl sm:text-3xl md:text-4xl mb-2 sm:mb-4"><?= esc($item['icon']) ?></div>
                        <div class="text-xl sm:text-2xl md:text-3xl font-bold mb-1 sm:mb-2 counter" data-target="<?= preg_replace('/\D/', '', $item['value']) ?>">
                            0
                        </div>
                        <div class="text-gray-400 text-xs sm:text-sm md:text-base"><?= esc($item['label']) ?></div>
                        <div class="flex space-x-2 items-center justify-center mt-3">
                            <button
                                onclick='showAddModal("stats", JSON.parse(this.dataset.item),"edit")'
                                data-item='<?= htmlspecialchars(json_encode($item), ENT_QUOTES, 'UTF-8') ?>'

                                class="action-btn bg-yellow-600 hover:bg-yellow-700 px-2 py-1 rounded text-xs">Edit</button>
                            <button

                                onclick="handleStatDelete('<?= esc($item['id']) ?>')"

                                class="action-btn bg-red-600 hover:bg-red-500 px-2 py-1 rounded text-xs">delete</button>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center text-gray-400 flex flex-col items-center">
                    <h2>No stats available. </h2>
                    <p>Add new Stats</p>
                </div>
            <?php endif; ?>

        </div>
    </section>
    <section class="max-w-6xl mx-auto px-4 py-4 glass-card  rounded-xl">

        <?php if (!empty($impactList)): ?>

            <section class="max-w-6xl mx-auto px-4 py-6 rounded-xl">
                <div class="flex justify-between items-center mb-6">
                    <h1 class="text-xl font-semibold">Work Impact</h1>
                    <button onclick="showAddModal('impact')" class="bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg text-white flex items-center gap-2">
                        <i class="lucide lucide-plus"></i> Add Impact
                    </button>
                </div>

                <div class="swiper impact-slider">
                    <div class="swiper-wrapper">
                        <?php foreach ($impactList as $impact): ?>
                            <div class="swiper-slide" id="impact-<?=esc($impact['id']) ?>">
                                <div class="relative space-y-6">
                                    <h2 class="text-3xl font-bold text-purple-400"><?= esc($impact['title'] ?? 'The Impact') ?></h2>

                                    <span class="absolute top-0 right-5 flex gap-2">
                                        <button
                                                  onclick='showAddModal("impact", JSON.parse(this.dataset.item),"edit")'
                                data-item='<?= htmlspecialchars(json_encode($impact), ENT_QUOTES, 'UTF-8') ?>'

                                        class="bg-yellow-500 hover:bg-yellow-700 px-4 py-1 rounded-md text-white">Edit</button>
                                        <button onclick="handleDeleteImpact('<?= $impact['id'] ?>')" class="bg-red-500 hover:bg-red-700 px-4 py-1 rounded-md text-white">Delete</button>
                                    </span>

                                    <?php if (!empty($impact['points'])): ?>
                                        <ul class="space-y-2 text-lg text-gray-300">
                                            <?php foreach ($impact['points'] as $point): ?>
                                                <li>• <?= esc($point) ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 mt-6">
                                        <?php foreach ($impact['media'] ?? [] as $media): ?>
                                            <div class="rounded-xl overflow-hidden transform hover:scale-105 transition duration-300">
                                                <?php if (str_starts_with($media['type'], 'video')): ?>
                                                    <video controls class="w-full h-60 object-cover">
                                                        <source src="<?= base_url($media['url']) ?>" type="<?= esc($media['type']) ?>">
                                                    </video>
                                                <?php else: ?>
                                                    <img src="<?= base_url($media['url']) ?>" alt="Impact Media" class="w-full h-60 object-cover" />
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class="swiper-pagination mt-4"></div>
                </div>
            </section>



        <?php else: ?>
            <div class="text-center py-20 text-gray-400">
                <h2 class="text-2xl font-semibold mb-2">No Impact Items Found</h2>
                <p class="mb-4">Start by adding the first impact section to highlight your success.</p>
                <button onclick="showAddModal('impact')" class="px-5 py-2 bg-purple-600 hover:bg-purple-700 rounded-lg text-white">Add Impact</button>
            </div>
        <?php endif; ?>


    </section>
    <section class="max-w-6xl mx-auto mt-6 px-4 py-4 glass-card rounded-xl">

        <span class="flex w-full flex-wrap justify-between items-start lg:items-center mb-6 gap-4">
            <h1 class="text-xl font-semibold">Work Challenges</h1>
            <button onclick="showAddModal('challenge')" class="action-btn bg-purple-600 hover:bg-purple-700 px-4 py-2 rounded-lg transition-colors flex items-center" style="translate: none; rotate: none; scale: none; opacity: 1; transform: translate(0px);">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" data-lucide="plus" class="lucide lucide-plus w-4 h-4 mr-2">
                    <path d="M5 12h14"></path>
                    <path d="M12 5v14"></path>
                </svg>
                Add new challenge
            </button>
        </span>
        <div class="swiper challenge-slider">


            <div class="swiper-wrapper">

                <!-- Slide 1 -->
                <div class="swiper-slide w-full md:w-1/2 lg:w-1/4 px-2 box-border">
                    <div id="challengeView" class="bg-gradient-to-br from-purple-800/60 to-gray-900 rounded-2xl shadow-xl p-8 text-white relative">
                        <span class="absolute top-5 right-5 flex gap-2"><button onclick="showAddModal('hero')" class="action-btn  bg-yellow-500 px-4 py-1 capitalize rounded-md hover:bg-yellow-700 transition-color duration-500 ease">edit</button><button onclick="showAddModal('hero')" class="bg-red-500 px-4 py-1 capitalize rounded-md hover:bg-red-700 transition-color duration-500 ease action-btn ">Delete</button></span>
                        <h2 id="challengeTitle" class="text-4xl font-extrabold mb-4 opacity-0 -translate-y-6">The Challenge</h2>
                        <p id="challengeDescription" class="text-lg text-gray-200 leading-relaxed opacity-0 translate-y-6">
                            Developing a scalable solution that adapts to diverse user requirements across multiple devices, while ensuring consistent performance and UX.
                        </p>
                    </div>
                </div>

                <!-- Slide 2 -->
                <div class="swiper-slide w-full md:w-1/2 lg:w-1/4 px-2 box-border">
                    <div id="challengeView" class="relative bg-gradient-to-br from-purple-800/60 to-gray-900 rounded-2xl shadow-xl p-8 text-white">
                        <span class="absolute top-5 right-5 flex gap-2"><button onclick="showAddModal('hero')" class="action-btn  bg-yellow-500 px-4 py-1 capitalize rounded-md hover:bg-yellow-700 transition-color duration-500 ease">edit</button><button onclick="showAddModal('hero')" class="bg-red-500 px-4 py-1 capitalize rounded-md hover:bg-red-700 transition-color duration-500 ease action-btn ">Delete</button></span>
                        <h2 id="challengeTitle" class="text-4xl font-extrabold mb-4 opacity-0 -translate-y-6">The Challenge</h2>
                        <p id="challengeDescription" class="text-lg text-gray-200 leading-relaxed opacity-0 translate-y-6">
                            Developing a scalable solution that adapts to diverse user requirements across multiple devices, while ensuring consistent performance and UX.
                        </p>
                    </div>
                </div>

                <!-- You can add more slides here -->

            </div>



            <div class="swiper-pagination !bottom-0 relative !text-center"></div>
        </div>

    </section>
</div>