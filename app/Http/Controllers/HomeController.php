<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Customer;
use App\Product;
use App\Order;
use App\OrderItem;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function showCustomers()
    {
        return view('customers');
    }

    public function showProducts()
    {
        return view('products');
    }

    public function showOrders()
    {
        return view('orders');
    }

    public function customerData()
    {
        $data = Customer::query();
        return Datatables::of($data)
        ->editColumn('created_at',function($data) {
            return $data->created_at->format('jS F Y');
        })
        ->make(true);
    }

    public function productData(Request $request)
    {
        if ($request->ajax()) {
            $data = Product::query();
            return Datatables::of($data)
            ->editColumn('price',function($data) {
                return '$ '.$data->price;
            })
            ->editColumn('in_stock',function($data) {
                if($data->in_stock == 'in_stock')
                    return 'In Stock';
                else
                return 'Out Of Stock';
            })
            ->filter(function($query){
                if(!empty(request('in_stock'))){
                    $query->where('in_stock',request('in_stock'));
                }
            })
            ->make(true);
        }
    }

    public function orderData(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Order::with('customerdata');
            return Datatables::of($data)
            ->editColumn('total_amount',function($data) {
                return '$ '.$data->total_amount;
            })
            ->editColumn('status',function($data) {
                if($data->status == 'new')
                    return 'New';
                else
                return 'Processed';
            })
            ->addColumn('action', function ($data) {
                    return '<a href="'.route("orderDetail",['id'=>$data->id]).'" class="btn btn-xs btn-primary"><i class="glyphicon glyphicon-edit"></i> Show Detail</a>';
                
            })
            ->make(true);
        }
    }

    public function orderDetail($id)
    {
        
        $orderData = Order::find($id);
        if($orderData->status == 'new') {
            $orderData->status = 'processed';
            $orderData->save();
            activity()->log(auth()->user()->name.' Processed the order: #'.$id);
        }
        $orderItemData = OrderItem::with('productdata')->where('order_id',$orderData->id)->get();

        
        return view('orders_detail',compact('orderData','orderItemData'));
    }
}
