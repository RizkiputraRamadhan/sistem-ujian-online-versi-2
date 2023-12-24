@extends('backend.v_layouts.app')
@section('content')
<!-- template -->

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <form action="/berita" method="post" class="form-horizontal">
                @csrf

                <div class="card-body">
                    <h4 class="card-title">{{ $sub }}</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal</label>
                                <input type="datetime-local" name="tanggal" value="{{ old('tanggal') }}" class="form-control @error('tanggal') is-invalid @enderror" placeholder="Masukkan Tanggal">
                                @error('tanggal')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Judul</label>
                                <input type="text" name="judul" value="{{ old('judul') }}" class="form-control @error('judul') is-invalid @enderror" placeholder="Masukkan Judul Berita">
                                @error('judul')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kategori</label><br>
                                <select class="form-control @error('kategori_id') is-invalid @enderror" name="kategori_id">
                                    <option value="" selected>--Pilih Kategori--</option>
                                    @foreach ($kategori as $row)
                                    <option value="{{ $row->id }}" @if(old('kategori_id')==$row->id) selected @endif>{{ $row->nama_kategori }}</option>
                                    @endforeach
                                </select>
                                @error('kategori_id')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                                <p></p>
                            </div>

                            <div class="form-group">
                                <label>Detail</label>
                                    <textarea name="detail" id="ckeditor" style="height: 300px" class="form-control @error('detail') is-invalid @enderror" placeholder="Masukkan Isi Berita">{{ old('detail') }}</textarea>
                                @error('detail')
                                <span class="invalid-feedback alert-danger" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>

                    </div>




                </div>
                <div class="border-top">
                    <div class="card-body">
                        <button kategori="submit" class="btn btn-success text-white">
                            Simpan
                        </button>
                        <a href="{{ route('kategori.index') }}">
                            <button kategori="button" class="btn btn-danger">
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