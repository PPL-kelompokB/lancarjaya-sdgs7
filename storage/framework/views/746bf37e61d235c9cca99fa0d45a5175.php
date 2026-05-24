<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($organization->organization_name); ?> - EcoDon</title>

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,line-clamp"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#003527",
                        secondary: "#006c49",
                        surface: "#fff8f5",
                        "surface-container": "#f6ece6",
                        "surface-container-low": "#fcf2eb",
                        "outline-variant": "#bfc9c3",
                        "on-surface": "#1f1b17",
                        "on-surface-variant": "#404944",
                    },
                    fontFamily: {
                        headline: ["Manrope", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, .font-headline { font-family: 'Manrope', sans-serif; }

        .tab-panel { display: none; }
        .tab-panel.active { display: block; }

        .tab-btn.active {
            color: #003527;
            position: relative;
        }

        .tab-btn.active::after {
            content: "";
            position: absolute;
            left: 0;
            bottom: -1px;
            width: 100%;
            height: 4px;
            border-radius: 999px;
            background: #006c49;
        }
    </style>
</head>

<body class="bg-surface text-on-surface min-h-screen">

    <main class="min-h-screen">

        <div class="relative w-full">
            <div class="h-72 sm:h-80 w-full overflow-hidden bg-gradient-to-r from-[#003527] to-[#064e3b] relative">
                <?php if(!empty($organization->cover_image)): ?>
                    <img
                        class="w-full h-full object-cover"
                        src="<?php echo e(asset('storage/' . $organization->cover_image)); ?>"
                        alt="Cover organisasi"
                    >
                <?php endif; ?>

                <div class="absolute inset-0 bg-black/20"></div>

                <a href="<?php echo e(route('user.explore')); ?>"
                   class="absolute top-5 left-5 px-5 py-2 bg-white/90 text-[#003527] rounded-full font-bold text-sm shadow hover:bg-white">
                    ← Back to Explore
                </a>
            </div>

            <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 relative -mt-16 sm:-mt-20">
                <div class="bg-white/90 backdrop-blur-2xl rounded-3xl p-5 sm:p-8 shadow-[0px_20px_40px_rgba(31,27,23,0.08)]">
                    <div class="flex flex-col lg:flex-row lg:items-end gap-6 justify-between">
                        <div class="flex flex-col sm:flex-row gap-5 items-start sm:items-end">

                            <div class="w-28 h-28 sm:w-36 sm:h-36 rounded-3xl overflow-hidden border-4 sm:border-8 border-[#fff8f5] bg-white shadow-xl -mt-16 sm:-mt-24">
                                <?php if(!empty($organization->profile_image)): ?>
                                    <img
                                        class="w-full h-full object-cover"
                                        src="<?php echo e(asset('storage/' . $organization->profile_image)); ?>"
                                        alt="Logo organisasi"
                                    >
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center bg-[#f6ece6]">
                                        <span class="material-symbols-outlined text-[#003527] text-6xl">business</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <div class="pb-2">
                                <div class="flex items-center gap-2 flex-wrap">
                                    <h1 class="text-2xl sm:text-4xl font-headline font-extrabold tracking-tight text-primary">
                                        <?php echo e($organization->organization_name); ?>

                                    </h1>

                                    <?php if($organization->verification_status === 'verified'): ?>
                                        <span class="material-symbols-outlined text-secondary text-2xl" style="font-variation-settings: 'FILL' 1;">verified</span>
                                    <?php endif; ?>
                                </div>

                                <div class="flex flex-wrap items-center gap-3 sm:gap-4 text-on-surface-variant mt-2">
                                    <span class="flex items-center gap-1 text-sm font-medium">
                                        <span class="material-symbols-outlined text-lg">category</span>
                                        <?php echo e($organization->organization_type ?? 'Organization'); ?>

                                    </span>

                                    <?php if($organization->founded_year): ?>
                                        <span class="w-1 h-1 bg-outline-variant rounded-full hidden sm:inline-block"></span>
                                        <span class="text-sm font-medium">Berdiri <?php echo e($organization->founded_year); ?></span>
                                    <?php endif; ?>
                                </div>

                                <p class="mt-4 text-on-surface-variant max-w-2xl leading-relaxed text-sm sm:text-base">
                                    <?php echo e($organization->description ?: 'Belum ada deskripsi organisasi.'); ?>

                                </p>
                            </div>
                        </div>

                        <?php if(auth()->guard()->check()): ?>
                            <div class="pb-2">
                                <?php if(auth()->user()->followedOrganizations->contains($organization->id)): ?>
                                    <form action="<?php echo e(route('organizations.unfollow', $organization->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="px-8 py-3 bg-primary text-white rounded-full font-headline font-bold shadow-lg">
                                            Following
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <form action="<?php echo e(route('organizations.follow', $organization->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <button type="submit" class="px-8 py-3 bg-secondary text-white rounded-full font-headline font-bold shadow-lg">
                                            Follow
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mt-8 pt-6 border-t border-outline-variant/20">
                        <div>
                            <span class="text-2xl font-headline font-black text-primary">
                                <?php echo e($organization->followers()->count()); ?>

                            </span>
                            <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Followers</p>
                        </div>

                        <div>
                            <span class="text-2xl font-headline font-black text-primary">
                                <?php echo e($organization->blogs->count() ?? 0); ?>

                            </span>
                            <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Total Blog</p>
                        </div>

                        <div>
                            <span class="text-2xl font-headline font-black text-primary">
                                <?php echo e($organization->donations->count() ?? 0); ?>

                            </span>
                            <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Program Donasi</p>
                        </div>

                        <div>
                            <span class="text-2xl font-headline font-black text-secondary">
                                <?php echo e($volunteerRequests->count() ?? 0); ?>

                            </span>
                            <p class="text-xs uppercase tracking-widest text-on-surface-variant font-semibold">Volunteer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 pb-20">

            <div class="flex gap-8 sm:gap-12 mb-8 border-b border-outline-variant/20 overflow-x-auto">
                <button type="button" class="tab-btn active pb-4 text-primary font-headline font-bold relative" data-tab="donation">
                    Donation Programs
                </button>

                <button type="button" class="tab-btn pb-4 text-on-surface-variant font-headline font-bold relative" data-tab="volunteer">
                    Volunteer Activity
                </button>

                <button type="button" class="tab-btn pb-4 text-on-surface-variant font-headline font-bold relative" data-tab="blog">
                    Blog
                </button>

                <button type="button" class="tab-btn pb-4 text-on-surface-variant font-headline font-bold relative" data-tab="data">
                    Data Organisasi
                </button>
            </div>

            <div id="panel-donation" class="tab-panel active">
                <section class="bg-surface-container rounded-3xl p-6">
                    <h2 class="text-xl font-headline font-bold text-primary mb-6">Program Donasi</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <?php $__empty_1 = true; $__currentLoopData = $organization->donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="bg-white rounded-3xl p-5 border border-outline-variant/20">
                                <h3 class="text-lg font-headline font-bold text-primary">
                                    <?php echo e($donation->title); ?>

                                </h3>

                                <p class="mt-3 text-sm text-on-surface-variant line-clamp-3">
                                    <?php echo e($donation->description ?: 'Belum ada deskripsi program donasi.'); ?>

                                </p>

                                <div class="mt-4 space-y-2 text-sm text-on-surface-variant">
                                    <p><span class="font-semibold text-on-surface">Barang:</span> <?php echo e($donation->item_name ?? '-'); ?></p>
                                    <p><span class="font-semibold text-on-surface">Jumlah:</span> <?php echo e($donation->quantity ?? '-'); ?> <?php echo e($donation->unit ?? ''); ?></p>
                                    <p><span class="font-semibold text-on-surface">Lokasi:</span> <?php echo e($donation->address ?? '-'); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="md:col-span-2 bg-white rounded-3xl p-6 border border-outline-variant/20 text-on-surface-variant">
                                Belum ada program donasi.
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            </div>

            <div id="panel-volunteer" class="tab-panel">
                <section class="bg-surface-container rounded-3xl p-6">
                    <h2 class="text-xl font-headline font-bold text-primary mb-6">Volunteer Activity</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <?php $__empty_1 = true; $__currentLoopData = $volunteerRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="bg-white rounded-3xl overflow-hidden border border-outline-variant/20">
                                <?php if($item->image): ?>
                                    <img src="<?php echo e(asset('storage/' . $item->image)); ?>" class="w-full h-52 object-cover">
                                <?php endif; ?>

                                <div class="p-5">
                                    <h3 class="text-lg font-headline font-bold text-primary">
                                        <?php echo e($item->title); ?>

                                    </h3>

                                    <p class="text-sm text-on-surface-variant mt-2">
                                        <?php echo e(Str::limit($item->description, 120)); ?>

                                    </p>

                                    <div class="mt-4 flex justify-between text-xs text-on-surface-variant">
                                        <span><?php echo e($item->location ?? '-'); ?></span>
                                        <span><?php echo e($item->volunteer_quota ?? 0); ?> orang</span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="md:col-span-2 bg-white rounded-3xl p-6 border border-outline-variant/20 text-on-surface-variant">
                                Belum ada aktivitas volunteer.
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            </div>

            <div id="panel-blog" class="tab-panel">
                <section class="bg-surface-container rounded-3xl p-6">
                    <h2 class="text-xl font-headline font-bold text-primary mb-6">Blog</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <?php $__empty_1 = true; $__currentLoopData = $organization->blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <div class="bg-white rounded-3xl p-5 border border-outline-variant/20">
                                <h3 class="text-lg font-headline font-bold text-primary">
                                    <?php echo e($blog->title ?? 'Judul Blog'); ?>

                                </h3>

                                <p class="mt-3 text-sm text-on-surface-variant line-clamp-4">
                                    <?php echo e($blog->content ?? 'Belum ada isi blog.'); ?>

                                </p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <div class="md:col-span-2 bg-white rounded-3xl p-6 border border-outline-variant/20 text-on-surface-variant">
                                Belum ada blog.
                            </div>
                        <?php endif; ?>
                    </div>
                </section>
            </div>

            <div id="panel-data" class="tab-panel">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <section class="bg-surface-container rounded-3xl p-6">
                        <h2 class="text-xl font-headline font-bold text-primary mb-4">Data Organisasi</h2>

                        <div class="space-y-4">
                            <div class="bg-white rounded-2xl px-4 py-3">
                                <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Nama Organisasi</p>
                                <p class="font-semibold mt-1"><?php echo e($organization->organization_name); ?></p>
                            </div>

                            <div class="bg-white rounded-2xl px-4 py-3">
                                <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Tipe Organisasi</p>
                                <p class="font-semibold mt-1"><?php echo e($organization->organization_type ?? '-'); ?></p>
                            </div>

                            <div class="bg-white rounded-2xl px-4 py-3">
                                <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Telepon</p>
                                <p class="font-semibold mt-1"><?php echo e($organization->org_phone ?? '-'); ?></p>
                            </div>

                            <div class="bg-white rounded-2xl px-4 py-3">
                                <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Alamat</p>
                                <p class="font-semibold mt-1"><?php echo e($organization->address ?? '-'); ?></p>
                            </div>
                        </div>
                    </section>

                    <section class="bg-surface-container rounded-3xl p-6">
                        <h2 class="text-xl font-headline font-bold text-primary mb-4">PIC</h2>

                        <div class="space-y-4">
                            <div class="bg-white rounded-2xl px-4 py-3">
                                <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Nama PIC</p>
                                <p class="font-semibold mt-1"><?php echo e($organization->pic_name ?? '-'); ?></p>
                            </div>

                            <div class="bg-white rounded-2xl px-4 py-3">
                                <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Email PIC</p>
                                <p class="font-semibold mt-1 break-all"><?php echo e($organization->pic_email ?? '-'); ?></p>
                            </div>

                            <div class="bg-white rounded-2xl px-4 py-3">
                                <p class="text-xs uppercase tracking-wider text-on-surface-variant font-semibold">Telepon PIC</p>
                                <p class="font-semibold mt-1"><?php echo e($organization->pic_phone ?? '-'); ?></p>
                            </div>
                        </div>
                    </section>
                </div>
            </div>

        </div>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const tabButtons = document.querySelectorAll('.tab-btn');
            const tabPanels = document.querySelectorAll('.tab-panel');

            tabButtons.forEach((button) => {
                button.addEventListener('click', () => {
                    const target = button.dataset.tab;

                    tabButtons.forEach((btn) => {
                        btn.classList.remove('active', 'text-primary');
                        btn.classList.add('text-on-surface-variant');
                    });

                    tabPanels.forEach((panel) => {
                        panel.classList.remove('active');
                    });

                    button.classList.add('active', 'text-primary');
                    button.classList.remove('text-on-surface-variant');

                    const targetPanel = document.getElementById(`panel-${target}`);
                    if (targetPanel) {
                        targetPanel.classList.add('active');
                    }
                });
            });
        });
    </script>

</body>
</html><?php /**PATH D:\programming files yk\eco-don\resources\views/organization/public-profile.blade.php ENDPATH**/ ?>