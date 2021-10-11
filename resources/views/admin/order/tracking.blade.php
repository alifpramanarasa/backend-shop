@extends('layouts.app', ['tracking_number' => 'Tambah Resi Pengiriman'])

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="row">
        <div class="col-md-12">
            <div class="card border-0 shadow">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-truck"></i> TAMBAH RESI PENGIRIMAN</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.order.store-tracking',$invoice->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>NOMOR RESI</label>
                            <input type="text" name="tracking_number" value="{{ old('tracking_number',$invoice->tracking_number) }}" placeholder="Masukkan Nomor Resi"
                                class="form-control @error('tracking_number') is-invalid @enderror">

                            @error('tracking_number')
                            <div class="invalid-feedback" style="display: block">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>

                        <button class="btn btn-primary mr-1 btn-submit" type="submit"><i class="fa fa-paper-plane"></i>
                            SIMPAN</button>
                        <button class="btn btn-warning btn-reset" type="reset"><i class="fa fa-redo"></i> RESET</button>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
