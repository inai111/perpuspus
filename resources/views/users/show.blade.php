@extends('layouts.index')

@section('content')
    @include('layouts.navbar')
    <div class="container-lg">
        <div class="mx-auto pt-4 mt-4">

            <div class="mb-3">
                <h3>Member Detail</h3>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-lg-10 mb-3">
                        <div class="card rounded shadow">
                            <div class="card-body">
                                <div class="d-flex flex-column" style="height: 200px">
                                    <h1>{{$member->name}}</h1>
                                    <div>{{$member->email}}</div>
                                    <div class="text-muted">{{$member->role->name}}</div>
                                    <div class="text-muted mt-auto">Member since {{date('D, d-F-Y',strtotime($member->created_at))}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
