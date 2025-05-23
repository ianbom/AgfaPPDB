<!-- resources/views/web/admin/seleksi/email/lolos.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemberitahuan Hasil Seleksi PPDB</title>
    <style>
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            font-family: 'Nunito', sans-serif;
            background-color: #f7fafc;
        }
        .header {
            text-align: center;
            padding: 20px;
            background-color: #378d4c;
            color: white;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 30px;
            background-color: white;
            border-radius: 0 0 8px 8px;
            line-height: 1.6;
        }
        .badge {
            background-color: #d4edda;
            color: #155724;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
            margin: 10px 0;
        }
        .cta-button {
            background-color: #378d4c;
            color: white !important;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 5px;
            display: inline-block;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            padding: 20px;
            color: #6c757d;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h2>AGFA SCHOOL</h2>
            <p>Penerimaan Peserta Didik Baru</p>
        </div>

        <div class="content">
            <h3>Selamat Kepada Orang Tua/Wali</h3>
            <p>Kepada Yth. Bapak/Ibu <strong>{{ $orangtua->nama}}</strong>,</p>

            <div class="badge">
                <h4>STATUS SELEKSI: LULUS 🎉</h4>
            </div>

            <p>Kami dengan senang hati menginformasikan bahwa:</p>

            <p style="font-size: 1.1em">
                Nama Calon Siswa: <strong>{{ $orangtua->nama_anak }}</strong><br>
                {{-- No. Pendaftaran: <strong>{{ $orangtua->no_pendaftaran }}</strong> --}}
            </p>

            <p>Telah dinyatakan <strong>LULUS</strong> dalam proses seleksi Penerimaan Peserta Didik Baru Agfa School.</p>

            <h4>Langkah Selanjutnya:</h4>
            <ol>
                <li>Lakukan konfirmasi penerimaan melalui tautan berikut</li>
                <li>Lengkapi dokumen persyaratan</li>
                <li>Hadir pada waktu registrasi ulang yang akan diinformasikan kemudian</li>
            </ol>

            {{-- <a href="{{ route('registrasi.lolos') }}" class="cta-button">Konfirmasi Penerimaan</a> --}}

            <p>Jika ada pertanyaan lebih lanjut, silakan hubungi kami melalui:</p>
            <p>
                Email: ppdb@agfaschool.sch.id<br>
                Telepon: (021) 1234-5678
            </p>
        </div>

        <div class="footer">
            <p>©  AGFA SCHOOL</p>
            <p>Jl. Pendidikan No. 123, Jakarta Selatan<br>
            www.agfaschool.sch.id</p>
            <small>Email ini dikirim secara otomatis, mohon tidak membalas email ini</small>
        </div>
    </div>
</body>
</html>
