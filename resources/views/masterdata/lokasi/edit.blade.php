@extends('adminlte::page')

@section('title', 'Data Lokasi')

@section('content_header')
    <h1 class="m-0 text-dark">Data Lokasi</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title"><strong>Edit Data Lokasi</strong></h3>
                </div>

                <div class="card-body">
                    @include('partials._error')

                    <form action="{{ route('lokasi.update', $lokasi->id) }}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="form-group row">
                            <label class="form-label col-sm-2">Nama Lokasi</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input type="text" name="nama_lokasi" placeholder="Contoh: Gudang A"
                                        class="form-control @error('nama_lokasi') is-invalid @enderror"
                                        value="{{ isset($lokasi) ? $lokasi->nama_lokasi : old('nama_lokasi') }}" required>
                                    @error('nama_lokasi')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-info" id="simpan">SIMPAN</button>
                            <a href="{{ route('lokasi.index') }}" class="btn btn-danger">BATAL</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
