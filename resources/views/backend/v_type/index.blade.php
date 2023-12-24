@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{$sub}} <br><br>
                    <a href="/type/create" title="Tambah data">
                        <button type="button" class="btn btn-primary">Tambah</button>
                    </a>
                </h5>
                <div class="table-responsive">
                    <table id="zero_config" class="table table-striped table-bordered">
                        <thead>
                            <tr align="center">
                                <th>No</th>
                                <th>type</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($type as $index => $row)
                            <tr>
                                <td align="center">{{ $index + 1 }}</td>
                                <td> {{$row->nama_type}} </td>
                                <td align="center">
                                    <a href="{{ route('type.edit', $row->id) }}" title="Ubah Data">
                                        <span class="btn btn-cyan btn-sm text-white"><i class="fa fa-edit"></i>Ubah</span>
                                    </a>
                                    <form method="POST" action="{{ route('type.destroy', $row->id) }}" style="display: inline-block;">
                                        @method('delete')
                                        @csrf
                                        <button type="button" class="btn btn-danger btn-sm show_confirm" data-toggle="tooltip" title='Delete' data-konf-delete="{{ $row->type }}"><i class="fa fa-trash"></i>Hapus</button></button>
                                    </form>
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