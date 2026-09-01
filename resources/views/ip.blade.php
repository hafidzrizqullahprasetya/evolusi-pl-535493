<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kalkulator IP Semester — evolusi-pl-535493</title>
    <style>
        *{box-sizing:border-box} body{font-family:system-ui, sans-serif; margin:0; background:#fdfdfc; color:#1b1b18}
        .container{max-width:640px; margin:2rem auto; padding:1.5rem; background:#fff; border:1px solid #e3e3e0; border-radius:12px}
        h1{margin:0 0 .25rem} .sub{color:#706f6c; margin:0 0 1rem; font-size:.9rem}
        .baris-nim{display:flex; gap:.75rem; align-items:center; margin:1rem 0}
        .baris-nim label{font-weight:600}
        .baris-nim input{max-width:18rem; padding:.4rem .6rem; border:1px solid #ccc; border-radius:6px; flex:1}
        table{width:100%; border-collapse:collapse; margin-top:1rem}
        th{ text-align:left; border-bottom:2px solid #ccc; padding:.5rem; font-size:.85rem}
        td{padding:.4rem}
        td input, td select{width:100%; padding:.4rem; border:1px solid #ccc; border-radius:6px}
        .aksi{margin-top:1rem; display:flex; gap:.75rem}
        .btn{padding:.6rem 1rem; border:0; border-radius:8px; cursor:pointer; text-decoration:none; display:inline-block; font-size:.9rem}
        .btn-primary{background:#111; color:#fff}
        .btn-ghost{border:1px solid #ccc; color:#111; background:#fff}
        #hasil{margin-top:1rem; padding:.75rem; border-radius:8px; background:#f6f6f6}
        #hasil.galat{color:#c0392b; border:1px solid #c0392b; background:#fff2f2}
        .errors{color:#c0392b; margin-top:1rem}
        .errors li{margin:.25rem 0}
        a.top{font-size:.85rem; color:#706f6c}
    </style>
</head>
<body>
    <div class="container">
        <h1>Kalkulator IP Semester</h1>
        <p class="sub">KEPL 2026 — NIM 535493 — Hafidz Rizqullah Prasetya — Laravel 13</p>
        <p><a href="{{ url('/') }}" class="top">← Beranda</a></p>

        <form id="form-ip" method="POST" action="{{ url('/ip/hitung') }}">
            @csrf
            <p class="baris-nim">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="{{ old('nim', '24/535493/SV/24243') }}" placeholder="24/535493/SV/24243" required>
            </p>

            <table>
                <caption style="caption-side:top; text-align:left; padding:.5rem 0; font-weight:600">Daftar mata kuliah semester ini</caption>
                <thead>
                    <tr>
                        <th>Mata kuliah</th>
                        <th>SKS</th>
                        <th>Nilai</th>
                    </tr>
                </thead>
                <tbody id="baris">
                    @php
                        $defaults = old('mataKuliah', [
                            ['nama' => 'Konstruksi & Evolusi PL', 'sks' => 2, 'nilai' => 'A'],
                            ['nama' => 'Praktikum Penambangan Data', 'sks' => 3, 'nilai' => 'AB'],
                            ['nama' => 'Praktikum Pengembangan Game', 'sks' => 3, 'nilai' => 'B'],
                        ]);
                    @endphp
                    @foreach($defaults as $i => $mk)
                    <tr>
                        <td><input type="text" name="mataKuliah[{{ $i }}][nama]" value="{{ $mk['nama'] ?? '' }}" placeholder="Nama mata kuliah"></td>
                        <td><input type="number" name="mataKuliah[{{ $i }}][sks]" value="{{ $mk['sks'] ?? 3 }}" min="1" max="6"></td>
                        <td>
                            <select name="mataKuliah[{{ $i }}][nilai]">
                                @foreach(['A','AB','B','BC','C','D','E'] as $h)
                                    <option value="{{ $h }}" @selected(($mk['nilai'] ?? 'A') === $h)>{{ $h }}</option>
                                @endforeach
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="aksi">
                <button type="submit" class="btn btn-primary">Hitung IP</button>
                <a href="{{ url('/ip') }}" class="btn btn-ghost">Reset</a>
            </div>
        </form>

        @if(isset($hasil))
            <p id="hasil" class="{{ ($galat ?? false) ? 'galat' : '' }}">{{ $hasil }}</p>
        @else
            <p id="hasil">Belum dihitung.</p>
        @endif

        @if($errors->any())
            <ul class="errors">
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        @endif

        <p style="margin-top:1.5rem; font-size:.8rem; color:#706f6c">Logika di <code>App\Services\IpCalculator</code> — diuji dengan <code>phpunit</code>, style dengan <code>pint</code>.</p>
    </div>
</body>
</html>
