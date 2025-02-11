<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>A4</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.4.1/paper.css">

  <style>
    @page {
      size: A4;
    }

    #title {
      font-size: 18px;
      font-weight: bold;
    }

    .tabelpresensi {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }

    .tabelpresensi tr th {
      border: 1px solid #131212;
      padding: 8px;
      background: #dbdbdb;
    }

    .tabelpresensi tr td {
      border: 1px solid #131212;
      padding: 5px;
      font-size: 12px;
    }

  </style>
</head>

<body class="A4 landscape">
  <section class="sheet padding-10mm">
    <table style="width: 100%">
      <tr>
        <td style="width: 10%">
          <img src="{{ asset('assets/img/logopku.jpeg') }}" width="80" height="100" alt="">
        </td>
        <td>
          <span id="title">
            REKAP PRESENSI AHAD PAGI<br>
            PERIODE {{ strtoupper($namabulan[$bulan]) }} {{ $tahun }}<br>
            RS PKU MUHAMMADIYAH BOJA
          </span><br>
          <span><i>Jl. Raya Boja Limbangan Ds. Salamsari Kec. Boja Kab. Kendal</i></span>
        </td>
      </tr>
    </table>

    <table class="tabelpresensi">
      <thead>
        <tr>
          <th>Nik</th>
          <th>Nama Karyawan</th>
          @for ($i = 1; $i <= 4; $i++)
            <th>Minggu ke-{{ $i }}</th>
          @endfor
          <th>Total Hadir</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($rekap->groupBy('nik') as $nik => $karyawan)
          <tr>
            <td>{{ $karyawan[0]->nik }}</td>
            <td>{{ $karyawan[0]->nama_lengkap }}</td>

            @php
              $totalHadir = 0;
            @endphp

            @for ($minggu = 1; $minggu <= 4; $minggu++)
              @php
                $hadir = '';
                $jamHadir = '';
                foreach ($karyawan as $absen) {
                  $mingguKe = \Carbon\Carbon::parse($absen->tgl_presensi)->weekOfMonth;
                  if ($mingguKe == $minggu) {
                    $hadir = 'Hadir';
                    $jamHadir = $absen->jam_in;
                    $totalHadir++;
                    break;
                  }
                }
              @endphp

              <td>
                {{ $hadir == 'Hadir' ? $jamHadir : 'Tidak Hadir' }}
              </td>
            @endfor

            <td>{{ $totalHadir }}</td>
          </tr>
        @endforeach
      </tbody>
    </table>

    <table width="100%" style="margin-top:20px">
      <tr>
        <td></td>
        <td style="text-align: center;">Kendal, {{ date('d-m-Y') }}</td>
      </tr>
      <tr>
        <td style="text-align: center; vertical-align:bottom" height="100px">
          <u>Deni Kurniawan, S.sos</u><br>
          <i><b>Pembina Rohani</b></i>
        </td>
        <td style="text-align: center; vertical-align:bottom">
          <u>dr. Arfa Bima Firizqina, MARS</u><br>
          <i><b>Direktur</b></i>
        </td>
      </tr>
    </table>
  </section>
</body>

</html>
