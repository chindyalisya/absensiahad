@if ($histori->isEmpty())
<div class="alert alert-outline-warning">
    <p>Data Belum Tersedia</p>
</div>
@endif
@foreach ($histori as $d)
<ul class="listview image-listview">
    <li>
        <div class="item">
            @php
            $path = Storage::url('uploads/absensi/'.$d->foto_in);
            @endphp
            <img src="{{ url($path) }}" alt="image" class="image">
                <div class="in">
                    <div>
                        <b>{{ date('d-m-Y', strtotime($d->tgl_presensi)) }}</b><br>
                            {{-- <small class="text-muted">{{ $d->jabatan }}</small> --}}
                                </div>
                                    <span class="badge  {{ $d->jam_in < "07:30" ?  "bg-success" : "bg-danger" }}">
                                            {{ $d->jam_in }}
                                    </span>
                                </div>
                            </div>
                        </li>
                    </ul>
@endforeach