<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Voucher</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fff8f5] p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl p-6 shadow">
        <h1 class="text-2xl font-bold mb-6">Create Voucher</h1>

        <form action="{{ route('admin.vouchers.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label class="block mb-1 font-semibold">Nama Voucher</label>
                <input type="text" name="title" class="w-full border rounded-xl px-4 py-3" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Deskripsi</label>
                <textarea name="description" class="w-full border rounded-xl px-4 py-3"></textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Kode Voucher</label>
                    <input type="text" name="code" class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Tipe Diskon</label>
                    <select name="discount_type" class="w-full border rounded-xl px-4 py-3">
                        <option value="nominal">Nominal</option>
                        <option value="percentage">Percentage</option>
                        <option value="item">Item</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Nilai Diskon</label>
                    <input type="number" step="0.01" name="discount_value" class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Points Cost</label>
                    <input type="number" name="points_cost" class="w-full border rounded-xl px-4 py-3" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Quota</label>
                    <input type="number" name="quota" class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Status</label>
                    <select name="status" class="w-full border rounded-xl px-4 py-3">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                        <option value="expired">Expired</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Start Date</label>
                    <input type="date" name="start_date" class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">End Date</label>
                    <input type="date" name="end_date" class="w-full border rounded-xl px-4 py-3">
                </div>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Gambar Voucher</label>
                <input type="file" name="image" class="w-full border rounded-xl px-4 py-3">
            </div>

            <button type="submit" class="px-6 py-3 rounded-full bg-[#003527] text-white font-semibold">
                Simpan Voucher
            </button>
        </form>
    </div>
</body>
</html>