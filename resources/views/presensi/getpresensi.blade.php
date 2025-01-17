@foreach ($presensi as $d)
@php
$foto_in = Storage::url('uploads/absensi/' . $d->foto_in);
@endphp
<tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $d->nik }}</td>
    <td>{{ $d->nama_lengkap }}</td>
    <td>{{ $d->nama_dept }}</td>
    <td>{{ $d->jam_in }}</td>
    <td>
        <img src="{{ url($foto_in) }}" class="avatar" alt="">
    </td>
    <td>
        <a href="#" class="btn btn-primary tampilkanpeta" data-id="{{ $d->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-map-2">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 18.5l-3 -1.5l-6 3v-13l6 -3l6 3l6 -3v7.5" />
                <path d="M9 4v13" />
                <path d="M15 7v5.5" />
                <path d="M21.121 20.121a3 3 0 1 0 -4.242 0c.418 .419 1.125 1.045 2.121 1.879c1.051 -.89 1.759 -1.516 2.121 -1.879z" />
                <path d="M19 18v.01" />
            </svg>
        </a>
    </td>
</tr>
@endforeach
<script>
           $(function() {
    $(".tampilkanpeta").click(function() {
        var id = $(this).data('id'); 
        $.ajax({
            type: 'POST',
            url: '/tampilkanpeta',
            cache: false,
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(respond) {
                $("#loadmap").html(respond);
            }
        });
        $("#modal-tampilkanpeta").modal("show");
    });
});
</script>