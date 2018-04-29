@extends('layout.studio')
@section('header')
<link rel="stylesheet" href="{{asset('css/studio.css')}}"></link>
@endsection
@section('content')
<nav class="navbar navbar-default navbar-fixed-top studio-navbar">
	<div class="container-fluid">
		<div class="navbar-header studio-center-navbar">
			<select id="branch" class="studio-branch-list">
				<option>master</option>
			</select>
		</div>
		<ul class="nav navbar-nav navbar-right studio-center-navbar studio-right-navbar">
			<li><button>Connect</button></li>
		</ul>
	<div>
</nav>

<div class="row studio">
	<div class="col-md-3 studio-explorer">
		<h3>Explorer</h3>
		<hr />
		<ul class="list-group">
			<li class="studio-explorer-li"><button class="studio-explorer-button">.layout</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">.config</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">.branch</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">index.page</button></li>
			<li class="studio-explorer-li"><button class="studio-explorer-button">home.route</button></li>
		</ul>
	</div>
	<div class="col-md-7 studio-editor">
	<h3>.layout</h3>
	<hr />
		<div class="form-group">
			<label for="name" class="form-control">Name: </label>
			<div class="col-md-6">
				<input type="text" name="name" id="name" class="form-control">
			</div>
		</div>
		<hr />
		<div class="form-group">
			<label for="type" class="form-control">Type: </label>
			<div class="col-md-6">
				<input type="text" name="type" id="type" class="form-control">
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script src="{{asset('js/studio.js')}}"></script>
@endsection