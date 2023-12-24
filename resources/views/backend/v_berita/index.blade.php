@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$sub}} <br><br>
                    <a href="/berita/create" title="Tambah data">
                        <button kategori="button" class="btn btn-primary">Tambah</button>
                    </a>
                </h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Status</th>
                                <th>Kategori</th>
                                <th>Tanggal</th>
                                <th>Judul</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($berita as $index => $row)
                            <tr>
                                <td align="center">{{ $index + 1 }}</td>
                                <td align="center"> @if ($row->status == 1)
                                    <div class="badge badge-success">Aktif</div>
                                    @else
                                    <div class="badge badge-secondary">Tidak Aktif</div>
                                    @endif </td>
                                <td align="center"> {{ $row->kategori->nama_kategori }} </td>
                                <td align="center"> {{ $row->tanggal }} </td>
                                <td> {{ $row->judul }} </td>
                                <td align="center">
                                    <a href="{{ route('berita.edit', $row->id) }}" title="Ubah Data">
                                        <span class="btn btn-cyan btn-sm text-white"><i class="fa fa-edit"></i>Ubah</span>
                                    </a>
                                    <form method="POST" action="{{ route('berita.destroy', $row->id) }}" style="display: inline-block;">
                                        @method('delete')
                                        @csrf
                                        <button kategori="button" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Delete' data-konf-delete="{{ $row->judul }}"><i class="fa fa-trash"></i>Hapus</button></button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- template end-->
@endsection