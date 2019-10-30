@extends('layouts.app')

@section('content')
<div class="container">
<table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Created At</th>
               
            </tr>
        </thead>
    </table>
</div>
@endsection
@push('scripts')
<script>
$(function() {
    $('#users-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '{!! route('customerData') !!}',
        columns: [
            { data: 'id', name: 'id', searchable: false, orderable: false },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email',orderable: false },
            { data: 'created_at', name: 'created_at', searchable: false,orderable: false },
        ]
    });
});
</script>
@endpush
