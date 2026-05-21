<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Voucher</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#fff8f5] p-8">
    <div class="max-w-3xl mx-auto bg-white rounded-2xl p-6 shadow">
        <h1 class="text-2xl font-bold mb-6">Edit Voucher</h1>

        <form action="{{ route('admin.vouchers.update', $voucher->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block mb-1 font-semibold">Nama Voucher</label>
                <input type="text" name="title" value="{{ old('title', $voucher->title) }}" class="w-full border rounded-xl px-4 py-3" required>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Deskripsi</label>
                <textarea name="description" class="w-full border rounded-xl px-4 py-3">{{ old('description', $voucher->description) }}</textarea>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Kode Voucher</label>
                    <input type="text" name="code" value="{{ old('code', $voucher->code) }}" class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Tipe Diskon</label>
                    <select name="discount_type" class="w-full border rounded-xl px-4 py-3">
                        <option value="nominal" {{ old('discount_type', $voucher->discount_type) == 'nominal' ? 'selected' : '' }}>Nominal</option>
                        <option value="percentage" {{ old('discount_type', $voucher->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage</option>
                        <option value="item" {{ old('discount_type', $voucher->discount_type) == 'item' ? 'selected' : '' }}>Item</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Nilai Diskon</label>
                    <input type="number" step="0.01" name="discount_value" value="{{ old('discount_value', $voucher->discount_value) }}" class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Points Cost</label>
                    <input type="number" name="points_cost" value="{{ old('points_cost', $voucher->points_cost) }}" class="w-full border rounded-xl px-4 py-3" required>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Quota</label>
                    <input type="number" name="quota" value="{{ old('quota', $voucher->quota) }}" class="w-full border rounded-xl px-4 py-3" required>
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Status</label>
                    <select name="status" class="w-full border rounded-xl px-4 py-3">
                        <option value="active" {{ old('status', $voucher->status) == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ old('status', $voucher->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="expired" {{ old('status', $voucher->status) == 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Start Date</label>
                    <input type="date" name="start_date" value="{{ old('start_date', $voucher->start_date) }}" class="w-full border rounded-xl px-4 py-3">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">End Date</label>
                    <input type="date" name="end_date" value="{{ old('end_date', $voucher->end_date) }}" class="w-full border rounded-xl px-4 py-3">
                </div>
            </div>

            <div>
                <label class="block mb-1 font-semibold">Gambar Voucher</label>
                <input type="file" name="image" class="w-full border rounded-xl px-4 py-3">

                @if($voucher->image)
                    <img src="{{ asset('storage/' . $voucher->image) }}" class="mt-3 w-32 rounded-xl">
                @endif
            </div>

            <button type="submit" class="px-6 py-3 rounded-full bg-[#003527] text-white font-semibold">
                Update Voucher
            </button>
        </form>
    </div>
</body>
</html>