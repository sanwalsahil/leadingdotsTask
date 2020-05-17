@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Meetings Scheduled

                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <x-Parentmeetingtable :meetings="$meetings" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
