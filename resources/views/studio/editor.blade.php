@extends('layout.studio')
@section('header')
<link rel="stylesheet" href="{{asset('css/studio.css')}}"></link>
<script src="{{asset('js/colors.js')}}"></script>
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
			<li><button type="button" data-toggle="modal" data-target="#connectModal">Connect</button></li>
		</ul>
	<div>
</nav>

<!-- Connect Modal -->
<div id="connectModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Conect</h4>
      </div>
      <div class="modal-body">
		<div class="form-group">
			<label for="panelID" class="control-label col-sm-2">Panel ID: </label>
			<div class="col-sm-10">
				<input type="text" name="panelID" id="panelID" class="form-control" placeholder="EX: XXXXXXXXXXX">
			</div>
		</div>
		<br>
		<div class="form-group">
			<button type="button" class="btn btn-default" data-dismiss="modal">Connect</button>
		</div>
		<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="row studio">
	<div class="col-md-3 studio-explorer">
		<h3>Explorer</h3>
		<hr />
		<ul id="explorer" class="list-group">
			<li class="studio-explorer-li"><button class="studio-explorer-button">.test</button></li>
		</ul>
	</div>
	<div class="col-md-7 studio-editor">
		<h3 id="filename"></h3>
		<hr>
		<div id="editors">
			<div id="studio-editor-dashboard"></div>
			<div id="studio-editor-console">
				<div id="console" class="studio-editor-console">
				</div>
				<br>
				<div class="form-group">
					<label for="command" class="control-label col-sm-1">Label: </label>
					<div class="col-sm-11">
						<input type="text" name="command" id="command" class="form-control" placeholder="Ex: Maintenance -info" require autoFocus>
					</div>
				</div>
				<br>
				<div class="form-group">
					<button type="button" class="btn btn-default form-control">Execute</button>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
@section('footer')
<script src="{{asset('js/studio.js')}}"></script>
@endsection