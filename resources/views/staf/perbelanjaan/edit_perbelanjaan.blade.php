@extends('backend.layouts.app', ['title' => 'Kewangan'])

@section('content-header')
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Kewangan</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a
                            href="{{ Auth::user()->role == 1
                                ? url('admin-home')
                                : (Auth::user()->role == 2
                                    ? url('staf-home')
                                    : url('user-home')) }}">Halaman
                            Utama</a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{ url('admin-expense') }}">Perbelanjaan</a></li>
                    <li class="breadcrumb-item active">{{ $expense->id_trax_perbelanjaan }}</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">

                <!-- /.card-header -->
                <div class="card">
                    <div class="card-header d-flex align-items-center">
                        <div class="mr-auto">
                            <h5>Edit Perbelanjaan</h5>
                        </div>
                        <div class=""> <a href="{{ url('admin-expense') }}" class="btn btn-primary">
                                <i class="nav-icon fas fa-arrow-circle-left"></i> Kembali</a></div>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form action="{{ route('expense.update', ['expense' => $expense->id]) }}" method="POST"
                        enctype="multipart/form-data">
                        @method('PATCH')
                        @csrf


                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="id">ID Transaksi</label>
                                        <input class="form-control" type="text"
                                            value="{{ $expense->id_trax_perbelanjaan }}" aria-label="Disabled input example"
                                            disabled readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="kategori">Kategori</label>
                                        <select
                                            class="form-control remove-error-on-input @error('kategori') is-invalid @enderror"
                                            name="kategori" id="kategori">
                                            <option value="">Sila Pilih Kategori</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ (old('kategori') ?? $expense->id_kategori) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->nama }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>




                                    <div class="form-group">
                                        <label for="catatan">Catatan</label>
                                        <input type="text"
                                            class="form-control remove-error-on-input @error('catatan') is-invalid @enderror"
                                            id="catatan" name="catatan" value="{{ old('catatan') ?? $expense->catatan }}">
                                    </div>

                                </div>
                                <div class="col-md-6">


                                    <div class="form-group">
                                        <label for="tarikh">Tarikh</label>
                                        <input type="date"
                                            class="form-control remove-error-on-input @error('tarikh') is-invalid @enderror"
                                            id="tarikh" name="tarikh" value="{{ old('tarikh') ?? $expense->tarikh }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="jumlah">Jumlah Pendapatan</label>
                                        <div class="input-group">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    RM
                                                </div>
                                            </div>
                                            <input type="number" step=0.01
                                                class="form-control remove-error-on-input @error('jumlah') is-invalid @enderror"
                                                id="jumlah" name="jumlah"
                                                value="{{ old('jumlah') ?? $expense->jumlah_tbj }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="resit">Resit/Invois/Bukti Perbelanjaan</label>
                                        <div class="row">
                                            @if ($expense->resit != null)
                                                <div class="col-md-6"> <input type="file" name="resit"
                                                        value="{{ old('resit') }}"
                                                        class="form-control remove-error-on-input"
                                                        placeholder="Sila Pilih Resit" id="resit">
                                                </div>
                                                <div class="col-md-6"> <a
                                                        href="{{ asset('assets/resit_perbelanjaan/' . $expense->resit) }}"
                                                        class="btn-link text-secondary" target="_blank"><i
                                                            class="nav-icon fas fa-file"></i>
                                                        {{ $expense->resit }}</a>
                                                </div>
                                            @else
                                                <div class="col-md-12"> <input type="file" name="resit"
                                                        value="{{ old('resit') }}"
                                                        class="form-control remove-error-on-input"
                                                        placeholder="Sila Pilih Resit" id="resit">
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            <button type="submit" class="btn btn-success"> <i class="nav-icon fas fa-edit"></i>
                                Kemaksini</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@push('css')
    <style>
        .btn-red {
            background-color: blue;
            color: white;
        }
    </style>
@endpush


@push('js')
    <script>
        $(function() {
            bsCustomFileInput.init();
        });
    </script>
@endpush
