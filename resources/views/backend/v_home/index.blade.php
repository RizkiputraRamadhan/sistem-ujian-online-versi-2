@extends('backend.v_layouts.app')
@section('content')
<!-- template -->
@if ( auth()->user()->typeuser == 1 )
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$sub}}</h5>
                <div class="table-responsive">
                    Selamat datang hi, <b>{{ auth()->user()->nama }}</b> 
                    <p class="mt-2">
                         
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@else
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$sub}}</h5>
                <div class="table-responsive">
                    Selamat datang hi, <b>{{ auth()->user()->nama }}</b> 
                    <p class="mt-2">
                       <b>Peraturan Ujian :</b>
                       <p>
                        1. Peserta tidak boleh meninggalkan ujian ketika sudah memulai ujian. <br>
                        2. Peserta memasuki ujian tepat pada waktunya. <br>
                        3. Peserta tidak boleh menengok kanan kiri atau bertanya kepada temannya. <br>
                        4. Peserta tidak boleh membuka tab baru pada browser dan membuka aplikasi lain selain halaman ujian. <br>
                        5. Jika Peserta melanggar pasal 1 dan 4 maka secara otomatis ujian <b>GAGAL/KELUAR UJIAN DENGAN SENDIRINYA.</b>. <br>
                          
                       </p>
                    </p>
                </div>
            </div>
        </div>
    </div>

    @if ($profil)
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><b>PROFIL {{ auth()->user()->nama }}:</b></h5>
                <div class="table-responsive">

                        <div class="card-body">
                            <div class="form-group">
                                <img src="{{asset('storage/siswa/'.$profil->image)}}" class="foto-preview mb-2 rounded" style= "width: 20%;" alt="Image Preview">
                            </div>
                            <div class="form-group">
                                <p class="mt-2">
                                    <b>NAMA :</b>
                                    <input class="ml-2" disabled ="text" value="{{$profil->kelas}}">
                                 </p>
                                <p class="mt-2">
                                    <b>EMAIL :</b>
                                    <input class="ml-2 w-25" disabled ="text" value="{{auth()->user()->email}}">
                                 </p>
                                <p class="mt-2">
                                    <b>KELAS :</b> 
                                    <input class="ml-2" disabled ="text" value="{{$profil->kelas}}">
                                 </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title"><b>Lengkapi Profil Anda :</b></h5>
                <div class="table-responsive">
                    <form action="/siswa/profil/store" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label for="image">Foto background merah/biru</label>
                                <input type="file" name="image" id="image" class="form-control" onchange="previewFoto()">
                            </div>

                            <img id="imagePreview" class="foto-preview mb-2" style="display: none; width: 30%;" alt="Image Preview">

                            <div class="form-group">
                                <label>Nama Siswa</label>
                                <input disabled type="text" name="name" value="{{ auth()->user()->nama }}" class="form-control @error('name') is-invalid @enderror" placeholder="Masukkan Nama Lengkap">
                                @error('name')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kelas</label>
                                <input type="text" name="kelas" value="{{ old('kelas') }}" class="form-control @error('kelas') is-invalid @enderror" placeholder="Masukkan kelas">
                                @error('kelas')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                           
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
<!-- template end-->
@endif

@endsection