@extends('layout.studio')
@section('content')
<style src="{{asset('css/studio.css')}}"></style>
<nav class="navbar navbar-default">
	<div class="container-fluid">
		<div class="navbar-header">
			<select id="branch">
				<option>"<master>"</option>
			</select>
		</div>
		<ul class="nav navbar-nav navbar-right">
			<li><a><span class="label label-success">Connect</span></a></li>
		</ul>
	<div>
</nav>

<div class="row">
	<div class="col-md-4">
		
	</div>
	<div class="col-md-6">
	</div>
</div>
@endsection
@section('footer')
<script src="{{asset('js/studio.js')}}"></script>
@endsection