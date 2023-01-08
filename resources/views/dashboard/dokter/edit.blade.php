@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <form method="POST" action="{{ route('update.dokter',$data->id_dokter) }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label">Name</label>
                    <input type="teks" class="form-control" id="nama_dokter" name="nama_dokter" value="{{$data->nama_dokter}}">

                    <label for="" class="form-label">No KTP</label>
                    <input type="teks" class="form-control" id="NIK" name="NIK" value="{{$data->NIK}}">

                    <label for="" class="form-label">No STR</label>
                    <input type="teks" class="form-control" id="no_STR" name="no_STR" value="{{$data->no_STR}}">

                    <label for="" class="form-label">No SIP</label>
                    <input type="teks" class="form-control" id="no_SIP" name="no_SIP" value="{{$data->no_SIP}}">

                    <label for="" class="form-label">Rumah Sakit</label>
                    <input type="teks" class="form-control" id="rumah_sakit" name="rumah_sakit" value="{{$data->rumah_sakit}}">

                </div>
                <button type="submit" id="btnSave" class="btn btn-primary ">Submit</button>
            </div>
        </div>
    </form>
</section>

@endsection
@section('extra_javascript')
@include('dashboard.javascript')
@endsection