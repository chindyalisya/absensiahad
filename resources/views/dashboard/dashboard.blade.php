@extends('layouts.presensi')
@section('content')
<style>
    .logout {
        position: absolute;
        color white;
        font-size: 30px;
        text-decoration: none;
        right: 8px;
    }

    .logout:hover {
        color: white;
    }
    
     #user-name-container {
    position: relative;
    font-size: 1rem;
    height: 2rem; 
    width: 100%; 
    }
    
    #user-name, #user-department {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        opacity: 0;
        white-space: nowrap; 
        transition: opacity 0.5s ease-in-out;
    }
    
    .typing {
        opacity: 1;
    }
    </style>
        <div class="section" id="user-section">
    <a href="/proseslogout" class="logout">
        <ion-icon name="exit-outline"></ion-icon>
    </a>
    <div id="user-detail">
        <div class="avatar">
            @if(!empty(Auth::guard('karyawan')->user()->foto))
            @php
            $path = Storage::url('uploads/karyawan/'.Auth::guard('karyawan')->user()->foto);
            @endphp
            <img src="{{ url($path) }}" alt="avatar" class="imaged w65" style="height: 70px">
            @else
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w10 rounded" style="width: 60px; height: 60px;">
            @endif
        </div>
        <div id="user-info">
        <div id="user-name-container">
            <h2 id="user-name"></h2>
            <h2 id="user-department"></h2>
        </div>
        <br>
        <br>
            <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
        </div>
    </div>
