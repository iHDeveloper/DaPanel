@extends('layout.studio')
@section('header')
<link rel="stylesheet" href="{{asset('css/studio.css')}}"></link>
@endsection
@section('content')
<nav class="navbar navbar-default navbar-fixed-top studio-navbar">
	<div class="container-fluid">
		<div class="navbar-header studio-center-navbar">
			<select id="branch">
				<option><master></option>
			</select>
		</div>
		<ul class="nav navbar-nav navbar-right studio-center-navbar studio-right-navbar">
			<li><button>Connect</button></li>
		</ul>
	<div>
</nav>

<div class="row">
	<div class="col-md-4">
		<ul class="list-group">
			<li><button>.layout</button></li>
			<li><button>.config</button></li>
			<li><button>.branch</button></li>
			<li><button>index.page</button></li>
			<li><button>home.route</button></li>
		</ul>
	</div>
	<div class="col-md-6">
	</div>
</div>
@endsection
@section('footer')
<script src="{{asset('js/studio.js')}}"></script>
@endsection