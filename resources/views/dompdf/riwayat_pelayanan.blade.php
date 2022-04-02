<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}

        @page {
            margin: 0cm 0cm;
        }

        /** Define now the real margins of every page in the PDF **/
        body {
            margin-top: 2cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
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

    <header>
        PASKER.ID
    </header>

    <main>
        <center class="my-4 text-uppercase">
            <h4>History {{ $title }}</h4>
        </center>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">
                        <strong>TANGGAL</strong>
                    </th>
                    <th>
                        TOTAL PELAYANAN
                    </th>
                    <th>
                        SKOR
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($collection as $item)
                    <tr>
                        <td>
                            <strong>{{ $item['tanggal'] }}</strong>
                        </td>
                        <td>
                            <div>{{ $item['total'] }}</div>
                        </td>
                        <td>
                            <div>{{ $item['skor'] }}</div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>


</body>
</html>
