<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    // ==========================================================
    // 1. HALAMAN UTAMA DASHBOARD
    // ==========================================================
    public function index()
    {
        // Ambil kategori untuk dropdown
        $categories = DB::table('service_categories')->get();

        // Ambil semua UMKM (untuk menampilkan marker awal di map)
        $umkm = DB::table('umkms')
            ->leftJoin('umkm_services', 'umkms.id', '=', 'umkm_services.umkm_id')
            ->leftJoin('services', 'umkm_services.service_id', '=', 'services.id')
            ->leftJoin('service_categories', 'services.service_category_id', '=', 'service_categories.id')
            ->select(
                'umkms.id',
                'umkms.name',
                'umkms.address',
                'umkms.phone',
                'umkms.opening_hours',
                'umkms.image',
                DB::raw('ST_X(umkms.geom) as lng'),
                DB::raw('ST_Y(umkms.geom) as lat'),
                'service_categories.name as category_name',
                'service_categories.icon as category_icon'
            )
            ->groupBy(
                'umkms.id',
                'umkms.name',
                'umkms.address',
                'umkms.phone',
                'umkms.opening_hours',
                'umkms.image',
                'service_categories.name',
                'service_categories.icon'
            )
            ->get();

        // Ambil layanan untuk setiap UMKM
        foreach ($umkm as $u) {
            $u->services = DB::table('services')
                ->join('umkm_services', 'services.id', '=', 'umkm_services.service_id')
                ->where('umkm_services.umkm_id', $u->id)
                ->select('services.name')
                ->get();
        }

        return view('dashboard.index', compact('umkm', 'categories'));
    }


    // ==========================================================
    // 2. FITUR PENCARIAN TEMPAT TERDEKAT
    // ==========================================================
    public function search(Request $request)
    {
        $request->validate([
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric'
        ]);

        $lat = $request->latitude;
        $lng = $request->longitude;

        // Simpan lokasi user ke session (agar map fokus ke lokasi user)
        session([
            'user_lat' => $lat,
            'user_lng' => $lng
        ]);

        $category = $request->category;
        $serviceKeyword = $request->service;

        // QUERY UMKM + SERVICE + CATEGORY
        $places = DB::table('umkms')
            ->leftJoin('umkm_services', 'umkms.id', '=', 'umkm_services.umkm_id')
            ->leftJoin('services', 'umkm_services.service_id', '=', 'services.id')
            ->leftJoin('service_categories', 'services.service_category_id', '=', 'service_categories.id')
            ->select(
                'umkms.id',
                'umkms.name',
                'umkms.address',
                'umkms.phone',
                'umkms.opening_hours',
                'umkms.image',
                DB::raw('ST_X(umkms.geom) as lng'),
                DB::raw('ST_Y(umkms.geom) as lat'),
                'service_categories.name as category_name',
                'service_categories.icon as category_icon',
                DB::raw("
                    (6371 * acos(
                        cos(radians($lat)) * cos(radians(ST_Y(umkms.geom))) *
                        cos(radians(ST_X(umkms.geom)) - radians($lng)) +
                        sin(radians($lat)) * sin(radians(ST_Y(umkms.geom)))
                    )) AS distance
                ")
            )
            ->when($category, function ($q) use ($category) {
                $q->where('service_categories.name', $category);
            })
            ->when($serviceKeyword, function ($q) use ($serviceKeyword) {
                $q->where('services.name', 'LIKE', "%$serviceKeyword%");
            })
            ->groupBy(
                'umkms.id',
                'umkms.name',
                'umkms.address',
                'umkms.phone',
                'umkms.opening_hours',
                'umkms.image',
                'service_categories.name',
                'service_categories.icon'
            )
            ->orderBy('distance', 'ASC')
            ->get();


        // Ambil layanan per UMKM
        foreach ($places as $p) {
            $p->services = DB::table('services')
                ->join('umkm_services', 'services.id', '=', 'umkm_services.service_id')
                ->where('umkm_services.umkm_id', $p->id)
                ->select('services.name')
                ->get();
        }

        // Untuk form kategori
        $categories = DB::table('service_categories')->get();

        return view('dashboard.index', [
            'umkm' => [], // map awal kosong (karena fokus ke hasil)
            'categories' => $categories,
            'places' => $places
        ]);
    }
}
