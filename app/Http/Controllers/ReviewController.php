<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Tampilkan halaman detail UMKM dengan review
    public function show($id)
    {
        $umkm = DB::table('umkms')
            ->leftJoin('umkm_services', 'umkms.id', '=', 'umkm_services.umkm_id')
            ->leftJoin('services', 'umkm_services.service_id', '=', 'services.id')
            ->leftJoin('service_categories', 'services.service_category_id', '=', 'service_categories.id')
            ->where('umkms.id', $id)
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
            ->first();

        if (!$umkm) {
            return redirect()->route('dashboard')->with('error', 'UMKM tidak ditemukan');
        }

        // Ambil layanan UMKM
        $umkm->services = DB::table('services')
            ->join('umkm_services', 'services.id', '=', 'umkm_services.service_id')
            ->where('umkm_services.umkm_id', $id)
            ->select('services.name')
            ->get();

        // Ambil semua review
        $reviews = DB::table('reviews')
            ->leftJoin('users', 'reviews.user_id', '=', 'users.id')
            ->where('reviews.umkm_id', $id)
            ->select(
                'reviews.*',
                'users.name as user_name'
            )
            ->orderBy('reviews.created_at', 'DESC')
            ->paginate(5);

        // Hitung rata-rata rating
        $avgRating = DB::table('reviews')
            ->where('umkm_id', $id)
            ->avg('rating');

        $totalReviews = $reviews->total();

        // Cek apakah user sudah pernah review
        $userReview = DB::table('reviews')
            ->where('umkm_id', $id)
            ->where('user_id', Auth::id())
            ->first();

        return view('reviews.show', compact('umkm', 'reviews', 'avgRating', 'totalReviews', 'userReview'));
    }

    // Simpan review baru
    public function store(Request $request, $umkmId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        // Cek apakah user sudah pernah review
        $existing = DB::table('reviews')
            ->where('umkm_id', $umkmId)
            ->where('user_id', Auth::id())
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Anda sudah memberikan review untuk UMKM ini');
        }

        DB::table('reviews')->insert([
            'umkm_id' => $umkmId,
            'user_id' => Auth::id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect()->back()->with('success', 'Review berhasil ditambahkan!');
    }

    // Update review
    public function update(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:500'
        ]);

        $review = DB::table('reviews')->where('id', $id)->first();

        if (!$review || $review->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Review tidak ditemukan atau Anda tidak memiliki akses');
        }

        DB::table('reviews')
            ->where('id', $id)
            ->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
                'updated_at' => now()
            ]);

        return redirect()->back()->with('success', 'Review berhasil diperbarui!');
    }

    // Hapus review
    public function destroy($id)
    {
        $review = DB::table('reviews')->where('id', $id)->first();

        if (!$review || $review->user_id != Auth::id()) {
            return redirect()->back()->with('error', 'Review tidak ditemukan atau Anda tidak memiliki akses');
        }

        DB::table('reviews')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Review berhasil dihapus!');
    }
}
