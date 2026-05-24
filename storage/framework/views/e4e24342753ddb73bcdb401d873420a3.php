<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Blog - <?php echo e($organization->organization_name); ?></title>

    <script src="https://cdn.tailwindcss.com"></script>

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#003527",
                        secondary: "#006c49",
                        surface: "#fff8f5",
                        cream: "#f6ece6",
                    },
                    fontFamily: {
                        sans: ["Inter", "sans-serif"],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-surface min-h-screen text-gray-800">

    <div class="min-h-screen flex items-center justify-center px-4 py-10">
        <div class="w-full max-w-4xl bg-white rounded-3xl shadow-xl overflow-hidden">

            <div class="bg-gradient-to-r from-primary to-secondary px-8 py-8 text-white">
                <p class="text-sm opacity-80 mb-2">EcoDon Organization</p>
                <h1 class="text-3xl font-extrabold">Buat Blog Baru</h1>
                <p class="mt-2 text-white/80">
                    Tulis cerita, kegiatan, atau update terbaru dari <?php echo e($organization->organization_name); ?>.
                </p>
            </div>

            <div class="p-8">

                <?php if($errors->any()): ?>
                    <div class="mb-6 rounded-2xl bg-red-50 border border-red-200 text-red-700 px-5 py-4">
                        <p class="font-bold mb-2">Ada error:</p>
                        <ul class="list-disc pl-5 space-y-1 text-sm">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('organization.blog.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-6">
                    <?php echo csrf_field(); ?>

                    <input type="hidden" name="organization_id" value="<?php echo e($organization->id); ?>">

                    <div>
                        <label class="block mb-2 font-bold text-primary">
                            Judul Blog
                        </label>
                        <input 
                            type="text" 
                            name="title"
                            value="<?php echo e(old('title')); ?>"
                            class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                            placeholder="Contoh: Aksi Bersih Sungai Bersama Relawan"
                            required
                        >
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-primary">
                            Gambar Blog
                        </label>

                        <div class="rounded-2xl border-2 border-dashed border-gray-300 bg-cream/60 p-5">
                            <input 
                                type="file" 
                                name="image"
                                id="imageInput"
                                accept="image/*"
                                class="block w-full text-sm text-gray-700"
                            >

                            <p class="mt-2 text-xs text-gray-500">
                                Format: JPG, JPEG, PNG. Maksimal 2MB.
                            </p>

                            <img 
                                id="imagePreview"
                                class="hidden mt-5 w-full max-h-80 object-cover rounded-2xl border"
                                alt="Preview gambar"
                            >
                        </div>
                    </div>

                    <div>
                        <label class="block mb-2 font-bold text-primary">
                            Konten Blog
                        </label>
                        <textarea 
                            name="content"
                            rows="12"
                            class="w-full rounded-2xl border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-secondary"
                            placeholder="Tulis isi blog di sini..."
                            required
                        ><?php echo e(old('content')); ?></textarea>
                    </div>

                    <div class="flex flex-col sm:flex-row justify-end gap-3 pt-4">
                        <a href="<?php echo e(route('organization.dashboard')); ?>"
                           class="px-6 py-3 bg-gray-200 text-gray-700 rounded-full font-bold text-center hover:bg-gray-300 transition">
                            Batal
                        </a>

                        <button 
                            type="submit"
                            class="px-8 py-3 bg-primary text-white rounded-full font-bold hover:bg-secondary transition"
                        >
                            Publish Blog
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <script>
        const imageInput = document.getElementById('imageInput');
        const imagePreview = document.getElementById('imagePreview');

        imageInput.addEventListener('change', function () {
            const file = this.files[0];

            if (file) {
                imagePreview.src = URL.createObjectURL(file);
                imagePreview.classList.remove('hidden');
            } else {
                imagePreview.src = '';
                imagePreview.classList.add('hidden');
            }
        });
    </script>

</body>
</html><?php /**PATH D:\programming files yk\eco-don\resources\views/organization/createBlog.blade.php ENDPATH**/ ?>