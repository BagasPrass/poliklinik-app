<?php

namespace App\Http\Controllers\Pasien;

use App\Http\Controllers\Controller;
use App\Models\DaftarPoli;
use App\Models\JadwalPeriksa;
use App\Models\Poli;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function get()
    {
        // Ambil data pasien yang sedang login
        $user = Auth::user();
        
        // Ambil semua data poli untuk dropdown pilihan poli
        $polis = Poli::all();
        
        // Ambil jadwal periksa dengan eager loading dokter dan poli
        // untuk menampilkan jadwal lengkap dengan info dokter dan poli-nya
        $jadwals = JadwalPeriksa::with(['dokter', 'dokter.poli'])->get();
        
        // Ambil riwayat pendaftaran poli pasien yang sedang login
        // dengan eager loading untuk menampilkan detail lengkap
        $daftarPolis = DaftarPoli::with([
                'pasien',
                'jadwalPeriksa.dokter.poli', 
                'jadwalPeriksa.dokter'
            ])
            ->where('id_pasien', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('pasien.daftar', compact('user', 'polis', 'jadwals', 'daftarPolis'));
    }

    public function submit(Request $request)
    {
         $user = Auth::user();
        // Validasi data yang diinput
        $validated = $request->validate([
            'id_jadwal' => 'required|exists:jadwal_periksa,id',
            'keluhan' => 'required|string|max:500',
        ]);

         $sudahDaftar = DaftarPoli::where('id_pasien', $user->id)
            ->where('id_jadwal', $request->id_jadwal)
            ->whereDate('created_at', now()->toDateString())
            ->exists();

        if ($sudahDaftar) {
            return redirect()->back()->with([
                'message' => 'Anda sudah mendaftar pada jadwal ini hari ini!',
                'type' => 'warning',
            ]);
        }

        // Hitung nomor antrian berdasarkan jadwal dan tanggal hari ini
        $jumlahAntrian = DaftarPoli::where('id_jadwal', $request->id_jadwal)
            ->whereDate('created_at', now()->toDateString())
            ->count();

        $noAntrian = $jumlahAntrian + 1;

        // Simpan data ke tabel daftar_poli
        DaftarPoli::create([
            'id_pasien' => $user->id,
            'id_jadwal' => $request->id_jadwal,
            'keluhan' => $request->keluhan,
            'no_antrian' => $noAntrian,
        ]);

        return redirect()->back()->with([
            'message' => 'Berhasil mendaftar! Nomor antrian Anda: ' . $noAntrian,
            'type' => 'success',
        ]);
    }
}