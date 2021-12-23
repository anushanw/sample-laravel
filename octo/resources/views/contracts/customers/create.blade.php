@extends('layouts.v5.app')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="card card-custom">
                <contracts-customers-create></contracts-customers-create>
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
