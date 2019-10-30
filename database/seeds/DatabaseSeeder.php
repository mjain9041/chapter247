<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       
        //Admin
        \Bouncer::allow('admin')->to('showCustomer');
        \Bouncer::allow('admin')->to('showProducts');
        \Bouncer::allow('admin')->to('showOrders');

        // //User
        \Bouncer::allow('userManager')->to('showCustomer');

        // //Shop
        \Bouncer::allow('shopManager')->to('showProducts');
        \Bouncer::allow('shopManager')->to('showOrders');

        $admin = App\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at'=>Carbon\Carbon::now(),
            'updated_at'=>Carbon\Carbon::now(),
        ]);

        $admin->assign('admin');


        $user = App\User::create([
            'name' => 'userManager',
            'email' => 'userManager@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at'=>Carbon\Carbon::now(),
            'updated_at'=>Carbon\Carbon::now(),
        ]);

        $user->assign('userManager');

        $shop = App\User::create([
            'name' => 'shopManager',
            'email' => 'shopManager@gmail.com',
            'password' => Hash::make('12345678'),
            'created_at'=>Carbon\Carbon::now(),
            'updated_at'=>Carbon\Carbon::now(),
        ]);

        $shop->assign('shopManager');


        for($i=1;$i<=200;$i++){
            $name = Str::random(10);
            DB::table('customers')->insert([
                'name' => $name,
                'email' => $name.'@gmail.com',
                'created_at'=>Carbon\Carbon::now(),
                'updated_at'=>Carbon\Carbon::now(),
            ]);
        }

        $arr = array( "a"=>"in_stock", "b"=>"out_of_stock" ); 
        for($i=1;$i<=100;$i++){
            $name = Str::random(10);
            $key = array_rand($arr); 
            DB::table('products')->insert([
                'name' => $name,
                'price' => rand(1,100),
                'in_stock' => $arr[$key],
                'created_at'=>Carbon\Carbon::now(),
                'updated_at'=>Carbon\Carbon::now(),
            ]);
        }

        $arr = array( "a"=>"new", "b"=>"processed" ); 
        for($i=1;$i<=50;$i++) {
            $key = array_rand($arr);
            $productId = rand(1,100);
            $ProductData = App\Product::find($productId);

            $orderData = App\Order::create([
                'user_id' => rand(1,200),
                'invoice_number' => Str::random(10),
                'total_amount' => $ProductData->price,
                'status' => 'new',
                'created_at'=>Carbon\Carbon::now(),
                'updated_at'=>Carbon\Carbon::now(),
            ]);

            $orderItemData = App\OrderItem::create([
                'order_id' => $orderData->id,
                'product_id' => $productId,
                'created_at'=>Carbon\Carbon::now(),
                'updated_at'=>Carbon\Carbon::now(),
            ]);

        }

        
        

    }
}
