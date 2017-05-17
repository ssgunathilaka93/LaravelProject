@extends('backpack::layout')

@section('content')
<div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Transaction for : {{json_decode($data1[0])->auth_account->mobile}}</div>
                </div>
                <div class="box-body">

						@foreach($data3 as $row)
						<div class="panel panel-default">
							<div class="panel-body">
								<div class="form-group">
									<div class="col-md-6 col-md-offset-2">
										<label class="control-label">Client No</label>
										<input type="text" class="form-control" value="{{$row->client}}" readonly>
										
										<label class="control-label">Total Amount</label>
										<input type="text" class="form-control" value="{{$row->Tot_amount}}" readonly>
										
										<label class="control-label">Last Charging Date</label>
										<input type="text" class="form-control" value="{{$row->last_charge}}" readonly>
									</div>
								</div>
							</div>
						</div>
						@endforeach
						
                </div>
            </div>
        </div>
    </div>
@endsection


@section('after_styles')
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/crud.css') }}">
	<link rel="stylesheet" href="{{ asset('vendor/backpack/crud/css/show.css') }}">
@endsection

@section('after_scripts')
	<script src="{{ asset('vendor/backpack/crud/js/crud.js') }}"></script>
	<script src="{{ asset('vendor/backpack/crud/js/show.js') }}"></script>
@endsection