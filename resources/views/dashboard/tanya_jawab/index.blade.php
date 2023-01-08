@extends('layouts.backend-dashboard.app')
@section('Dashboard')
@section('content')

<section class="content">
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title font-weight-bold">Data Forum</h5>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>ID USER</th>
                                    <th>Name</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Label</th>
                                    <th>Tanggal</th>
                                    <th>Dijawab Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $forum)
                                <tr>
                                    <td>{{$forum->id_forum}}</td>
                                    <td>{{$forum->id_users}}</td>
                                    <td>{{$forum->users->name}}</td>
                                    <td class="text-truncate" style="max-width: 150px;">{{$forum->teks}}</td>
                                    <td class="text-truncate" style="max-width: 150px;">{{$forum->jawaban}}</td>
                                    <td class="text-truncate" style="max-width: 150px;">@foreach ($forum->chip as $chip)
                                    <span class="badge badge-primary">{{$chip->label->label_definition}}</span>
                                    @endforeach</td>
                                   
                                    <td>{{$forum->created_at}}</td>
                                    <td>@if(is_null($forum->answered_by))
                                            
                                        @elseif($forum->answered_by == 0)
                                            <span class="badge badge-warning">Admin</span>
                                        @else
                                            <span class="badge badge-warning">Awardee</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('delete.tanya_jawab',$forum->id_forum) }}"type="button" class="btn btn-danger">Delete</a>
                                        @if (is_null($forum->jawaban))
                                        <a type="button" class="btn btn-info" href="{{ route('detail.tanya_jawab',$forum->id_forum) }}">Jawab</a>
                                        @else
                                        <a type="button" class="btn btn-info" href="{{ route('detail.tanya_jawab',$forum->id_forum) }}">Edit Jawaban</a>                                        @endif
                                    </td>
                                </tr>

                                
                                
                                @endforeach
                                
                            </tbody>
                            <tfoot>
                                <tr>
                                <th>ID</th>
                                    <th>ID USER</th>
                                    <th>Name</th>
                                    <th>Pertanyaan</th>
                                    <th>Jawaban</th>
                                    <th>Label</th>
                                    <th>Tanggal</th>
                                    <th>Dijawab Oleh</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
                <!-- The Modal -->


                <!-- /.container-fluid -->
</section>
@endsection
@section('extra_javascript')
@include('dashboard.javascript')
@endsection