<!-- resources/views/web/admin/seleksi/email/gagal.blade.php -->
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
            background-color: #dc3545;
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
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px 20px;
            border-radius: 20px;
            display: inline-block;
            margin: 10px 0;
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
            <h3>Pemberitahuan Hasil Seleksi</h3>
            <p>Kepada Yth. Bapak/Ibu <strong>{{ $orangtua->nama }}</strong>,</p>

            <div class="badge">
                <h4>STATUS SELEKSI: TIDAK LULUS</h4>
            </div>

            <p>Dengan hormat, kami sampaikan bahwa:</p>

            <p style="font-size: 1.1em">
                Nama Calon Siswa: <strong>{{ $orangtua->nama_anak }}</strong><br>
                {{-- No. Pendaftaran: <strong>{{ $orangtua->no_pendaftaran }}</strong> --}}
            </p>

            <p>Tidak memenuhi persyaratan kelulusan dalam seleksi Penerimaan Peserta Didik Baru Agfa School.</p>

            <h4>Catatan Penting:</h4>
            <ul>
                <li>Hasil seleksi bersifat tetap dan tidak dapat diganggu gugat</li>
                <li>Proses seleksi dilakukan secara objektif dan transparan</li>
                <li>Anda dapat mencoba kembali di tahun ajaran berikutnya</li>
            </ul>

            <p>Untuk informasi lebih lanjut, silakan hubungi kami melalui:</p>
            <p>
                Email: ppdb@agfaschool.sch.id<br>
                Telepon: (021) 1234-5678<br>
                Jam Operasional: Senin-Jumat 08:00 - 16:00 WIB
            </p>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} AGFA SCHOOL</p>
            <p>Jl. Pendidikan No. 123, Jakarta Selatan<br>
            www.agfaschool.sch.id</p>
            <small>Email ini dikirim secara otomatis, mohon tidak membalas email ini</small>
        </div>
    </div>
</body>
</html>
