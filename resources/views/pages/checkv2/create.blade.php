@extends('layouts.app')

@section('title')
    Test Check V2
@endsection

@section('content')
    <form class="" method="POST" action="" enctype="multipart/form-data">
    @csrf
    <div class="space-y-3">
        <h1 class="font-bold" >Data Personal</h1>

        <div class="">
            <label for="cek_tb">Tinggi Badan</label>
            <input class="border-2 border-black" type="number" name="tb">
        </div>

        <div class="">
            <label for="cek_bb">Berat Badan</label>
            <input class="border-2 border-black" type="number" name="bb">
        </div>

        <div class="">
            <label for="cek_usia">Usia</label>
            <input class="border-2 border-black" type="number" name="usia">
        </div>

        <div class="">
            <label for="cek_gender">Gender</label>
            <select class="border-2 border-black" name="" id="">
                <option value="" disabled selected hidden></option>
                <option value="l" >Laki-Laki</option>
                <option value="p" >Perempuan</option>
            </select>
        </div>

        <div class="">
            <label for="cek_tingkat_aktivitas">Tingkat Aktivitas</label>
            <select class="border-2 border-black" name="tingkat_aktivitas" id="">
                <option value="" disabled selected hidden></option>
                <option value="sangat_ringan" title="Tidak mempunyai kegiatan fisik sama sekali, seperti menonton TV, membaca, menggunakan komputer atau melakukan kegiatan menetap lainnya selama waktu luang.">Sangat Ringan</option>
                <option value="ringan" title="Aktivitas seperti guru, dokter praktek, ibu rumah tangga, dan pekerja kantor.">Ringan</option>
                <option value="sedang" title="Aktivitas seperti mahasiswa aktif, pedagang, petani, berenang, berlari, bersepeda, dan lain-lain.">Sedang</option>
                <option value="berat" title="Aktivitas seperti pekerja pabrik, pekerja bangunan, tentara yang sedang berlatih, atlet.">Berat</option>
            </select>
        </div>

        <h1 class="font-bold">Data Medis</h1>

        <div class="">
            <label for="kadar_gula">Kadar Gula</label>
            <input class="border-2 border-black" type="number" name="kadar_gula">
        </div>

        <div class="">
            <label for="cek_metode_uji">Metode Uji</label>
            <select class="border-2 border-black" name="metode_uji" id="">
                <option value="" disabled selected hidden></option>
                <option value="puasa" title="Pemeriksaan kadar gula darah saat perut kosong.">Puasa</option>
                <option value="ttgo" title="Tes Toleransi Glukosa Oral (TTGO) adalah metode pengukuran glukosa setelah mengonsumsi larutan gula khusus.">TTGO</option>
            </select>
        </div>
        <div>
            <button type="submit" class="border-2 border-black">Submit</button>
        </div>
    </div>

    </form>
@endsection
