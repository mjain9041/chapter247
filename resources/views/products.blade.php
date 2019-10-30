@extends('layouts.app')

@section('content')
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Custom Filter [Case Sensitive]</h3>
    </div>
    <div class="panel-body">
        <form method="POST" id="search-form" class="form-inline" role="form">

            <div class="form-group">
               
                <select class="form-control" name="in_stock" id="in_stock">
                    <option value="">All</option>
                    <option value="in_stock">In Stock</option>
                    <option value="out_of_stock">Out Of Stock</option>
                </select>
                
            </div>
            <!-- <button type="submit" class="btn btn-primary">Search</button> -->
        </form>
    </div>
    <br>
</div>
<table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Price</th>
                <th>In Stock</th>
               
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
        ajax: { url: '{!! route('productData') !!}',
                data: function (d) {
                        d.in_stock = $('#in_stock').val();
                    }
        },
        columns: [
            { data: 'id', name: 'id', searchable: false, orderable: false },
            { data: 'name', name: 'name' },
            { data: 'price', name: 'price',orderable: false },
            { data: 'in_stock', name: 'in_stock'},
        ]
    });
    
    $('#in_stock').on("change", function(event){
        oTable.draw();
    });
});


</script>
@endpush
