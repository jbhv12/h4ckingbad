@if (session()->has('flashDanger'))
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="alert alert-danger alert-dismissible fade in">
			        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			        <strong>{!! session()->get('flashDanger') !!}</strong>
			    </div>
			</div>
		</div>
	</div>
@endif

@if (session()->has('flashWarning'))
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="alert alert-warning alert-dismissible fade in">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Warning : </strong>{!! session()->get('flashWarning') !!}
				</div>	
			</div>
		</div>
	</div>
@endif

@if (session()->has('flashSuccess'))
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="alert alert-success alert-dismissible fade in">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>{!! session()->get('flashSuccess') !!}</strong>
				</div>	
			</div>
		</div>
	</div>
@endif

@if (session()->has('flashInfo'))
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2 text-center">
				<div class="alert alert-info alert-dismissible fade in">
				    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				    <strong>Info : </strong>{!! session()->get('flashInfo') !!}
				</div>	
			</div>
		</div>
	</div>
@endif

