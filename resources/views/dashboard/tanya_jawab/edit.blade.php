@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <form method="POST" action="{{route('update.tanya_jawab',$data->id_forum)}}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label">Jawaban</label>
                    <input type="teks" class="form-control" id="jawaban" name="jawaban" value="{{$data->jawaban}}">

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