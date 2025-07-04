<?php $session = session(); ?>
<header class="glass-card border-b border-gray-800 p-4 lg:p-6">
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <button id="mobile-menu" class="lg:hidden text-gray-400 hover:text-white">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
            <h2 id="page-title" class="text-xl lg:text-2xl font-semibold">Dashboard Overview</h2>
        </div>

        <div class="flex items-center space-x-4">
            <div class="floating">
                <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-purple-600 rounded-full flex items-center justify-center">
                    <i data-lucide="user" class="w-4 h-4 text-white"></i>
                </div>
            </div>

            <?php if ($session->has('user')): ?>
                <span class="flex flex-col gap-0 items-start justify-center">
                    <p class="capitalize text-lg font-medium"><?= esc($session->get('user.name')) ?></p>
                <p class="lowercase truncate text-sm text-blue-800"><?= esc($session->get('user.email')) ?></p>  
                </span>
              


            <?php else : ?>
                  <button class="px-6 py-2 bg-slate-600 rounded-md">login</button>
            <?php endif; ?>
          
        </div>
    </div>
</header>