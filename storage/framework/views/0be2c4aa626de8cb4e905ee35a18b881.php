<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Explore EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        .masonry {
            column-count: 1;
            column-gap: 24px;
        }

        @media(min-width:768px){
            .masonry{
                column-count:2;
            }
        }

        .item {
            break-inside: avoid;
            margin-bottom: 24px;
            transition: all .25s ease;
        }

        .item:hover {
            transform: translateY(-5px);
        }
    </style>
</head>

<body class="bg-[#fff8f5] text-[#1f1b17]">

<div class="w-full px-8 py-10">

    
    <div class="mb-10 text-center">
        <h1 class="text-4xl font-bold text-[#003527]">
            Explore EcoDon
        </h1>

        <p class="text-[#404944] mt-2">
            Discover blog, donation, and volunteer activities
        </p>

        <form method="GET" action="<?php echo e(route('user.explore')); ?>" class="mt-6 flex justify-center">
            <div class="relative w-full max-w-xl">

                <span class="absolute left-4 top-3.5 text-[#707974]">
                    🔍
                </span>

                <input
                    type="text"
                    name="search"
                    value="<?php echo e(request('search')); ?>"
                    placeholder="Search title, author, organization..."
                    class="w-full pl-12 pr-24 py-3 rounded-full shadow border border-[#eae1da] bg-white focus:outline-none focus:ring-2 focus:ring-[#006c49]"
                >

                <?php if(request('search')): ?>
                    <a href="<?php echo e(route('user.explore')); ?>"
                       class="absolute right-4 top-3 text-sm font-bold text-[#006c49]">
                        Reset
                    </a>
                <?php endif; ?>

            </div>
        </form>
    </div>

    <?php if($explore->isEmpty()): ?>

        <div class="max-w-xl mx-auto bg-white rounded-3xl p-8 text-center text-[#404944] border border-[#eae1da]">

            <?php if(request('search')): ?>

                Tidak ada hasil untuk
                <span class="font-bold text-[#003527']">
                    "<?php echo e(request('search')); ?>"
                </span>.

                <div class="mt-4">
                    <a href="<?php echo e(route('user.explore')); ?>"
                       class="inline-block px-5 py-2 rounded-full bg-[#006c49] text-white text-sm font-bold">
                        Kembali ke Explore
                    </a>
                </div>

            <?php else: ?>

                Belum ada konten yang ditemukan.

            <?php endif; ?>

        </div>

    <?php else: ?>

        
        <div class="grid grid-cols-[300px_1fr] gap-8">

            
            <aside>

                <div class="bg-white rounded-3xl shadow border border-[#eae1da] p-6 sticky top-6 min-h-[800px]">

                    <h2 class="text-3xl font-bold text-[#003527] flex items-center gap-2">
                        🏆 Leaderboard
                    </h2>

                    <p class="text-[#707974] mt-2 mb-8">
                        Poin Reward Donasi
                    </p>

                    <div class="space-y-4">

                        <?php $__empty_1 = true; $__currentLoopData = $leaderboardUsers ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                            <div class="flex items-center gap-4 p-4 rounded-2xl bg-[#fff8f5] border border-[#f0e5dc]">

                                <div class="w-12 h-12 rounded-full bg-[#003527] text-white flex items-center justify-center font-bold text-lg shrink-0">
                                    <?php echo e($index + 1); ?>

                                </div>

                                <div class="min-w-0">

                                    <p class="font-bold text-[#003527] truncate">
                                        <?php echo e($user->name ?? 'User'); ?>

                                    </p>

                                    <p class="text-sm text-[#707974]">
                                        <?php echo e($user->total_points ?? 0); ?> poin
                                    </p>

                                </div>

                            </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                            <div class="text-[#707974]">
                                Belum ada data leaderboard.
                            </div>

                        <?php endif; ?>

                    </div>

                </div>

            </aside>

            
            <div>

                <div class="masonry">

                    <?php $__currentLoopData = $explore; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                        <div class="item bg-white rounded-3xl shadow border border-[#eae1da] overflow-hidden">

                            <?php if(!empty($item->image)): ?>
                                <a href="<?php echo e(url('/user/explore/' . $item->type . '/' . $item->id)); ?>">
                                    <img
                                        src="<?php echo e(asset('storage/' . $item->image)); ?>"
                                        class="w-full h-56 object-cover"
                                        alt="<?php echo e($item->title); ?>"
                                    >
                                </a>
                            <?php endif; ?>

                            <div class="p-5">

                                <a href="<?php echo e(url('/user/explore/' . $item->type . '/' . $item->id)); ?>" class="block">

                                    <span class="inline-flex px-3 py-1 rounded-full bg-[#e6f5ef] text-[#006c49] text-[11px] font-bold uppercase tracking-wider">
                                        <?php echo e($item->type); ?>

                                    </span>

                                    <h2 class="font-bold text-xl mt-3 text-[#003527] leading-snug">
                                        <?php echo e($item->title); ?>

                                    </h2>

                                    <p class="text-sm text-[#404944] mt-2 leading-relaxed">
                                        <?php echo e(Str::limit($item->description ?? $item->content, 120)); ?>

                                    </p>

                                </a>

                                <div class="mt-5 flex items-center justify-between gap-3">

                                    <?php if($item->author_type === 'organization'): ?>

                                        <a href="<?php echo e(route('organization.public.profile', $item->organization_id)); ?>"
                                           class="flex items-center gap-3 min-w-0">

                                            <div class="w-11 h-11 rounded-full overflow-hidden bg-[#f6ece6] flex items-center justify-center shrink-0">

                                                <?php if(!empty($item->organization_profile_image)): ?>

                                                    <img
                                                        src="<?php echo e(asset('storage/' . $item->organization_profile_image)); ?>"
                                                        class="w-full h-full object-cover"
                                                    >

                                                <?php else: ?>

                                                    <span class="font-bold text-[#003527]">
                                                        <?php echo e(strtoupper(substr($item->organization_name ?? 'O', 0, 1))); ?>

                                                    </span>

                                                <?php endif; ?>

                                            </div>

                                            <p class="text-sm font-bold text-[#003527] truncate">
                                                <?php echo e($item->organization_name ?? 'Organization'); ?>

                                            </p>

                                        </a>

                                        <?php if(auth()->guard()->check()): ?>
                                            <?php if(auth()->user()->organization?->id !== $item->organization_id): ?>

                                                <?php if(auth()->user()->followedOrganizations->contains($item->organization_id)): ?>

                                                    <form action="<?php echo e(route('organizations.unfollow', $item->organization_id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>

                                                        <button class="px-3 py-1 rounded-full bg-[#003527] text-white text-xs font-bold">
                                                            Following
                                                        </button>
                                                    </form>

                                                <?php else: ?>

                                                    <form action="<?php echo e(route('organizations.follow', $item->organization_id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>

                                                        <button class="px-3 py-1 rounded-full bg-[#006c49] text-white text-xs font-bold">
                                                            Follow
                                                        </button>
                                                    </form>

                                                <?php endif; ?>

                                            <?php endif; ?>
                                        <?php endif; ?>

                                    <?php elseif($item->author_type === 'user'): ?>

                                        <a href="<?php echo e(route('user.public.profile', $item->user_id)); ?>"
                                           class="flex items-center gap-3 min-w-0">

                                            <div class="w-11 h-11 rounded-full overflow-hidden bg-[#f6ece6] flex items-center justify-center shrink-0">

                                                <?php if(!empty($item->user_profile_image)): ?>

                                                    <img
                                                        src="<?php echo e(asset('storage/' . $item->user_profile_image)); ?>"
                                                        class="w-full h-full object-cover"
                                                    >

                                                <?php else: ?>

                                                    <span class="font-bold text-[#003527]">
                                                        <?php echo e(strtoupper(substr($item->user_name ?? 'U', 0, 1))); ?>

                                                    </span>

                                                <?php endif; ?>

                                            </div>

                                            <p class="text-sm font-bold text-[#003527] truncate">
                                                <?php echo e($item->user_name ?? 'User'); ?>

                                            </p>

                                        </a>

                                    <?php endif; ?>

                                </div>

                                <div class="flex items-center gap-4 mt-4 text-sm text-[#707974] border-t border-[#eae1da] pt-4">

                                    <form action="<?php echo e(route('like', [$item->type, $item->id])); ?>" method="POST">
                                        <?php echo csrf_field(); ?>

                                        <button type="submit">
                                            ❤️ <?php echo e($item->likes_count ?? 0); ?>

                                        </button>
                                    </form>

                                    <span>
                                        💬 <?php echo e($item->comments_count ?? 0); ?>

                                    </span>

                                </div>

                            </div>

                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>

            </div>

        </div>

    <?php endif; ?>

</div>

</body>
</html><?php /**PATH D:\programming files yk\eco-don\resources\views/user/explore.blade.php ENDPATH**/ ?>