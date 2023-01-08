@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <form method="POST" action="{{ route('update.powered',$data->id_poweredBy) }}">
        @csrf
        <div class="card">
            <div class="card-body">
                <div class="mb-3">
                    <label for="" class="form-label">Teks</label>
                    <input type="teks" class="form-control" id="teks" name="teks" value="{{$data->teks}}">
                    <label for="" class="form-label">Link</label>
                    <input type="link" class="form-control" id="link" name="link" value="{{$data->link}}">

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