@extends('backend.v_layouts.app')
@section('content')
    <!-- template -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h5 type="text" class="badge badge-success card-title">{{ $sub }}</h5>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5 type="text" class="card-title">Akun {{ $sub }}</h5>
                            <hr>
                            <div class="ml-3">
                                <p>Nama : {{ $siswa->nama }}</p>
                                <p>Email : {{ $siswa->email }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 type="text" class="card-title">Profil {{ $sub }}</h5>
                            <hr>
                            @if (!$profil)
                                <h5 type="text" class="badge badge-danger card-title"> belum melengkapi data</h5>
                            @else
                                <div class="ml-3">
                                    <div class="col-lg-3 col-md-6">
                                        <div class="card">
                                            <div class="el-card-item">
                                                <div class="el-card-avatar el-overlay-1"> <img class="rounded-lg"
                                                        width=" 200px" src="{{ asset('storage/siswa/' . $profil->image) }}"
                                                        alt="user" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p>Nama : {{ $profil->name }}</p>
                                    <p>Kelas : {{ $profil->kelas }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 type="text" class="card-title">Histori Ujian {{ $sub }}</h5>
                            <hr>
                            @if (!$histori)
                                <h5 type="text" class="badge badge-danger card-title"> belum ada data histori ujian</h5>
                            @else
                                <div class="ml-3">
                                    <div class="table-responsive">
                                        <table id="zero_config" class="table-striped table-bordered table">
                                            <thead>
                                                <tr align="center">
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Email</th>
                                                    <th>Category</th>
                                                    <th>Soal Benar</th>
                                                    <th>Soal Salah</th>
                                                    <th>Jumlah Soal</th>
                                                    <th>Keterangan</th>
                                                    <th>Selesai Mengerjakan</th>
                                                </tr>
                                            <tbody>
                                                @foreach ($histori as $index => $row)
                                                    <tr>
                                                        <td align="center">{{ $index + 1 }}</td>
                                                        <td> {{ $row->user->nama }} </td>
                                                        <td> {{ $row->user->email }} </td>
                                                        <td class="text-success font-bold"> {{ $row->category->name }} </td>
                                                        <td> {{ $row->true }} </td>
                                                        <td> {{ $row->false }} </td>
                                                        <td> {{ $row->false + $row->true }} </td>
                                                        <td> {{ $row->cheat }} </td>
                                                        <td> {{ $row->updated_at }} </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- template end-->
@endsection
