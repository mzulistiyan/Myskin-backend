@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <form method="POST" action="{{ route('update.user',$data->id) }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <input type="hidden" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{$data->id}}">
                        <input type="hidden" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{$data->password}}">
                        <div class="mb-3">
                            <label for="" class="form-label">Name</label>
                            <input type="teks" class="form-control" id="name" name="name" aria-describedby="emailHelp" value="{{$data->name}}">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" disabled value="{{$data->email}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Gender</label>
                            <input type="teks" class="form-control" id="gender" value="{{$data->gender}}">

                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">No Handphone</label>
                            <input type="teks" class="form-control" id="telp" name="telp" value="{{$data->telp}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tanggal Lahir</label>
                            <input type="teks" class="form-control" id="tanggal_lahir" name="tanggal_lahir" value="{{$data->tanggal_lahir}}">

                        </div>
                    </div>
                    <div class="col">
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Kota Asal</label>
                            <input type="teks" class="form-control" id="kota_asal" name="kota_asal" value="{{$data->kota_asal}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Pendidikan Terakhir</label>
                            <input type="teks" class="form-control" id="pendidikan_terakhir" name="pendidikan_terakhir" value="{{$data->pendidikan_terakhir}}">

                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Institute</label>
                            <input type="teks" class="form-control" id="institute" name="institue" value="{{$data->institute}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Jurusan</label>
                            <input type="teks" class="form-control" id="jurusan" name="jurusan" value="{{$data->jurusan}}">
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Aksi</label>
                            <button type="submit" class="btn btn-info btn-md form-control">Edit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>

@endsection
@section('extra_javascript')
@include('dashboard.javascript')
@endsection