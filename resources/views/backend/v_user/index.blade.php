@extends('backend.v_layouts.app')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $sub }}<br><br>

                    <a href="/user/create" title="Tambah Data">
                        <span class="btn btn-primary">Tambah</span>
                    </a>
                </h5>
                <br>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Akses</th>
                                <th>Email</th>
                                <th>HP</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($index as $row)
                            <tr>
                                <td align="center"> {{ $loop->iteration }}</td>

                                <td> {{ $row->nama }} </td>
                                <td>
                                    @if ($row->is_admin == 1)
                                    Super Admin
                                    @else
                                    Administrator
                                    @endif
                                </td>
                                <td> {{ $row->email }} </td>
                                <td> {{ $row->hp }} </td>
                                <td align="center">
                                    <a href="{{ route('user.edit', $row->id) }}" title="Ubah Data">
                                        <span class="btn btn-cyan btn-sm text-white"><i class="fa fa-edit"></i>Ubah</span>
                                    </a>
                                    <form method="POST" action="{{ route('user.destroy', $row->id) }}" style="display: inline-block;">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Delete' data-konf-delete="{{ $row->nama }}"><i class="fa fa-trash"></i>Hapus</button></button>
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

@endsection