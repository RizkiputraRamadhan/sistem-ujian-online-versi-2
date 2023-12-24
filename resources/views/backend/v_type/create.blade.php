@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="/type" method="post" enctype="multipart/form-data" class="form-horizontal">
                @csrf

                <div class="card-body">
                    <h4 class="card-title">{{ $sub }}</h4>

                    <div class="form-group">
                        <label>Nama Type</label>
                        <input type="text" name="nama_type" value="{{ old('nama_type') }}" class="form-control @error('nama_type') is-invalid @enderror" placeholder="Masukkan Nama Type">
                        @error('nama_type')
                        <span class="invalid-feedback alert-danger" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>

                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button type="submit" class="btn btn-success text-white">
                            Simpan
                        </button>
                        <a href="{{ route('type.index') }}">
                            <button type="button" class="btn btn-danger">
                                Kembali
                            </button>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- template end-->
@endsection