<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
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
        User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'remember_token' =>  \Illuminate\Support\Str::random(10), 'api_token' =>  'utwe2AXiyvokbomS3aGALkTRXE38lqHRo64ZrnkA']);

        $c1 = Customer::create(['name' => 'customer1', 'phone' => '097777777']);
        $c2 = Customer::create(['name' => 'customer2', 'phone' => '098888888']);
        $c3 = Customer::create(['name' => 'customer3', 'phone' => '099999999']);

        $p1 = Product::create(['name' => 'product1', 'description' => 'test product']);
        $p2 = Product::create(['name' => 'product2', 'description' => 'test product']);
        $p3 = Product::create(['name' => 'product3', 'description' => 'test product']);
        $p4 = Product::create(['name' => 'product4', 'description' => 'test product']);
        $p5 = Product::create(['name' => 'product5', 'description' => 'test product']);
        $p6 = Product::create(['name' => 'product6', 'description' => 'test product']);

        Order::create(['name' => 'order1', 'customer_id' => $c1->id])->products()->attach([$p1->id, $p2->id]);
        Order::create(['name' => 'order2', 'customer_id' => $c1->id])->products()->attach([$p3->id, $p4->id]);
        Order::create(['name' => 'order3', 'customer_id' => $c2->id])->products()->attach([$p5->id, $p6->id]);
        Order::create(['name' => 'order4', 'customer_id' => $c2->id])->products()->attach([$p1->id, $p3->id]);
        Order::create(['name' => 'order5', 'customer_id' => $c3->id])->products()->attach([$p3->id, $p4->id]);
        Order::create(['name' => 'order6', 'customer_id' => $c3->id])->products()->attach([$p5->id, $p6->id]);
    }
}
