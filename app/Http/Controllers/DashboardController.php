<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil UMKM dan koordinat
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

        // Ambil kategori (percetakan, fotokopi)
        $categories = DB::table('service_categories')->get();

        return view('dashboard.index', compact('umkm', 'categories'));
    }
}
