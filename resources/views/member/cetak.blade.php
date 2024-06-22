<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Kartu Member</title>

    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            padding: 20px;
        }

        .box {
            position: relative;
            width: 85.60mm;
            height: 53.98mm;
            border: 1px solid #000;
            border-radius: 8px;
            overflow: hidden;
            margin: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: #f9f9f9;
        }

        .card {
            width: 100%;
            height: 100%;
        }

        .logo {
            position: absolute;
            top: 10px;
            right: 10px;
            font-size: 14pt;
            font-weight: bold;
            color: #fff;
            text-align: right;
        }

        .logo p {
            margin: 0;
        }

        .logo img {
            width: 60px;
            height: 60px;
            margin-top: 100px;
        }

        .nama {
            position: absolute;
            top: 50px;
            left: 20px;
            font-size: 12pt;
            font-weight: bold;
            color: #fff;
        }

        .telepon {
            position: absolute;
            top: 75px;
            left: 20px;
            font-size: 10pt;
            color: #fff;
        }

        .barcode {
            position: absolute;
            bottom: 10px;
            left: 10px;
            border: 1px solid #000;
            padding: 5px;
            background: #fff;
        }
    </style>
</head>

<body>
    <section class="container">
        @foreach ($member_data as $key => $data)
            @foreach ($data as $item)
                <div class="box">
                    <img src="{{ asset('storage/' . $setting->card_member_path) }}" alt="card" class="card">
                    <div class="logo">
                        <p>{{ $setting->company_name }}</p>
                        <img src="{{ asset('storage/' . $setting->logo_path) }}" alt="logo">
                    </div>
                    <div class="nama">{{ $item->name }}</div>
                    <div class="telepon">{{ $item->phone_number }}</div>
                    <div class="barcode">
                        <img src="data:image/png;base64,{{ DNS2D::getBarcodePNG($item->member_code, 'QRCODE') }}"
                            alt="qrcode" height="45" width="45">
                    </div>
                </div>
            @endforeach
        @endforeach
    </section>
</body>

</html>
