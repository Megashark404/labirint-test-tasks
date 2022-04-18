@extends('layout')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-5">
			<h1>Add news</h1>
			<form action="/store" method="post">
				{{csrf_field()}}
				<div class="form-control">
					<div>
						<label class="form-label">Title</label>
						<input class="form-control" type="text" name="title">
					</div>
		
					<div>
						<label class="form-label">Teaser</label>
						<input class="form-control" type="text" name="teaser">
					</div>

					<div>
						<label class="form-label">Text</label>
						<input class="form-control" type="textare" name="text" cols="30" rows="10">
					</div>

					<div>
						<label class="form-label">Tags</label>
						<input class="form-control" type="text" name="tags">
					</div>
					
				</div>
				
				<button type="submit" class="mt-2 btn btn-success">Submit</button>
			</form>
		</div>
	</div>
</div>
@endsection
