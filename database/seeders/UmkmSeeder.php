<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ambil id layanan default
        $fotokopiId = DB::table('service_categories')->where('name', 'Fotokopi')->first()->id;
        $percetakanId = DB::table('service_categories')->where('name', 'Percetakan')->first()->id;

        // ambil layanan
        $services = DB::table('services')->pluck('id')->toArray();

        // Data hasil pembacaan dari Excel
        $umkmList = [
            [
                'name' => 'Atiga Fotocopy',
                'address' => 'Jl. Kalimantan No.66, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '085245378964',
                'opening_hours' => '08:00 - 23:00',
                'lat' => -8.163628362096045,
                'lng' => 113.7128824286846,
            ],
            [
                'name' => 'Fotocopy Al Fattah',
                'address' => 'RPJ8+37F, Jl. Jawa IVB, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '082245676646',
                'opening_hours' => '09:00 - 23:00',
                'lat' => -8.169791529749753,
                'lng' => 113.71566093255609,
            ],
            [
                'name' => 'Fidh Photo Copy Digital',
                'address' => 'Jl. Kalimantan No.64A, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081435685778',
                'opening_hours' => '06:30 - 22:00',
                'lat' => -8.164299733116788,
                'lng' => 113.71258016813536,
            ],
            [
                'name' => 'Soerabaja45 Cabang Kampus',
                'address' => 'Jl. Kalimantan No.64 A, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081131133355',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.16443713061383,
                'lng' => 113.71275585282284,
            ],
            [
                'name' => 'Fotocopy SEP Mastrip',
                'address' => 'Jl. Mastrip No.22b, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081234848958',
                'opening_hours' => '05:30 - 22:00',
                'lat' => -8.15845477473874,
                'lng' => 113.71490834034881,
            ],
            [
                'name' => 'ALFATIH FOTOCOPY & PRINT',
                'address' => 'Jl. Karimata No.97, Gumuk Kerang, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '085707887510',
                'opening_hours' => '06:00 - 22:00',
                'lat' => -8.172315265723405,
                'lng' => 113.72033330369511,
            ],
            [
                'name' => 'Canon Foto Copy',
                'address' => 'Jl. Jawa No. 30, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081256348654',
                'opening_hours' => '07:00 - 20:00',
                'lat' => -8.169507056505033,
                'lng' => 113.71644059192398,
            ],
            [
                'name' => 'Mentari Copy Center',
                'address' => 'Jl. Mastrip No.15, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '0331334991',
                'opening_hours' => '06:00 - 21:00',
                'lat' => -8.158165939591052,
                'lng' => 113.71495427616438,
            ],
            [
                'name' => 'UD. Foto Copy Maharani',
                'address' => 'Jl. Sumatra No.128, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '085237250999',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.169011050683444,
                'lng' => 113.711016352034,
            ],
            [
                'name' => 'Ryo Digital Printing Jember',
                'address' => 'Jl. Moch. Sruji No.4, Cangkring, Patrang, Kec. Patrang, Kabupaten Jember, Jawa Timur 68111',
                'phone' => '081259522522',
                'opening_hours' => '08:00 - 22:00',
                'lat' => -8.156804493264946,
                'lng' => 113.71163789900895,
            ],
            [
                'name' => 'Danissa Fotocopy Center',
                'address' => 'RPH5+MX7, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '085278651349',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.170593423494218,
                'lng' => 113.70994346842912,
            ],
            [
                'name' => 'Teco Digital Fotocopy',
                'address' => 'Jl. Mastrip No.3/80, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081249249145',
                'opening_hours' => '07:00 - 23:00',
                'lat' => -8.162128601471165,
                'lng' => 113.72362630372541,
            ],
            [
                'name' => 'Amore 3 Copy Center',
                'address' => 'Jl. Mastrip No.22C, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68124',
                'phone' => '081269842487',
                'opening_hours' => '07:00 - 21:00',
                'lat' => -8.158426345593739,
                'lng' => 113.7149765064931,
            ],
            [
                'name' => 'Bursa Mahasiswa',
                'address' => 'Jl. Kalimantan No.61, Krajan Timur, Sumbersari, Kec. Sumbersari',
                'phone' => '08113036111',
                'opening_hours' => '08:00 - 21:30',
                'lat' => -8.1665713913203,
                'lng' => 113.7118163681271,
            ],
            [
                'name' => 'Purnama Fotocopy',
                'address' => 'Jl. Jawa 7 No.10, Tegal Boto Lor, Sumbersari, Kec, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081266894354',
                'opening_hours' => '06:30 - 22:00',
                'lat' => -8.167472796923741,
                'lng' => 113.71727918941495,
            ],
            [
                'name' => 'Shima Fotocopy',
                'address' => 'Jl. Mastrip No.79, Krajan Barat, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '082216022664',
                'opening_hours' => '07:00 - 22:00',
                'lat' => -8.165628892720445,
                'lng' => 113.72498363255497,
            ],
            [
                'name' => 'CM Copy Centre',
                'address' => 'Jl. Sumatra No.169, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081358051667',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.168726300859788,
                'lng' => 113.71081621533462,
            ],
            [
                'name' => 'Wijaya Digital Printing',
                'address' => 'Jl. Wijaya Kusuma Gg. 4 No.28, Pagah, Jemberlor, Kec. Patrang, Kabupaten Jember, Jawa Timur 68118',
                'phone' => '082143533676',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.166508391630359,
                'lng' => 113.70240501903821,
            ],
            [
                'name' => 'FOTOCOPY ESDE',
                'address' => 'Jl. Jawa IV No.3A, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '0822-3476-1991',
                'opening_hours' => '06:00 - 22:00',
                'lat' => -8.169933,
                'lng' => 113.715568,
            ],
            [
                'name' => 'Nyo Printing Jember',
                'address' => 'Jl. Karimata No.17B, Gumuk Kerang, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68122',
                'phone' => '08113606969',
                'opening_hours' => '10:00 - 22:00',
                'lat' => -8.179053754027427,
                'lng' => 113.71623158417366,
            ],
        ];

        foreach ($umkmList as $item) {

            // Insert UMKM dengan PostGIS POINT
            $umkmId = DB::table('umkms')->insertGetId([
                'name'           => $item['name'],
                'address'        => $item['address'],
                'phone'         => $item['phone'] ?? null,  // aman kalau tidak ada
                'image'          => null,
                'opening_hours'  => $item['opening_hours'],
                'geom'           => DB::raw("ST_SetSRID(ST_Point({$item['lng']}, {$item['lat']}), 4326)"),
            ]);

            // Hubungkan semua layanan
            foreach ($services as $serviceId) {
                DB::table('umkm_services')->insert([
                    'umkm_id'   => $umkmId,
                    'service_id' => $serviceId,
                ]);
            }
        }
    }
}
