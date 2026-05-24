<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistics - EcoDon</title>

    <link href="https://fonts.googleapis.com" rel="preconnect"/>
    <link crossorigin href="https://fonts.gstatic.com" rel="preconnect"/>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Manrope:wght@600;700;800&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#003527",
                        secondary: "#006c49",
                        background: "#fff8f5",
                        surface: "#fff8f5",
                        "surface-container": "#f6ece6",
                        "outline-variant": "#d8cfc8",
                        "on-surface": "#1f1b17",
                        "on-surface-variant": "#5f5b57",
                    },
                    fontFamily: {
                        headline: ["Manrope", "sans-serif"],
                        body: ["Inter", "sans-serif"],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-background font-body text-on-surface min-h-screen">

    <!-- Main -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5 mb-10">

            <div>

                <!-- Back Button -->
                <a 
                    href="<?php echo e(url('/organization/dashboard')); ?>"
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-outline-variant text-primary font-semibold hover:bg-surface-container transition-all mb-5"
                >
                    <span class="material-symbols-outlined text-[20px]">
                        arrow_back
                    </span>

                    Kembali ke menu utama
                </a>

                <h1 class="text-3xl md:text-4xl font-headline font-extrabold text-primary">
                    Statistics Dashboard
                </h1>

                <p class="mt-2 text-on-surface-variant">
                    Pantau perkembangan donasi, volunteer, dan aktivitas organisasi.
                </p>

            </div>

        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

            <!-- Total Donation -->
            <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Total Donasi
                </p>

                <h2 class="text-4xl font-headline font-extrabold text-primary">
                    <?php echo e($organization->donations->count()); ?>

                </h2>

                <p class="text-xs text-green-600 mt-3">
                    Program donasi aktif organisasi
                </p>

            </div>

            <!-- Volunteer -->
            <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Volunteer Activity
                </p>

                <h2 class="text-4xl font-headline font-extrabold text-primary">
                    <?php echo e($organization->volunteerRequests->count()); ?>

                </h2>

                <p class="text-xs text-green-600 mt-3">
                    Total request volunteer
                </p>

            </div>

            <!-- Blog -->
            <div class="bg-white rounded-2xl p-6 border border-outline-variant/20 shadow-sm">

                <p class="text-sm text-on-surface-variant mb-2">
                    Total Blog
                </p>

                <h2 class="text-4xl font-headline font-extrabold text-primary">
                    <?php echo e($organization->blogs->count()); ?>

                </h2>

                <p class="text-xs text-orange-600 mt-3">
                    Blog yang dipublikasikan
                </p>

            </div>

        </div>

        <!-- Charts -->
        <div class="grid grid-cols-1 xl:grid-cols-2 gap-6 mb-8">

            <!-- Donation Trend -->
            <section class="bg-surface-container rounded-2xl p-6">

                <div class="flex items-center justify-between mb-6">

                    <h2 class="text-xl font-headline font-bold text-primary">
                        Donation Trend
                    </h2>

                    <span class="text-sm font-semibold text-secondary">
                        Donasi Organisasi
                    </span>

                </div>

                <div class="h-80 rounded-2xl bg-white border border-outline-variant/20 p-4">

                    <?php if($organization->donations->count() > 0): ?>

                        <canvas id="donationChart"></canvas>

                    <?php else: ?>

                        <div class="h-full flex items-center justify-center text-on-surface-variant">
                            Belum ada data donasi
                        </div>

                    <?php endif; ?>

                </div>

            </section>

            <!-- Volunteer Trend -->
            <section class="bg-surface-container rounded-2xl p-6">

                <div class="flex items-center justify-between mb-6">

                    <h2 class="text-xl font-headline font-bold text-primary">
                        Volunteer Activity
                    </h2>

                    <span class="text-sm font-semibold text-secondary">
                        Coming Soon
                    </span>

                </div>

                <div class="h-80 rounded-2xl bg-white border border-outline-variant/20 flex items-center justify-center text-on-surface-variant">
                    Grafik volunteer belum tersedia
                </div>

            </section>

        </div>

        <!-- Recent Activity -->
        <section class="bg-surface-container rounded-2xl p-6">

            <div class="flex items-center justify-between mb-6">

                <h2 class="text-xl font-headline font-bold text-primary">
                    Recent Activity
                </h2>

            </div>

            <div class="space-y-4">

                
                <?php $__currentLoopData = $organization->donations->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="bg-white rounded-xl p-5 border border-outline-variant/20">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold text-primary">
                                <?php echo e($donation->title); ?>

                            </h3>

                            <span class="text-xs px-3 py-1 rounded-full bg-emerald-100 text-emerald-700">
                                Donation
                            </span>

                        </div>

                        <p class="text-sm text-on-surface-variant mt-2">
                            <?php echo e($donation->description ?? 'Program donasi baru dibuat.'); ?>

                        </p>

                        <p class="text-xs text-on-surface-variant mt-3">
                            <?php echo e($donation->created_at->diffForHumans()); ?>

                        </p>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $organization->blogs->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="bg-white rounded-xl p-5 border border-outline-variant/20">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold text-primary">
                                <?php echo e($blog->title); ?>

                            </h3>

                            <span class="text-xs px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                                Blog
                            </span>

                        </div>

                        <p class="text-sm text-on-surface-variant mt-2">
                            <?php echo e(Str::limit($blog->content, 120)); ?>

                        </p>

                        <p class="text-xs text-on-surface-variant mt-3">
                            <?php echo e($blog->created_at->diffForHumans()); ?>

                        </p>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                <?php $__currentLoopData = $organization->volunteerRequests->take(2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $volunteer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                    <div class="bg-white rounded-xl p-5 border border-outline-variant/20">

                        <div class="flex items-center justify-between">

                            <h3 class="font-semibold text-primary">
                                <?php echo e($volunteer->title); ?>

                            </h3>

                            <span class="text-xs px-3 py-1 rounded-full bg-orange-100 text-orange-700">
                                Volunteer
                            </span>

                        </div>

                        <p class="text-sm text-on-surface-variant mt-2">
                            <?php echo e(Str::limit($volunteer->description, 120)); ?>

                        </p>

                        <p class="text-xs text-on-surface-variant mt-3">
                            <?php echo e($volunteer->created_at->diffForHumans()); ?>

                        </p>

                    </div>

                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            </div>

        </section>

    </main>

    
    <?php if($organization->donations->count() > 0): ?>

    <script>

        const donationLabels = [
            <?php $__currentLoopData = $organization->donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                "<?php echo e($donation->title); ?>",
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];

        const donationData = [
            <?php $__currentLoopData = $organization->donations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $donation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e($donation->quantity ?? 0); ?>,
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        ];

        const ctx = document.getElementById('donationChart');

        new Chart(ctx, {

            type: 'bar',

            data: {
                labels: donationLabels,

                datasets: [{
                    label: 'Jumlah Donasi',
                    data: donationData,
                    backgroundColor: '#006c49',
                    borderRadius: 12,
                    borderWidth: 1
                }]
            },

            options: {
                responsive: true,
                maintainAspectRatio: false,

                plugins: {
                    legend: {
                        display: false
                    }
                },

                scales: {

                    y: {
                        beginAtZero: true,

                        ticks: {
                            precision: 0
                        },

                        grid: {
                            color: '#ece7e2'
                        }
                    },

                    x: {
                        grid: {
                            display: false
                        }
                    }

                }
            }

        });

    </script>

    <?php endif; ?>

</body>
</html><?php /**PATH D:\programming files yk\eco-don\resources\views/organization/statistics.blade.php ENDPATH**/ ?>