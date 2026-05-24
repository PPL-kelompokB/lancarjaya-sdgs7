<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?php echo e($donation->title); ?> - EcoDon</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link
        rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined"
    >
</head>

<?php

$target = $donation->quantity;

$current = $donation->submissions
    ->whereIn('status', [
        'approved',
        'completed'
    ])
    ->sum('quantity');

$percentage = $target > 0
    ? min(($current / $target) * 100, 100)
    : 0;

?>

<body class="bg-[#fff8f5] text-[#1f1b17]">

<div class="max-w-7xl mx-auto px-6 py-10">

    <!-- BACK -->
    <a
        href="<?php echo e(url()->previous()); ?>"
        class="inline-flex items-center gap-2 text-[#006c49] font-bold hover:underline mb-6"
    >
        <span class="material-symbols-outlined">arrow_back</span>
        Back
    </a>

    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- LEFT -->
        <div class="xl:col-span-2 space-y-6">

            <!-- DONATION DETAIL -->
            <section class="bg-white rounded-3xl border border-[#eae1da] overflow-hidden shadow-sm">

                <?php if($donation->image): ?>
                    <img
                        src="<?php echo e(asset('storage/' . $donation->image)); ?>"
                        class="w-full h-[320px] object-cover"
                    >
                <?php endif; ?>

                <div class="p-8">

                    <!-- STATUS -->
                    <div class="flex flex-wrap gap-2 mb-4">

                        <?php if($donation->status === 'open'): ?>
                            <span class="px-4 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-black uppercase tracking-wider">
                                Open
                            </span>
                        <?php elseif($donation->status === 'completed'): ?>
                            <span class="px-4 py-1 rounded-full bg-green-100 text-green-700 text-xs font-black uppercase tracking-wider">
                                Completed
                            </span>
                        <?php else: ?>
                            <span class="px-4 py-1 rounded-full bg-red-100 text-red-700 text-xs font-black uppercase tracking-wider">
                                Cancelled
                            </span>
                        <?php endif; ?>

                    </div>

                    <!-- TITLE -->
                    <h1 class="text-4xl font-black text-[#003527]">
                        <?php echo e($donation->title); ?>

                    </h1>

                    <!-- DESC -->
                    <p class="mt-5 text-[#5c5c5c] leading-relaxed whitespace-pre-line">
                        <?php echo e($donation->description); ?>

                    </p>

                    <!-- INFO -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8">

                        <div class="bg-[#f6ece6] rounded-2xl p-5">
                            <p class="text-xs uppercase tracking-widest text-gray-500 font-bold mb-1">
                                Item
                            </p>

                            <p class="text-lg font-black text-[#003527]">
                                <?php echo e($donation->item_name); ?>

                            </p>
                        </div>

                        <div class="bg-[#f6ece6] rounded-2xl p-5">
                            <p class="text-xs uppercase tracking-widest text-gray-500 font-bold mb-1">
                                Target
                            </p>

                            <p class="text-lg font-black text-[#003527]">
                                <?php echo e($target); ?> <?php echo e($donation->unit); ?>

                            </p>
                        </div>

                        <div class="bg-[#f6ece6] rounded-2xl p-5">
                            <p class="text-xs uppercase tracking-widest text-gray-500 font-bold mb-1">
                                Location
                            </p>

                            <p class="text-lg font-black text-[#003527]">
                                <?php echo e($donation->address); ?>

                            </p>
                        </div>

                    </div>

                    <!-- PROGRESS -->
                    <div class="mt-10">

                        <div class="flex justify-between items-end mb-3">

                            <div>
                                <p class="text-sm text-gray-500 font-semibold">
                                    Donation Progress
                                </p>

                                <h2 class="text-4xl font-black text-[#003527]">
                                    <?php echo e($current); ?> / <?php echo e($target); ?>

                                </h2>
                            </div>

                            <div class="text-right">
                                <p class="text-sm text-gray-500 font-semibold">
                                    Progress
                                </p>

                                <p class="text-3xl font-black text-[#006c49]">
                                    <?php echo e(round($percentage)); ?>%
                                </p>
                            </div>

                        </div>

                        <div class="w-full bg-[#eadfd8] rounded-full h-5 overflow-hidden">

                            <div
                                class="bg-[#006c49] h-full rounded-full transition-all duration-500"
                                style="width: <?php echo e($percentage); ?>%">
                            </div>

                        </div>

                    </div>

                </div>

            </section>

        </div>

        <!-- RIGHT -->
        <div class="space-y-6">

            <!-- SUBMISSION LIST -->
            <section class="bg-white rounded-3xl border border-[#eae1da] shadow-sm p-6">

                <div class="flex items-center justify-between mb-6">

                    <div>
                        <h2 class="text-2xl font-black text-[#003527]">
                            Incoming Donations
                        </h2>

                        <p class="text-sm text-gray-500 mt-1">
                            Manage donor submissions
                        </p>
                    </div>

                    <div class="bg-[#f6ece6] px-4 py-2 rounded-2xl">
                        <span class="text-[#003527] font-black">
                            <?php echo e($donation->submissions->count()); ?>

                        </span>
                    </div>

                </div>

                <div class="space-y-5">

                    <?php $__empty_1 = true; $__currentLoopData = $donation->submissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <div class="border border-[#eae1da] rounded-2xl overflow-hidden">

                            <!-- TOP -->
                            <div class="p-5">

                                <div class="flex justify-between items-start gap-3">

                                    <div>

                                        <h3 class="font-black text-[#003527] text-lg">
                                            <?php echo e($submission->user->name); ?>

                                        </h3>

                                        <p class="text-sm text-gray-500 mt-1">
                                            <?php echo e($submission->item_name); ?>

                                            •
                                            <?php echo e($submission->quantity); ?>

                                            <?php echo e($submission->unit); ?>

                                        </p>

                                    </div>

                                    <!-- STATUS -->
                                    <?php if($submission->status === 'pending'): ?>

                                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 text-xs font-black uppercase tracking-wider">
                                            Pending
                                        </span>

                                    <?php elseif($submission->status === 'approved'): ?>

                                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-black uppercase tracking-wider">
                                            Approved
                                        </span>

                                    <?php elseif($submission->status === 'completed'): ?>

                                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700 text-xs font-black uppercase tracking-wider">
                                            Completed
                                        </span>

                                    <?php else: ?>

                                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-700 text-xs font-black uppercase tracking-wider">
                                            Cancelled
                                        </span>

                                    <?php endif; ?>

                                </div>

                                <!-- DETAIL -->
                                <div class="mt-5 space-y-3 text-sm">

                                    <div>
                                        <p class="font-bold text-[#003527] mb-1">
                                            Address
                                        </p>

                                        <p class="text-gray-600">
                                            <?php echo e($submission->pickup_address); ?>

                                        </p>
                                    </div>

                                    <div class="grid grid-cols-2 gap-4">

                                        <div>
                                            <p class="font-bold text-[#003527] mb-1">
                                                Phone
                                            </p>

                                            <p class="text-gray-600">
                                                <?php echo e($submission->phone_number); ?>

                                            </p>
                                        </div>

                                        <div>
                                            <p class="font-bold text-[#003527] mb-1">
                                                Pickup Date
                                            </p>

                                            <p class="text-gray-600">
                                                <?php echo e($submission->pickup_date); ?>

                                            </p>
                                        </div>

                                    </div>

                                    <?php if($submission->notes): ?>

                                        <div>
                                            <p class="font-bold text-[#003527] mb-1">
                                                Notes
                                            </p>

                                            <p class="text-gray-600">
                                                <?php echo e($submission->notes); ?>

                                            </p>
                                        </div>

                                    <?php endif; ?>

                                </div>

                            </div>

                            <!-- IMAGE -->
                            <?php if($submission->pickup_proof_image): ?>

                                <img
                                    src="<?php echo e(asset('storage/' . $submission->pickup_proof_image)); ?>"
                                    class="w-full h-52 object-cover border-t border-[#eae1da]"
                                >

                            <?php endif; ?>

                            <!-- ACTIONS -->
                            <div class="p-5 border-t border-[#eae1da] flex flex-wrap gap-3">

                                <?php if($submission->status === 'pending'): ?>

                                    <!-- APPROVE -->
                                    <form
                                        action="<?php echo e(route('donation.status', $submission->id)); ?>"
                                        method="POST">

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="approved">

                                        <button
                                            class="px-5 py-2 rounded-full bg-[#006c49] text-white font-black hover:bg-[#003527] transition-colors"
                                        >
                                            Approve
                                        </button>

                                    </form>

                                    <!-- REJECT -->
                                    <form
                                        action="<?php echo e(route('donation.status', $submission->id)); ?>"
                                        method="POST">

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="cancelled">

                                        <button
                                            class="px-5 py-2 rounded-full bg-red-100 text-red-700 font-black hover:bg-red-200 transition-colors"
                                        >
                                            Reject
                                        </button>

                                    </form>

                                <?php elseif($submission->status === 'approved'): ?>

                                    <!-- COMPLETE -->
                                    <form
                                        action="<?php echo e(route('donation.status', $submission->id)); ?>"
                                        method="POST">

                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>

                                        <input
                                            type="hidden"
                                            name="status"
                                            value="completed">

                                        <button
                                            class="px-5 py-2 rounded-full bg-blue-100 text-blue-700 font-black hover:bg-blue-200 transition-colors"
                                        >
                                            Mark Completed
                                        </button>

                                    </form>

                                <?php endif; ?>

                            </div>

                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <div class="bg-[#f6ece6] rounded-2xl p-6 text-gray-500 text-sm">
                            No incoming donations yet.
                        </div>

                    <?php endif; ?>

                </div>

            </section>

        </div>

    </div>

</div>

</body>
</html>
<?php /**PATH D:\programming files yk\eco-don\resources\views/organization/donation-detail.blade.php ENDPATH**/ ?>