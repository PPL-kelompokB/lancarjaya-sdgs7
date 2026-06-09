<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Donate - EcoDon</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-[#fff8f5] text-[#1f1b17]">

<div class="max-w-3xl mx-auto px-6 py-10">

    <!-- BACK -->
    <a href="{{ url()->previous() }}"
       class="inline-flex mb-6 text-[#006c49] font-bold hover:underline">
        ← Back
    </a>

    <div class="bg-white rounded-3xl shadow border border-[#eae1da] overflow-hidden">

        <!-- HEADER -->
        <div class="bg-[#006c49] px-8 py-7 text-white">
            <h1 class="text-3xl font-extrabold">
                Donate Items
            </h1>

            <p class="mt-2 text-sm text-[#d9f2e8]">
                Fill in your donation information and schedule a pickup.
            </p>
        </div>

        <div class="p-8">

            <!-- ERROR -->
            @if ($errors->any())
                <div class="mb-6 bg-red-100 border border-red-300 text-red-700 rounded-2xl p-4">
                    <ul class="list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- FORM -->
            <form action="{{ route('donation.submit', $donation->id) }}"
                  method="POST"
                  enctype="multipart/form-data"
                  class="space-y-6">

                @csrf

                <!-- DONATION TITLE -->
                <div>
                    <label class="block text-sm font-bold text-[#003527] mb-2">
                        Donation Campaign
                    </label>

                    <input
                        type="text"
                        value="{{ $donation->title }}"
                        disabled
                        class="w-full rounded-2xl border border-[#eae1da]
                               bg-gray-100 px-4 py-3 text-sm">
                </div>

                <!-- ITEM NAME -->
                <div>
                    <label class="block text-sm font-bold text-[#003527] mb-2">
                        Item Name *
                    </label>

                    <input
                        type="text"
                        name="item_name"
                        placeholder="Example: Clothes, Rice, Books"
                        value="{{ old('item_name') }}"
                        required
                        class="w-full rounded-2xl border border-[#eae1da]
                               px-4 py-3 text-sm
                               focus:ring-2 focus:ring-[#006c49]">
                </div>

                <!-- QUANTITY + UNIT -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div>
                        <label class="block text-sm font-bold text-[#003527] mb-2">
                            Quantity *
                        </label>

                        <input
                            type="number"
                            name="quantity"
                            min="1"
                            value="{{ old('quantity') }}"
                            required
                            class="w-full rounded-2xl border border-[#eae1da]
                                   px-4 py-3 text-sm
                                   focus:ring-2 focus:ring-[#006c49]">
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-[#003527] mb-2">
                            Unit *
                        </label>

                        <select
                            name="unit"
                            required
                            class="w-full rounded-2xl border border-[#eae1da]
                                   px-4 py-3 text-sm
                                   focus:ring-2 focus:ring-[#006c49]">

                            <option value="">Select Unit</option>

                            <option value="pcs">pcs</option>
                            <option value="kg">kg</option>
                            <option value="box">box</option>
                            <option value="bag">bag</option>
                            <option value="pack">pack</option>
                            <option value="liter">liter</option>

                        </select>
                    </div>

                </div>

                <!-- PHONE -->
                <div>
                    <label class="block text-sm font-bold text-[#003527] mb-2">
                        Phone Number *
                    </label>

                    <input
                        type="text"
                        name="phone_number"
                        placeholder="08xxxxxxxxxx"
                        value="{{ old('phone_number', auth()->user()->phone ?? '') }}"
                        required
                        class="w-full rounded-2xl border border-[#eae1da]
                               px-4 py-3 text-sm
                               focus:ring-2 focus:ring-[#006c49]">
                </div>

                <!-- PICKUP DATE -->
                <div>
                    <label class="block text-sm font-bold text-[#003527] mb-2">
                        Pickup Date *
                    </label>

                    <input
                        type="date"
                        name="pickup_date"
                        value="{{ old('pickup_date') }}"
                        required
                        class="w-full rounded-2xl border border-[#eae1da]
                               px-4 py-3 text-sm
                               focus:ring-2 focus:ring-[#006c49]">
                </div>

                <!-- ADDRESS -->
                <div>
                    <label class="block text-sm font-bold text-[#003527] mb-2">
                        Pickup Address *
                    </label>

                    <textarea
                        name="pickup_address"
                        rows="4"
                        placeholder="Enter complete pickup address"
                        required
                        class="w-full rounded-2xl border border-[#eae1da]
                               px-4 py-3 text-sm
                               focus:ring-2 focus:ring-[#006c49]">{{ old('pickup_address', auth()->user()->address ?? '') }}</textarea>
                </div>

                <!-- NOTES -->
                <div>
                    <label class="block text-sm font-bold text-[#003527] mb-2">
                        Additional Notes
                    </label>

                    <textarea
                        name="notes"
                        rows="3"
                        placeholder="Example: Blue gate, call before arriving, fragile items, etc."
                        class="w-full rounded-2xl border border-[#eae1da]
                               px-4 py-3 text-sm
                               focus:ring-2 focus:ring-[#006c49]">{{ old('notes') }}</textarea>
                </div>

                <!-- PROOF IMAGE -->
                <div>
                    <label class="block text-sm font-bold text-[#003527] mb-2">
                        Donation Photo Proof *
                    </label>

                    <input
                        type="file"
                        name="pickup_proof_image"
                        accept="image/*"
                        required
                        class="w-full rounded-2xl border border-[#eae1da]
                               bg-white px-4 py-3 text-sm">

                    <p class="text-xs text-gray-500 mt-2">
                        Upload a photo of the item you want to donate.
                    </p>
                </div>

                <!-- STATUS -->
                <div class="bg-[#f6ece6] rounded-2xl p-5">

                    <h3 class="font-bold text-[#003527] mb-3">
                        Donation Status Flow
                    </h3>

                    <div class="flex flex-wrap gap-2 text-xs font-semibold">

                        <span class="px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">
                            Pending
                        </span>

                        <span class="px-3 py-1 rounded-full bg-blue-100 text-blue-700">
                            Approved
                        </span>

                        <span class="px-3 py-1 rounded-full bg-purple-100 text-purple-700">
                            Pickup On The Way
                        </span>

                        <span class="px-3 py-1 rounded-full bg-orange-100 text-orange-700">
                            Picked Up
                        </span>

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-700">
                            Completed
                        </span>

                    </div>

                    <p class="text-sm text-[#707974] mt-4">
                        Your donation will first be reviewed by the organization.
                    </p>

                </div>

                <!-- SUBMIT -->
                <div class="pt-4">

                    <button
                        type="submit"
                        class="w-full py-4 bg-[#006c49] hover:bg-[#003527]
                               text-white text-lg font-bold rounded-2xl
                               shadow-lg transition-all duration-300 hover:scale-[1.01]">

                        Submit Donation

                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

</body>
</html>
