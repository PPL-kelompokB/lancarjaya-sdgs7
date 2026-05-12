<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Models\Donation;
use Illuminate\Support\Facades\Hash;

class DonationSeeder extends Seeder
{
    public function run(): void
    {
        // Buat user organisasi jika belum ada
        $orgUser = User::firstOrCreate(
            ['email' => 'organisasi@ecodon.com'],
            [
                'name'     => 'Organisasi EcoDon',
                'password' => Hash::make('password'),
                'role'     => 'organization',
            ]
        );

        // Buat organisasi jika belum ada
        $org = Organization::firstOrCreate(
            ['user_id' => $orgUser->id],
            [
                'organization_name'    => 'Yayasan Peduli Lingkungan',
                'organization_type'    => 'Yayasan',
                'address'              => 'Jl. Sudirman No. 10',
                'org_phone'            => '021-12345678',
                'pic_name'             => 'Budi Santoso',
                'pic_email'            => 'budi@ecodon.com',
                'pic_phone'            => '08123456789',
                'founded_year'         => 2015,
                'description'          => 'Organisasi yang bergerak di bidang lingkungan dan pemberdayaan masyarakat.',
                'bank_name'            => 'BCA',
                'account_holder_name'  => 'Yayasan Peduli Lingkungan',
                'rekening_number'      => '1234567890',
                'verification_status'  => 'verified',
            ]
        );

        // Data donasi contoh
        $donations = [
            [
                'title'           => 'Donasi Buku Pelajaran SD',
                'description'     => 'Kami membuka program donasi buku pelajaran untuk anak-anak SD di daerah terpencil. Setiap buku yang kamu donasikan akan sangat membantu mereka mendapatkan pendidikan yang layak.',
                'item_name'       => 'Buku Pelajaran',
                'category'        => 'Pendidikan',
                'quantity'        => 200,
                'unit'            => 'buku',
                'address'         => 'Jl. Sudirman No. 10',
                'city'            => 'Jakarta Pusat',
                'province'        => 'DKI Jakarta',
                'contact_person'  => 'Budi Santoso',
                'contact_phone'   => '08123456789',
                'start_date'      => now()->subDays(5)->toDateString(),
                'end_date'        => now()->addDays(25)->toDateString(),
                'status'          => 'open',
                'logistic_status' => 'waiting_pickup',
            ],
            [
                'title'           => 'Donasi Pakaian Layak Pakai',
                'description'     => 'Program donasi pakaian layak pakai untuk warga yang terdampak bencana banjir di wilayah Jakarta Timur. Pakaian yang diterima akan langsung disalurkan kepada yang membutuhkan.',
                'item_name'       => 'Pakaian',
                'category'        => 'Kebutuhan Dasar',
                'quantity'        => 500,
                'unit'            => 'potong',
                'address'         => 'Jl. Matraman Raya No. 55',
                'city'            => 'Jakarta Timur',
                'province'        => 'DKI Jakarta',
                'contact_person'  => 'Sari Dewi',
                'contact_phone'   => '08234567890',
                'start_date'      => now()->subDays(10)->toDateString(),
                'end_date'        => now()->addDays(20)->toDateString(),
                'status'          => 'in_progress',
                'logistic_status' => 'picked_up',
            ],
            [
                'title'           => 'Donasi Alat Tulis Anak Yatim',
                'description'     => 'Donasikan alat tulis untuk mendukung pendidikan anak-anak yatim di panti asuhan. Satu set alat tulis bisa memberikan semangat belajar yang luar biasa bagi mereka.',
                'item_name'       => 'Alat Tulis',
                'category'        => 'Pendidikan',
                'quantity'        => 150,
                'unit'            => 'set',
                'address'         => 'Jl. Panti Asuhan No. 3',
                'city'            => 'Bandung',
                'province'        => 'Jawa Barat',
                'contact_person'  => 'Rina Wijaya',
                'contact_phone'   => '08345678901',
                'start_date'      => now()->subDays(20)->toDateString(),
                'end_date'        => now()->subDays(2)->toDateString(),
                'status'          => 'completed',
                'logistic_status' => 'distributed',
            ],
        ];

        foreach ($donations as $data) {
            Donation::create(array_merge($data, [
                'organization_id' => $org->id,
            ]));
        }

        $this->command->info('✅ DonationSeeder berhasil: ' . count($donations) . ' donasi ditambahkan.');
    }
}
