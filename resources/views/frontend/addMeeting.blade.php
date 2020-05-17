@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Schedule A Meeting') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ url('/createMeeting') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Meeting Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"  required >

                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Meeting Date') }}</label>

                                <div class="col-md-6">
                                    <input placeholder="Meeting Date" id="datepicker" type="text" class="form-control @error('date') is-invalid @enderror" name="date"  required >

                                    @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label  class="col-md-4 col-form-label text-md-right">{{ __('Meeting With') }}</label>

                                <div class="col-md-6">
                                    @if($parents->count() > 0)
                                        @foreach($parents as $parent)
                                        <div class="form-check">
                                            <input name="parent[]" class="form-check-input" type="checkbox" value="{{$parent->id}}" id="defaultCheck1">
                                            <label class="form-check-label" for="defaultCheck1">
                                                {{$parent->name}}
                                            </label>
                                        </div>
                                        @endforeach
                                    @else
                                        <div class="form-check">
                                            <span class="btn btn-danger">There Are No Teachers To Schedule Meetings With</span>
                                        </div>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    @if($parents->count() > 0)
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Fix Meeting') }}
                                    </button>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $( function() {
            $( "#datepicker" ).datepicker();
        } );
    </script>
@endsection
