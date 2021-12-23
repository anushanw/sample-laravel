@extends('layouts.v5.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card card-custom">
				<div class="card-body">
					<table class="table table-striped table-bordered table-hover kt-table kt-table--head-bg-primary" id="customerContractsTable">
						<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Customer name</th>
							<th>Category</th>
							<th class="text-center">Start date</th>
							<th class="text-center">Last Renewed date</th>
							<th class="text-center">End date</th>
							<th class="text-center">Status</th>
						</tr>
						</thead>

						@foreach($contracts as $contract)
							<tr>
								<td><a href='/contracts/customers/{{ $contract->_id }}'>{{ $contract->customID }}</a></td>
								<td><a href='/contracts/customers/{{ $contract->_id }}'>{{ $contract->name }}</a></td>
								<td><a href='/crm/customers/{{ $contract->customer->_id }}'>{{ $contract->customer->name }}</a></td>
								<td></td>
								<td class="text-center">{{ Carbon::parse($contract->start_date)->format('Y-m-d') }}</td>
								<td class="text-center">{{ Carbon::parse($contract->last_renewed_date)->format('Y-m-d') }}</td>
								<td class="text-center">{{ Carbon::parse($contract->end_date)->format('Y-m-d') }}</td>
								<td class="text-center"></td>
							</tr>
						@endforeach
					</table>
				</div>
			</div>
		</div>
	</div>
@stop

@section('pagelevelscripts')
	<script type="text/javascript">
		$(document).ready(function () {
			$('#customerContractsTable').DataTable({
				processing: true,
				bStateSave: true,
				fixedHeader: {
					headerOffset: 119
				},
				lengthMenu: [
					[10, 25, 50, 100, 150, -1],
					[10, 25, 50, 100, 150, "All"]
				],
				pageLength: 25,
				pagingType: "full_numbers",
				order: [5, "desc"],
				deferRender: true
			});
		});
	</script>
@stop
