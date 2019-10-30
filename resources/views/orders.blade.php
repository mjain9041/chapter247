@extends('layouts.app')

@section('content')
<div class="container">
<table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Customer Name</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
               
            </tr>
        </thead>
    </table>
</div>
@endsection
@push('scripts')
<script>
$(function() {
    var oTable = $('#users-table').DataTable({
        
        processing: true,
        serverSide: true,
        ajax: { url: '{!! route('orderData') !!}',
        },
        columns: [
            { data: 'id', name: 'id', searchable: false, orderable: false },
            { data: 'customerdata.name', name: 'customerdata.name' },
            { data: 'total_amount', name: 'total_amount' },
            { data: 'status', name: 'status' },
            { data: 'action', name: 'action' },
        ]
    });
    

});


</script>
@endpush
