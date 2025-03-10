@extends('layouts.admin.tabler')
@section('content')
<div class="page-header d-print-none">
          <div class="container-xl">
            <div class="row g-2 align-items-center">
              <div class="col">
                <!-- Page pre-title -->
                <h2 class="page-title">
                  Data Karyawan
                </h2>
              </div>
            </div>
          </div>
        </div>
        <div class="page-body">
          <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                    <div class="card-body">
                    <div class="row">
                    <div class="col-12">
                      @if (Session::get('success'))
                      <div class="alert alert-success">
                      {{ Session::get('success') }}
                    </div>
                    @endif

                    @if (Session::get('warning'))
                      <div class="alert alert-warning">
                      {{ Session::get('warning') }}
                    </div>
                    @endif
                    </div>
                  </div>
                          <div class="row">
                           <div class="col-12">
                           <a href="#" class="btn btn-primary" id="btnTambahKaryawan" data-bs-toggle="modal" data-bs-target="#modal-inputkaryawan">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M12 5l0 14" />
                              <path d="M5 12l14 0" />
                            </svg>
                            Tambah Data
                          </a>
                          </div>
                        </div>
                          <div class="row mt-2">
                           <div class="col-12">
                              <form action="/karyawan" method="GET">
                                <div class="row">
                                  <div class="col-6">
                                      <div class="form-group">
                                        <input type="text" name="nama_karyawan" id="nama_karyawan" class="form-control" 
                                        placeholder="Nama Karyawan" value="{{ Request('nama_karyawan') }}">
                                      </div>
                                    </div>
                                    <div class="col-4">
                                      <div class="form-group">
                                        <select name="kode_dept" id="kode_dept" class="form-select">
                                          <option value="">Departemen</option>
                                          @foreach ($departemen as $d)
                                          <option {{ Request('kode_dept')==$d->kode_dept ? 'selected' : ' ' }} value="{{ $d ->kode_dept }}">{{ $d->nama_dept }}</option>
                                          @endforeach
                                        </select>
                                      </div>
                                    </div>
                                    <div class="col-2">
                                      <div class="form-group">
                                        <button type="submit" class="btn btn-primary">
                                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-search"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" /><path d="M21 21l-6 -6" /></svg>
                                       Cari
                                      </button>
                                      </div>
                                    </div>
                                </div>
                              </form>
                            </div>
                          </div>
                          <div class="row mt-2">
                            <div class="col-12">
                            <table class="table table-bordered">
                    <thread>
                        <tr>
                            <th>No</th>
                            <th>Nik</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>No. HP</th>
                            <th>Foto</th>
                            <th>Departemen</th>
                            <th>Aksi</th>
                        </tr>
                    </thread>
                    <tbody>
    @foreach ($karyawan as $d)
    @php
        $path = Storage::url('uploads/karyawan/' . $d->foto);
    @endphp
    <tr>
        <td>{{ $loop->iteration + ($karyawan->currentPage() - 1) * $karyawan->perPage() }}</td>
        <td>{{ $d->nik }}</td>
        <td>{{ $d->nama_lengkap }}</td>
        <td>{{ $d->jabatan }}</td>
        <td>{{ $d->no_hp }}</td>
        <td>
            @if(empty($d->foto))
                <img src="{{ asset('assets/img/nophoto.jpg') }}" class="avatar" alt="No Photo">
            @else
                <img src="{{ $path }}" class="avatar" alt="Foto Karyawan">
            @endif
        </td>
        <td>{{ $d->nama_dept }}</td>
        <td>
            <div class="btn-group">
                <button href="#" class="edit btn btn-info btn-sm" nik="{{ $d->nik }}">
                    <!-- Edit Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                        <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1"/>
                        <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z"/>
                        <path d="M16 5l3 3"/>
                    </svg>
                </button>
                <form action="/karyawan/{{ $d->nik }}/delete" method="POST" style="margin-left:5px">
                    @csrf
                    <button class="btn btn-danger btn-sm delete-confirm">
                        <!-- Delete Icon -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-trash">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <path d="M20 6a1 1 0 0 1 .117 1.993l-.117 .007h-.081l-.919 11a3 3 0 0 1 -2.824 2.995l-.176 .005h-8c-1.598 0 -2.904 -1.249 -2.992 -2.75l-.005 -.167l-.923 -11.083h-.08a1 1 0 0 1 -.117 -1.993l.117 -.007h16z"/>
                            <path d="M14 2a2 2 0 0 1 2 2a1 1 0 0 1 -1.993 .117l-.007 -.117h-4l-.007 .117a1 1 0 0 1 -1.993 -.117a2 2 0 0 1 1.85 -1.995l.15 -.005h4z"/>
                        </svg>
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @endforeach
</tbody>
                    </table>
                    {{ $karyawan -> links('vendor.pagination.bootstrap-5') }}
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
        </div>
        <div class="modal modal-blur fade" id="modal-inputkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Tambah Data Karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="/karyawan/store" method="POST" id="frmKaryawan" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-12">
                <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-scan"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7v-1a2 2 0 0 1 2 -2h2" /><path d="M4 17v1a2 2 0 0 0 2 2h2" /><path d="M16 4h2a2 2 0 0 1 2 2v1" /><path d="M16 20h2a2 2 0 0 0 2 -2v-1" /><path d="M5 12l14 0" /></svg>
                        </span>
                      <input type="text" value="" id="nik" name="nik" class="form-control" placeholder="Nik">
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-12">
                <div class="input-icon mb-3">
                        <span class="input-icon-addon">
                        <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                          <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                        </span>
                      <input type="text" value="" id="nama_lengkap" class="form-control" name="nama_lengkap" placeholder="Nama Karyawan">
                    </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-12">
                <div class="input-icon mb-3">
                          <span class="input-icon-addon">
                          <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                            <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-device-analytics"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M3 4m0 1a1 1 0 0 1 1 -1h16a1 1 0 0 1 1 1v10a1 1 0 0 1 -1 1h-16a1 1 0 0 1 -1 -1z" /><path d="M7 20l10 0" /><path d="M9 16l0 4" /><path d="M15 16l0 4" /><path d="M8 12l3 -3l2 2l3 -3" /></svg>
                          </span>
                        <input type="text" value="" id="jabatan" class="form-control" name="jabatan" placeholder="Jabatan">
                      </div>
                    </div>
                </div>
                <div class="row">
                <div class="col-12">
                <div class="input-icon mb-3">
                            <span class="input-icon-addon">
                            <!-- Download SVG icon from http://tabler-icons.io/i/user -->
                              <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-phone"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" /></svg>
                            </span>
                          <input type="text" value="" id="no_hp" class="form-control" name="no_hp" placeholder="No.HP">
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                  <div class="col-6">
                    <input type="file" name="foto" class="form-control">
                  </div>
                </div>
                <div class="row">
                  <div class="col-6">
                  <select name="kode_dept" id="kode_dept" class="form-select">
                          <option value="">Departemen</option>
                          @foreach ($departemen as $d)
                          <option {{ Request('kode_dept')==$d->kode_dept ? 'selected' : ' ' }} value="{{ $d ->kode_dept }}">{{ $d->nama_dept }}</option>
                          @endforeach
                    </select>
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-12">
                    <div class="form-group">
                      <button class="btn btn-primary w-100">
                      <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-send"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 14l11 -11" /><path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" /></svg>  
                      Simpan Data
                    </button>
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>

      <div class="modal modal-blur fade" id="modal-editkaryawan" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Data Karyawan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="loadeditform">
            </div>
          </div>
        </div>
      </div>
      @endsection
      @push('myscript')
        <script>
          $(function() {
              $("#btnTambahKaryawan").click(function() {
                $("#modal-inputkaryawan").modal("show");
              });

              $(".edit").click(function() {
                var nik = $(this).attr('nik');
                $.ajax({
                  type: 'POST',
                  url: '/karyawan/edit',
                  cache: false,
                  data: {
                    _token: "{{ csrf_token(); }}",
                    nik: nik
                  },
                  success: function(response) {
                    $("#loadeditform").html(response);
                  }
                });
                $("#modal-editkaryawan").modal("show");
              });

              $('.delete-confirm').click(function(e) {
                var form = $(this).closest('form');
                e.preventDefault();
                Swal.fire({
                  title: "Yakin Akan Menghapus Data?",
                  text: "Jika Ya Maka Data Akan Terhapus Permanen",
                  icon: "warning",
                  showCancelButton: true,
                  confirmButtonColor: "#3085d6",
                  cancelButtonColor: "#d33",
                  confirmButtonText: "Ya, Hapus Data!"
                }).then((result) => {
                  if (result.isConfirmed) {
                    form.submit();
                    Swal.fire(
                      "Deleted!",
                      "Data Berhasil Dihapus",
                      "success"
                    );
                  }
                });
              });

              $("#frmKaryawan").submit(function(event) {
                event.preventDefault(); 

                var nik = $("#nik").val();
                var nama_lengkap = $("#nama_lengkap").val();
                var jabatan = $("#jabatan").val();
                var no_hp = $("#no_hp").val();
                var kode_dept = $("#frmKaryawan").find("#kode_dept").val();
                if (nik == "") {
                  Swal.fire({
                    title: 'Warning!',
                    text: 'Nik Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                  }).then(function() {
                    $("#nik").focus();
                  });
                  return false;
                } else if (nama_lengkap == "") {
                  Swal.fire({
                    title: 'Warning!',
                    text: 'Nama Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                  }).then(function() {
                    $("#nama_lengkap").focus();
                  });
                  return false;
                } else if (jabatan == "") {
                  Swal.fire({
                    title: 'Warning!',
                    text: 'Jabatan Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                  }).then(function() {
                    $("#jabatan").focus();
                  });
                  return false;
                } else if (no_hp == "") {
                  Swal.fire({
                    title: 'Warning!',
                    text: 'No.HP Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                  }).then(function() {
                    $("#no_hp").focus();
                  });
                  return false;
                } else if (kode_dept == "") {
                  Swal.fire({
                    title: 'Warning!',
                    text: 'Departemen Harus Diisi',
                    icon: 'warning',
                    confirmButtonText: 'Ok'
                  }).then(function() {
                    $("#kode_dept").focus();
                  });
                  return false;
                }
                this.submit();
              });
            });
        </script>
        @endpush