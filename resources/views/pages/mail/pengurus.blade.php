<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notifikasi Persetujuan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            background-color: #28a745;
            padding: 10px;
            text-align: center;
            color: #ffffff;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }

        .email-body {
            padding: 20px;
            color: #333333;
            line-height: 1.6;
        }

        .email-footer {
            text-align: center;
            padding: 10px;
            font-size: 12px;
            color: #999999;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #28a745;
            text-decoration: none;
            border-radius: 4px;
            text-decoration: none
        }

        .btn:hover {
            background-color: #218838;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>Informasi Akun Pengurus</h1>
        </div>
        <div class="email-body">
            <p>Halo, {{ $nama_pengurus }}!</p>
            <p>Detail akun Anda adalah sebagai berikut:</p>
            <ul>
                <li><strong>Nama:</strong> {{ $nama_pengurus }}</li>
                <li><strong>Password:</strong> {{ $password }}</li>
                <li><strong>Jabatan:</strong> {{ $role }}</li>
            </ul>

            <p>Jika Anda memiliki pertanyaan, jangan ragu untuk menghubungi kami.</p>
        </div>
        <div class="email-footer">
            <p>&copy; 2024 Siperi Banten. Semua hak dilindungi.</p>
        </div>
    </div>
</body>

</html>
