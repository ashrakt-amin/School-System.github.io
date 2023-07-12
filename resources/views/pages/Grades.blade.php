@extends('layouts.master')

@section('css')
@toastr_css
@endsection

@section('title')
@stop


@section('page-header')
@endsection

@section('content')
<!-- row opened -->
<div class="row row-sm">
	<div class="col-xl-12">
		<div class="card">



			<div class="card-header pb-0">
				<div class="d-flex justify-content-between">

				</div>
			</div>
			<div class="card-body">
				<button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
					{{ trans('Grades_trans.add_Grade') }}
				</button>
				<br><br>

				@if(session()->has('success'))
				<div class="alert alert-primary" role="alert">
					{{session()->get('success')}}
				</div>
				@endif

				@if ($errors->any())
				<div class="alert alert-danger">
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif

				<div class="table-responsive">
					<table class="table text-md-nowrap" id="example1">
						<thead>
							<tr>
								<th class="wd-15p border-bottom-0">{{trans('Grades_trans.Name')}}</th>
								<th class="wd-15p border-bottom-0">{{trans('Grades_trans.Notes')}}</th>
								<th class="wd-20p border-bottom-0">{{trans('Grades_trans.Processes')}}</th>
							</tr>
						</thead>
						<tbody>
							@foreach($grades as $grade)
							<tr>
								<td>{{$grade->name}}</td>
								<td>{{$grade->notes}}</td>
								<td>
									<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#edit{{ $grade->id }}" title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
									<button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete{{ $grade->id }}" title="{{ trans('Grades_trans.Delete') }}"><i class="fa fa-trash"></i></button>
								</td>

							</tr>

							<!-- edit_modal_Grade -->
							<div class="modal fade" id="edit{{$grade->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
												{{ trans('Grades_trans.edit_Grade') }}
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">

										
											<!-- add_form -->
											<form action="{{ route('grades.update',$grade->id) }}" method="post">
												{{ method_field('patch') }}
												@csrf

												<div class="row">
													<div class="col">
														<label for="Name" class="mr-sm-2">{{ trans('Grades_trans.Name') }}
															:</label>
														<input id="Name" type="text" name="en_name" class="form-control" value="{{$grade->getTranslation('name','en')}}" required>
													</div>
													<div class="col">
														<label for="Name" class="mr-sm-2">{{ trans('Grades_trans.Name') }}
															:</label>
														<input id="Name" type="text" name="ar_name" class="form-control" value="{{$grade->getTranslation('name','ar')}}" required>
													</div>

												</div>
												<div class="form-group">
													<label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
														:</label>
													<textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3">{{ $grade->notes }}</textarea>
												</div>
												<br><br>

												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
													<button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
												</div>
											</form>

										</div>
									</div>
								</div>
							</div>

							<!-- delete_modal_Grade -->
							<div class="modal fade" id="delete{{ $grade->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
												{{ trans('Grades_trans.delete_Grade') }}
											</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form action="{{ route('grades.destroy',$grade->id) }}" method="post">
												{{ method_field('Delete') }}
												@csrf
												{{ trans('Grades_trans.Warning_Grade') }}


												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
													<button type="submit" class="btn btn-danger">{{ trans('Grades_trans.submit') }}</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>


							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--/div-->



	<!-- add_modal_Grade -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
						{{ trans('Grades_trans.add_Grade') }}
					</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<!-- add_form -->
					<form action="{{ route('grades.store') }}" method="POST">
						@csrf
						<div class="row">

							<div class="col">
								<label for="Name" class="mr-sm-2">{{ trans('Grades_trans.stage_name_en') }}
									:</label>
								<input id="Name" type="text" name="en_name" class="form-control">
							</div>
							<div class="col">
								<label for="Name" class="mr-sm-2">{{ trans('Grades_trans.stage_name_ar') }}
									:</label>
								<input id="Name" type="text" name="ar_name" class="form-control">
							</div>

						</div>
						<div class="form-group">
							<label for="exampleFormControlTextarea1">{{ trans('Grades_trans.Notes') }}
								:</label>
							<textarea class="form-control" name="notes" id="exampleFormControlTextarea1" rows="3"></textarea>
						</div>
						<br><br>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
					<button type="submit" class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
				</div>
				</form>

			</div>
		</div>
	</div>

</div>
<!-- /row -->

@endsection

@section('js')
@toastr_js
@toastr_render
@endsection