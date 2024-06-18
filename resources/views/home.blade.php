<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    </head>
    <body class="antialiased">
        <div class="container-lg">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Diagnosa Kerusakan Hardware PC?') }}</div>
                        <div class="card-body">
                            <form action="{{ route('spk.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @php
                                    if (isset($diagnosa)) {
                                        $storedGejala = json_decode($diagnosa->kondisi, true);
                                    }
                                @endphp
                                @foreach ($gejala as $item)
                                    <div class="form-check"> 
                                        <input type="hidden" name="gejala[{{ $item->kode_gejala }}]" value="0">
                                        <input 
                                            class="form-check-input" 
                                            type="checkbox" 
                                            name="gejala[{{ $item->kode_gejala }}]" 
                                            value="{{ $item->bobot }}" 
                                            id="{{ $item->kode_gejala }}"
                                            @if(isset($diagnosa->kondisi) && $storedGejala[$item->kode_gejala] != "0") 
                                                checked 
                                            @endif>
                                        <label class="form-check-label" for="{{ $item->kode_gejala }}">
                                            {{ $item->gejala }}
                                        </label>
                                    </div>
                                @endforeach
                                @if (isset($diagnosa_id))
                                    <a href="/" class="btn btn-info mt-3">Mulai Ulang</a>
                                @else
                                    <button type="submit" class="btn btn-success mt-3">Submit</button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @php
            $dataKerusakan = [
                "K001" => "Motherboard",
                "K002" => "VGA",
                "K003" => "RAM",
                "K004" => "Power Supply",
                "K005" => "Harddisk",
                "K006" => "Processor",
            ];
        @endphp
        @if (isset($diagnosa_id))
            <div class="container mt-5" style="width: 75% !important">
                <div class="fw-bold my-3 d-flex justify-content-center">
                    Hasil 
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        @php
                            $dataDiagnosa = json_decode($diagnosa->data_diagnosa, true);
                            arsort($dataDiagnosa);
                        @endphp
                        @foreach ($dataDiagnosa as $key => $value)
                            <div>{{ $dataKerusakan[$key] }} : {{ $value }} %</div>
                        @endforeach
                    </div>
                    <div class="col-md-6">
                        <p>
                            Kemungkinan kerusakan yang terjadi pada PC anda adalah : {{ $dataKerusakan[$maxKey] }}
                        </p>
                    </div>
                </div>
                <div class="mt-5">
                    <p class="fw-bold">Penanggulangan : </p>
                    @if ($maxKey == "K001")
                        <div>
                            <p>Jika Anda mengalami salah satu atau beberapa gejala di atas, ada baiknya melakukan pemeriksaan lebih lanjut. Menggunakan alat diagnostik atau membawa komputer ke teknisi profesional dapat membantu mengidentifikasi dan memperbaiki masalah dengan motherboard.</p>
                        </div>
                    @elseif ($maxKey == "K002")
                        <div>
                            <p>Jika Anda mengalami gejala-gejala di atas, ada baiknya untuk melakukan beberapa langkah berikut: </p>
                            <ul>
                                <li>Periksa Koneksi: Pastikan kartu grafis terpasang dengan benar di slot PCIe dan kabel daya serta kabel monitor tersambung dengan baik.</li>
                                <li>Bersihkan Kartu Grafis: Bersihkan debu yang menumpuk pada kartu grafis dan pastikan kipas bekerja dengan baik.</li>
                                <li>Update Driver: Perbarui driver kartu grafis ke versi terbaru dari situs resmi pabrikan.</li>
                                <li>Tes dengan Kartu Grafis Lain: Jika memungkinkan, coba ganti kartu grafis dengan yang lain untuk melihat apakah masalahnya terletak pada kartu grafis tersebut.</li>
                            </ul>
                        </div>
                    @elseif ($maxKey == "K003")
                        <div>
                            <p>Jika Anda mencurigai adanya masalah pada RAM, berikut beberapa langkah yang dapat Anda lakukan untuk memverifikasinya: </p>
                            <ul>
                                <li>Cek Koneksi RAM: Pastikan RAM terpasang dengan benar di slotnya. Coba lepas dan pasang kembali RAM untuk memastikan koneksi yang baik.</li>
                                <li>Bersihkan Slot dan Modul RAM: Bersihkan debu dari slot RAM dan modul RAM itu sendiri.</li>
                                <li>Tes RAM Satu per Satu: Jika Anda memiliki lebih dari satu modul RAM, coba lepas semua modul dan tes satu per satu untuk mengidentifikasi modul yang bermasalah.</li>
                                <li>Gunakan Alat Diagnostik: Jalankan alat diagnostik memori seperti Windows Memory Diagnostic Tool atau MemTest86 untuk memeriksa adanya error pada RAM.</li>
                                <li>Update BIOS: Kadang-kadang, update BIOS dapat memperbaiki masalah kompatibilitas RAM.</li>
                            </ul>
                        </div>
                    @elseif ($maxKey == "K004")
                        <div>
                            <p>Jika Anda mencurigai adanya masalah pada PSU, berikut beberapa langkah yang dapat Anda lakukan untuk memverifikasinya: </p>
                            <ul>
                                <li>Periksa Koneksi Kabel: Pastikan semua kabel daya dari PSU ke komponen lain terpasang dengan benar dan kencang.</li>
                                <li>Tes dengan PSU Lain: Jika memungkinkan, coba ganti PSU dengan yang lain untuk melihat apakah masalahnya terletak pada PSU tersebut.</li>
                                <li>Gunakan PSU Tester: Alat penguji PSU dapat membantu memeriksa apakah PSU memberikan output voltase yang sesuai.</li>
                                <li>Cek dengan Multimeter: Jika Anda memiliki keterampilan teknis, Anda bisa menggunakan multimeter untuk memeriksa output voltase dari PSU.</li>
                            </ul>
                        </div>
                    @elseif ($maxKey == "K005")
                        <div>
                            <p>Jika Anda mencurigai adanya masalah pada hard disk, berikut beberapa langkah yang dapat Anda lakukan untuk memverifikasinya dan mengambil tindakan: </p>
                            <ul>
                                <li>Backup Data: Segera backup data penting Anda untuk mencegah kehilangan data jika hard disk benar-benar rusak.</li>
                                <li>Gunakan Alat Diagnostik: Jalankan alat diagnostik seperti CHKDSK di Windows atau alat S.M.A.R.T. untuk memeriksa kesehatan hard disk.</li>
                                <li>Periksa Koneksi: Pastikan kabel data dan daya terhubung dengan baik ke hard disk dan motherboard.</li>
                                <li>Boot dari Media Lain: Coba boot komputer dari media lain seperti USB atau CD untuk memastikan masalah bukan pada sistem operasi.</li>
                                <li>Ganti Kabel SATA: Coba ganti kabel data SATA untuk memastikan masalah bukan pada kabel.</li>
                                <li>Defragmentasi Disk: Jalankan defragmentasi disk (untuk HDD, bukan SSD) untuk memperbaiki fragmentasi file yang bisa memperlambat kinerja.</li>
                                <li>Jika setelah melakukan langkah-langkah di atas masalah masih berlanjut, ada kemungkinan besar bahwa hard disk tersebut rusak dan perlu diganti. Mengganti hard disk dengan unit baru atau dengan SSD bisa menjadi solusi terbaik untuk memastikan kinerja dan keandalan sistem yang optimal.</li>
                            </ul>
                        </div>
                    @elseif ($maxKey == "K006")
                        <div>
                            <p>Jika Anda mencurigai adanya masalah pada prosesor, berikut beberapa langkah yang dapat Anda lakukan untuk memverifikasinya: </p>
                            <ul>
                                <li>Periksa Pendinginan: Pastikan kipas prosesor dan heatsink terpasang dengan benar dan bekerja dengan baik. Bersihkan debu yang mungkin menghambat aliran udara.</li>
                                <li>Gunakan Pasta Termal: Periksa pasta termal antara prosesor dan heatsink. Jika pasta termal sudah kering atau tidak ada, gantilah dengan yang baru.</li>
                                <li>Monitor Suhu: Gunakan perangkat lunak pemantau suhu untuk memeriksa suhu CPU saat idle dan saat beban kerja tinggi. Suhu yang terlalu tinggi dapat menunjukkan masalah pendinginan atau kerusakan pada prosesor.</li>
                                <li>Update BIOS: Pastikan BIOS motherboard Anda diperbarui ke versi terbaru, karena pembaruan BIOS dapat memperbaiki masalah kompatibilitas dengan CPU.</li>
                                <li>Cek dengan Alat Diagnostik: Jalankan alat diagnostik CPU seperti Intel Processor Diagnostic Tool atau AMD System Monitor untuk memeriksa kesehatan CPU.</li>
                                <li>Tes dengan Komponen Lain: Jika memungkinkan, coba CPU di motherboard lain atau gunakan CPU lain di motherboard Anda untuk menentukan apakah masalahnya terletak pada CPU atau motherboard.</li>
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    </body>
</html>
