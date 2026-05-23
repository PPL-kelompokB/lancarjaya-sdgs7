<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Volunteer</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?> <!-- Jika menggunakan Vite + Tailwind -->
</head>
<body class="bg-gray-50 py-10">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-xl shadow-md">
        <h2 class="text-2xl font-bold text-[#006c49] mb-2">Formulir Pendaftaran Volunteer</h2>
        <p class="text-gray-600 mb-6">Mendaftar untuk: <span class="font-semibold"><?php echo e($volunteer->title); ?></span></p>

        <form action="<?php echo e(route('volunteer.register.submit', $volunteer->id)); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
            <?php echo csrf_field(); ?>

            <!-- Input Nama -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input type="text" name="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#006c49] focus:ring-[#006c49] border p-2">
            </div>

            <!-- Input Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#006c49] focus:ring-[#006c49] border p-2">
            </div>

            <!-- Upload CV -->
            <div>
                <label class="block text-sm font-medium text-gray-700">Unggah CV (PDF)</label>
                <input type="file" name="cv" accept=".pdf" required class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#006c49]/10 file:text-[#006c49] hover:file:bg-[#006c49]/20">
            </div>

            <!-- Tombol Submit -->
            <div class="flex justify-end pt-4">
                <button type="submit" class="px-6 py-2 bg-[#006c49] text-white rounded-full font-bold hover:bg-[#003527]">
                    Kirim Pendaftaran
                </button>
            </div>
        </form>
    </div>

</body>
</html><?php /**PATH D:\programming files yk\eco-don\resources\views/user/volunteer-register-form.blade.php ENDPATH**/ ?>