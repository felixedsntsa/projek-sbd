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
        // 1. Ambil ID Kategori
        $catPercetakanId = DB::table('service_categories')->where('name', 'Percetakan')->value('id');
        $catFotokopiId   = DB::table('service_categories')->where('name', 'Fotokopi')->value('id');

        // 2. Ambil List Service ID berdasarkan Kategorinya
        // Hasilnya berupa array ID, misal: [1, 2, 3]
        $servicesPercetakan = DB::table('services')->where('service_category_id', $catPercetakanId)->pluck('id')->toArray();
        $servicesFotokopi   = DB::table('services')->where('service_category_id', $catFotokopiId)->pluck('id')->toArray();

        // Data hasil pembacaan dari Excel
        $umkmList = [
            [
                'name' => 'Atiga Fotocopy',
                'address' => 'Jl. Kalimantan No.66, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '085245378964',
                'opening_hours' => '08:00 - 23:00',
                'lat' => -8.163628362096045,
                'lng' => 113.7128824286846,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Fotocopy Al Fattah',
                'address' => 'RPJ8+37F, Jl. Jawa IVB, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '082245676646',
                'opening_hours' => '09:00 - 23:00',
                'lat' => -8.169791529749753,
                'lng' => 113.71566093255609,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Fidh Photo Copy Digital',
                'address' => 'Jl. Kalimantan No.64A, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081435685778',
                'opening_hours' => '06:30 - 22:00',
                'lat' => -8.164299733116788,
                'lng' => 113.71258016813536,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Soerabaja45 Cabang Kampus',
                'address' => 'Jl. Kalimantan No.64 A, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081131133355',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.16443713061383,
                'lng' => 113.71275585282284,
                'categories' => ['Percetakan'],
            ],
            [
                'name' => 'Fotocopy SEP Mastrip',
                'address' => 'Jl. Mastrip No.22b, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081234848958',
                'opening_hours' => '05:30 - 22:00',
                'lat' => -8.15845477473874,
                'lng' => 113.71490834034881,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'ALFATIH PRINT',
                'address' => 'Jl. Karimata No.97, Gumuk Kerang, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '085707887510',
                'opening_hours' => '06:00 - 22:00',
                'lat' => -8.172315265723405,
                'lng' => 113.72033330369511,
                'categories' => ['Percetakan'],
            ],
            [
                'name' => 'Canon Foto Copy',
                'address' => 'Jl. Jawa No. 30, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081256348654',
                'opening_hours' => '07:00 - 20:00',
                'lat' => -8.169507056505033,
                'lng' => 113.71644059192398,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Mentari Copy Center',
                'address' => 'Jl. Mastrip No.15, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '0331334991',
                'opening_hours' => '06:00 - 21:00',
                'lat' => -8.158165939591052,
                'lng' => 113.71495427616438,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'UD. Foto Copy Maharani',
                'address' => 'Jl. Sumatra No.128, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '085237250999',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.169011050683444,
                'lng' => 113.711016352034,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Ryo Digital Printing Jember',
                'address' => 'Jl. Moch. Sruji No.4, Cangkring, Patrang, Kec. Patrang, Kabupaten Jember, Jawa Timur 68111',
                'phone' => '081259522522',
                'opening_hours' => '08:00 - 22:00',
                'lat' => -8.156804493264946,
                'lng' => 113.71163789900895,
                'categories' => ['Percetakan'],
            ],
            [
                'name' => 'Danissa Fotocopy Center',
                'address' => 'RPH5+MX7, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '085278651349',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.170593423494218,
                'lng' => 113.70994346842912,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Teco Digital Fotocopy',
                'address' => 'Jl. Mastrip No.3/80, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081249249145',
                'opening_hours' => '07:00 - 23:00',
                'lat' => -8.162128601471165,
                'lng' => 113.72362630372541,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Amore 3 Copy Center',
                'address' => 'Jl. Mastrip No.22C, Krajan Timur, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68124',
                'phone' => '081269842487',
                'opening_hours' => '07:00 - 21:00',
                'lat' => -8.158426345593739,
                'lng' => 113.7149765064931,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Bursa Mahasiswa',
                'address' => 'Jl. Kalimantan No.61, Krajan Timur, Sumbersari, Kec. Sumbersari',
                'phone' => '08113036111',
                'opening_hours' => '08:00 - 21:30',
                'lat' => -8.1665713913203,
                'lng' => 113.7118163681271,
                'categories' => ['Percetakan'],
            ],
            [
                'name' => 'Purnama Fotocopy',
                'address' => 'Jl. Jawa 7 No.10, Tegal Boto Lor, Sumbersari, Kec, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081266894354',
                'opening_hours' => '06:30 - 22:00',
                'lat' => -8.167472796923741,
                'lng' => 113.71727918941495,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Shima Fotocopy',
                'address' => 'Jl. Mastrip No.79, Krajan Barat, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '082216022664',
                'opening_hours' => '07:00 - 22:00',
                'lat' => -8.165628892720445,
                'lng' => 113.72498363255497,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'CM Copy Centre',
                'address' => 'Jl. Sumatra No.169, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '081358051667',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.168726300859788,
                'lng' => 113.71081621533462,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Wijaya Digital Printing',
                'address' => 'Jl. Wijaya Kusuma Gg. 4 No.28, Pagah, Jemberlor, Kec. Patrang, Kabupaten Jember, Jawa Timur 68118',
                'phone' => '082143533676',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.166508391630359,
                'lng' => 113.70240501903821,
                'categories' => ['Percetakan'],
            ],
            [
                'name' => 'FOTOCOPY ESDE',
                'address' => 'Jl. Jawa IV No.3A, Tegal Boto Lor, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68121',
                'phone' => '0822-3476-1991',
                'opening_hours' => '06:00 - 22:00',
                'lat' => -8.169933,
                'lng' => 113.715568,
                'categories' => ['Fotokopi'],
            ],
            [
                'name' => 'Nyo Printing Jember',
                'address' => 'Jl. Karimata No.17B, Gumuk Kerang, Sumbersari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68122',
                'phone' => '08113606969',
                'opening_hours' => '10:00 - 22:00',
                'lat' => -8.179053754027427,
                'lng' => 113.71623158417366,
                'categories' => ['Percetakan'],
            ],
            [
                'name' => 'BSP PRINTING JEMBER',
                'address' => 'Jl. Letjend Suprapto No.176b, Lingkungan Krajan, Kebonsari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68122',
                'phone' => '085119834399',
                'opening_hours' => '07:00 - 21:00',
                'lat' => -8.186621446024446,
                'lng' => 113.70254479163786,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'Metal Digital Printing Jember',
                'address' => 'Jl. Diponegoro No.66, Tembaan, Kepatihan, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68137',
                'phone' => '081259670188',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.17245212334191,
                'lng' => 113.69712143819095,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'Makmur Printing',
                'address' => 'Jl. Slamet Riyadi No.108, Krajan, Baratan, Kec. Patrang, Kabupaten Jember, Jawa Timur 68112',
                'phone' => '082231634312',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.143884007590398,
                'lng' => 113.725662212771,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'GRAND88 Digital Printing',
                'address' => 'Jl. KH Shiddiq, Kelurahan Jember Kidu, Jember Kidul, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131',
                'phone' => '082330432158',
                'opening_hours' => '08:00 - 20:00',
                'lat' => -8.17462000232211,
                'lng' => 113.6928708852022,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'Araya Printing',
                'address' => 'Jl. Trunojoyo No.93 A, Tembaan, Kepatihan, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131',
                'phone' => '0331422283',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.174424068894949,
                'lng' => 113.6985040836544,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'HIjau Printing',
                'address' => 'Jl. Jayanegara Patimura (pasar pelita No.14, Patimura, Jember Kidul, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131',
                'phone' => '082228173227',
                'opening_hours' => '06:00 - 21:00',
                'lat' => -8.175639504062188,
                'lng' => 113.68566512912095,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'Chall stiker',
                'address' => 'Jl. Gajah Mada No.287, Kaliwates Kidul, Kaliwates, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131',
                'phone' => '081238040045',
                'opening_hours' => '08:30 - 23:00',
                'lat' => -8.181234923577428,
                'lng' => 113.67288847552024,
                'categories' => ['Fotokopi']
            ],
            [
                'name' => 'Nanda Printing',
                'address' => 'Perumahan Pondok Gede Permai blok CB14, Kabupaten Jember, Jawa Timur 68213',
                'phone' => '082331566531',
                'opening_hours' => '08:00 - 17:00',
                'lat' => -8.19727226557638,
                'lng' => 113.69639854112157,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'FASHCOM Print',
                'address' => 'Jl. Basuki Rahmat, Tegal Besar, Kaliwates, Muktisari, Tegal Besar, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68132',
                'phone' => '082232977676',
                'opening_hours' => '08:00 - 21:00',
                'lat' => -8.198801430251892,
                'lng' => 113.6988876309898,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'SB Digital Printing',
                'address' => 'Jl. Perumahan Taman Gading No.O-3, Tumpengsari, Tegal Besar, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68132',
                'phone' => '085895202575',
                'opening_hours' => '05:30 - 22:00',
                'lat' => -8.199650963641979,
                'lng' => 113.70575408579869,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'Atika Print',
                'address' => 'Jl. Letjen Sutoyo No.88-B, Lingkungan Sumber Pak, Kebonsari, Kec. Sumbersari, Kabupaten Jember, Jawa Timur 68122',
                'phone' => '082143945678',
                'opening_hours' => '07:30 - 17:00',
                'lat' => -8.191420209331225,
                'lng' => 113.70963402705138,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'EZ FOTO COPY',
                'address' => 'Jl. Perumahan Surya Mangli Asri No.2, Krajan, Mangli, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68136',
                'phone' => '082143275216',
                'opening_hours' => '05:00 - 23:00',
                'lat' => -8.186960046455209,
                'lng' => 113.6491062133285,
                'categories' => ['Fotokopi']
            ],
            [
                'name' => 'MZ. BOB DIGITAL PRINTING',
                'address' => 'Jl. Jumat No.78, Karang Miuwo, Mangli, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131',
                'phone' => '085706711464',
                'opening_hours' => '04:00 - 23:30',
                'lat' => -8.193629033323903,
                'lng' => 113.65434188537775,
                'categories' => ['Percetakan']
            ],
            [
                'name' => 'Fotokopi Al-Raza',
                'address' => 'Jl. Melati V No.2, Ledok, Jember Kidul, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131',
                'phone' => '081336763665',
                'opening_hours' => '06:30 - 21:00',
                'lat' => -8.170563208993423,
                'lng' => 113.68880867882683,
                'categories' => ['Fotokopi']
            ],
            [
                'name' => 'Akeno Digital Printing',
                'address' => 'Jl. Gajah Mada No.367, Kaliwates Kidul, Kaliwates, Kec. Kaliwates, Kabupaten Jember, Jawa Timur 68131',
                'phone' => '08146538790',
                'opening_hours' => '07:00 - 19:00',
                'lat' => -8.17986616055036,
                'lng' => 113.67610573732942,
                'categories' => ['Percetakan']
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

            // Siapkan array penampung layanan yang akan dipilih
            $selectedServices = [];

            // Cek kategori yang didefinisikan di array $item
            if (in_array('Fotokopi', $item['categories'])) {
                $selectedServices = array_merge($selectedServices, $servicesFotokopi);
            }

            if (in_array('Percetakan', $item['categories'])) {
                $selectedServices = array_merge($selectedServices, $servicesPercetakan);
            }

            // Hubungkan layanan yang sudah terpilih saja
            foreach ($selectedServices as $serviceId) {
                DB::table('umkm_services')->insert([
                    'umkm_id'    => $umkmId,
                    'service_id' => $serviceId,
                ]);
            }
        }
    }
}