</div>

        <div class="section" id="menu-section">
            <div class="card">
                <div class="card-body text-center">
                    <div class="list-menu">
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/editprofile" class="green" style="font-size: 40px;">
                                    <ion-icon name="person-sharp"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Profil</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/presensi/izin" class="danger" style="font-size: 40px;">
                                    <ion-icon name="calendar-number"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Cuti</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="/presensi/histori" class="warning" style="font-size: 40px;">
                                    <ion-icon name="document-text"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                <span class="text-center">Histori</span>
                            </div>
                        </div>
                        <div class="item-menu text-center">
                            <div class="menu-icon">
                                <a href="" class="orange" style="font-size: 40px;">
                                    <ion-icon name="location"></ion-icon>
                                </a>
                            </div>
                            <div class="menu-name">
                                Lokasi
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section mt-2" id="presence-section">
            <div class="todaypresence">
                <div class="row">
                    <div class="col-12">
                        <div class="card gradasigreen">
                            <div class="card-body">
                                <div class="presencecontent">
                                    <div class="iconpresence">
                                       @if ($presensihariini != null)
                                       @php
                                        $path = Storage::url('uploads/absensi/'.$presensihariini->foto_in);
                                       @endphp
                                       <img src="{{ url($path) }}" alt="" class="imaged w48" style="height: 45px">
                                       @else
                                       <ion-icon name="camera"></ion-icon>
                                       @endif
                                    </div>
                                    <div class="presencedetail">
                                        <h4 class="presencetitle">Absen</h4>
                                        <span>{{ $presensihariini != null ? $presensihariini -> jam_in : 'Belum Absen' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            <div class="rekappresensi">
                <h3>Rekap Presensi Bulan {{ $namabulan[$bulanini] }} Tahun {{ $tahunini }}</h3>
                <div class="row">
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text center" style=" 16px 12px !important; line-height:0.8rem">
                                <span class ="badge bg-danger" style="position: absolute; top:3px; right:10p; font-size:0.6rem;
                                z-index:999">{{ $rekappresensi->jmlhadir }}</span>
                                <ion-icon name="accessibility-outline" style="font-size:  1.6rem;"  class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Hadir</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text center" style=" 16px 12px !important; line-height:0.8rem">
                                <span class ="badge bg-danger" style="position: absolute; top:3px; right:10p; font-size:0.6rem;
                                z-index:999">{{ $rekapizin->jmlizin }}</span>
                                <ion-icon name="newspaper-outline" style="font-size:  1.6rem;"  class="text-success mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Izin</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text center" style=" 16px 12px !important; line-height:0.8rem">
                                <span class ="badge bg-danger" style="position: absolute; top:3px; right:10p; font-size:0.6rem;
                                z-index:999">{{ $rekapizin->jmlsakit }}</span>
                                <ion-icon name="medkit-outline" style="font-size:  1.6rem;"  class="text-warning mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Sakit</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body text center" style=" 16px 12px !important; line-height:0.8rem">
                                <span class ="badge bg-danger" style="position: absolute; top:3px; right:10p; font-size:0.6rem;
                                z-index:999">{{ $rekappresensi->jmlterlambat }}</span>
                                <ion-icon name="alarm-outline" style="font-size:  1.6rem;"  class="text-danger mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8rem; font-weight:500">Telat</span>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="presencetab mt-2">
                <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                    <ul class="nav nav-tabs style1" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#home" role="tab">
                                Bulan Ini
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab">
                                Leaderboard
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content mt-2" style="margin-bottom:100px;">
                    <div class="tab-pane fade show active" id="home" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($historibulanini as $d)
                            @php
                            $path = Storage::url('uploads/absensi/'.$d->foto_in);
                            @endphp
                            <li>
                                <div class="item">
                                    <div class="icon-box bg-primary">
                                    <ion-icon name="finger-print-outline"></ion-icon>
                                    </div>
                                    <div class="in">
                                        <div>{{ date("d-m-Y",strtotime($d->tgl_presensi)) }}</div>
                                        <span class="badge  {{ $d->jam_in < "07:30" ?  "bg-success" : "bg-danger" }}">
                                                    {{ $d->jam_in }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-pane fade" id="profile" role="tabpanel">
                        <ul class="listview image-listview">
                            @foreach ($leaderboard as $d)
                            <li>
                                <div class="item">
                                    <img src="assets/img/sample/avatar/avatar1.jpg" alt="image" class="image">
                                    <div class="in">
                                        <div>
                                            <b>{{ $d->nama_lengkap }}</b><br>
                                            <small class="text-muted">{{ $d->jabatan }}</small>
                                        </div>
                                        <span class="badge  {{ $d->jam_in < "07:30" ?  "bg-success" : "bg-danger" }}">
                                                    {{ $d->jam_in }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            
                        </ul>
                    </div>

                </div>
            </div>
        </div>
        
        <script>
        const userNameElement = document.getElementById('user-name');
        const userDepartmentElement = document.getElementById('user-department');
        
        const nameText = '{{ Auth::guard('karyawan')->user()->nama_lengkap }}';
        const departmentText = '{{ Auth::guard('karyawan')->user()->departemen }}';
        
        let typingInterval;
        let deleteInterval;
        
        function typeText(element, text, speed, callback) {
            let index = 0;
            element.textContent = '';
            element.style.opacity = 1;  
            typingInterval = setInterval(function() {
                if (index < text.length) {
                    element.textContent += text.charAt(index);
                    index++;
                } else {
                    clearInterval(typingInterval);
                    if (callback) callback();
                }
            }, speed);
        }
        
        function deleteText(element, speed, callback) {
            let currentText = element.textContent;
            let index = currentText.length;
            deleteInterval = setInterval(function() {
                if (index > 0) {
                    element.textContent = currentText.substring(0, index - 1);
                    index--;
                } else {
                    clearInterval(deleteInterval);
                    if (callback) callback();
                }
            }, speed);
        }
        
        function startTyping() {
            typeText(userNameElement, nameText, 100, function() {
                setTimeout(function() {
                    deleteText(userNameElement, 50, function() {
                        typeText(userDepartmentElement, departmentText, 100, function() {
                            setTimeout(function() {
                                deleteText(userDepartmentElement, 50, function() {
                                    setTimeout(startTyping, 1000);
                                });
                            }, 2000); 
                        });
                    });
                }, 2000); 
            });
        }
        
        window.onload = function() {
            setTimeout(startTyping, 500);
        };
</script>
@endsection