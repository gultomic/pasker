<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link rel="stylesheet" href="{{ public_path('/css/app.css') }}">
    <style type="text/css">
        @page {
            margin: 0cm 0cm;
        }
        /** Define the header rules **/
        header {
            position: fixed;
            top: 0cm;
            left: 0.2cm;
            right: 0.2cm;
            height: 1.5cm;

            /** Extra personal styles **/
            color: #074943;
            font-size: 0.8em;
            font-weight: 900;
            font-family: Arial, Helvetica, sans-serif;
            line-height: 0.6cm;
        }
	</style>
</head>
<body>
    <header>PASKER.ID</header>

    <main>
        <center class="py-6 uppercase">
            <h4>Tabel Pelaksana</h4>
        </center>

        <table class="table">
            <thead>
                <tr>
                    <th class="text-xl font-medium">#</th>
                    <th>PHOTO</th>
                    <th>NAMA</th>
                    <th>LAYANAN</th>
                    <th>TOTAL</th>
                    <th>SKOR</th>
                    <th>INDEKS</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($collection as $key => $item)
                    <tr class="border">
                        <td class="text-xl font-medium">{{ $key + 1 }}</td>
                        <td>
                            <img class="w-10 h-10 rounded-full"
                                src="{{ public_path($item['photo']) }}">
                        </td>
                        <td>
                            <div class="">{{ $item['nama'] }}</div>
                        </td>
                        <td>
                            <div>{{ $item['jumlah_pelayanan'] }} Pelayanan</div>
                        </td>
                        <td>
                            {{ number_format($item['total_pelayanan'], 0, ",", ".") }}
                        </td>
                        <td>
                            {{ number_format($item['skor_survei'], 0, ",", ".") }}
                        </td>
                        <td>
                            {{ number_format($item['indeks_kepuasan'], 1) }}%
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
</body>
</html>
