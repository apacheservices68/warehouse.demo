<div class="container-fluid">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<table id="table" class="table table-striped table-hover">
		        <thead>
		        <tr>		        	
		            <th>ID</th>
		            <th>Measure</th>
		            <th>Vendor</th>
		            <th>Date</th>
		            <th>Container</th>
		            <th>Receive</th>
		        </tr>
		        </thead>
		        <tbody></tbody>
		    </table>	
			{{-- Need to change --}}
		</div>	
	</div>
</div>
@push('scripts')
<script src="{{ asset('assets/datatables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/datatables/js/datatables.bootstrap.js') }}"></script>

<script type="text/javascript">
 	
    var table = $('#table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{{ URL::to("item/item-data") }}',
        columns: [
         
            {data: 'id', name: 'items.id'},
	        {data: 'measure', name: 'items.measure'},
	        {data: 'name', name: 'name', searchable: false},
	        {data: 'date', name: 'items.date'},
	        {data: 'container', name: 'items.container'},
	        {data: 'receive', name: 'items.receive'}
        ],

    });


</script>
@endpush
