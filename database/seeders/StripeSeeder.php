<?php

namespace Database\Seeders;

use App\Models\UserPlans;
use Stripe\StripeClient;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StripeSeeder extends Seeder
{
    public function run()
    {
        $stripe = new StripeClient(env('STRIPE_SECRET'));

        // Step 1: Create the product
        $product = $stripe->products->create([
            'name' => 'Monthly Subscription', // Product name
            'description' => 'A subscription plan for premium users.', // Optional description
        ]);

        // Step 2: Create the price for the product (recurring monthly)
        $price = $stripe->prices->create([
            'unit_amount' => 1299, // The amount in cents (e.g., $12)
            'currency' => 'usd',
            'recurring' => ['interval' => 'month'], // Monthly subscription
            'product' => $product->id, // Link to the created product
        ]);


        UserPlans::query()->create([
            'name' => 'Monthly Subscription',
            'slug' => 'monthly-subscription',
            'description' => 'A subscription plan for premium users.',
            'monthly_fee' => 12.99,
            'stripe_product_id' => $product->id,
            'stripe_price_id' => $price->id,
        ]);
    }
}
