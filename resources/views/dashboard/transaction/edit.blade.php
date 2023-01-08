@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <form method="POST" action="{{ route('update.transaksi',$data->id)}}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                <label for="category" class="form-label">List Dokter Tersedia</label>
                <select class="form-control" name="id_dokter" id="category">
                            <option hidden>Pilih Dokter</option>
                            @foreach ($dokter as $forum)
                            <option value="{{$forum->id_dokter}}">{{$forum->nama_dokter}}</option>
                            @endforeach
                </select>
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