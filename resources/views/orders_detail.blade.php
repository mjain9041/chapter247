@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">Order ID #{{$orderData->id}}</div>
    <div class="col-md-12">Invoice No. #{{$orderData->invoice_number}}</div>
    <div class="col-md-12">Customer Name. {{$orderData->customerdata->name}}</div>
<table class="table table-bordered" id="users-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Product Name</th>
                <th>Product Price</th>
            </tr>
        </thead>
        <tbody>
            <?php  $i =1; ?>
            @foreach($orderItemData as $data)
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$data->productdata->name}}</td>
                    <td>$ {{$data->productdata->price}}</td>
                </tr>
                <?php $i = $i+1; ?>
            @endforeach
            <tr>
                
                <td></td>
                <td>Total Price</td>
                <td>$ {{$orderData->total_amount}}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
