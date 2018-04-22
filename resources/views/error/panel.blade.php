@extends('layout.error')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-danger">
                <div class="panel-heading">Error Page</div>

                <div class="panel-body">
                    <h1><span class="label label-danger"> {{ $code }} - {{ $title }} </span></h1>
                    <hr>
                    <h4 class="text-danger">{{ $message }}</h4>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection