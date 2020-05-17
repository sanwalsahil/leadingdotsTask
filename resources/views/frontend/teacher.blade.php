@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Meetings Scheduled
                        <a href="{{url('/addMeeting')}}" class="btn btn-primary float-right">Schedule New Meetings</a>
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row">
                        <div class="col-md-12">
                            <x-Teachermeetingtable :meetings="$meetings"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
