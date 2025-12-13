<?php

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;

test('non-admin user cannot access admin area', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $response = $this->actingAs($user)->get('/admin');

    $response->assertStatus(403);
});

test('vendor cannot update another vendors product', function () {
    // Vendor A
    $userA = User::factory()->create();
    $vendorA = Vendor::factory()->create(['user_id' => $userA->id]);
    
    // Vendor B and their product
    $userB = User::factory()->create();
    $vendorB = Vendor::factory()->create(['user_id' => $userB->id]);
    $productB = Product::factory()->create(['vendor_id' => $vendorB->id]);

    // Vendor A tries to update Vendor B's product
    $response = $this->actingAs($userA)->put(route('products.update', $productB), [
        'name' => 'Hacked Name',
        'price' => 1.00,
    ]);

    $response->assertStatus(403);
});

test('vendor cannot delete another vendors product', function () {
    // Vendor A
    $userA = User::factory()->create();
    $vendorA = Vendor::factory()->create(['user_id' => $userA->id]);
    
    // Vendor B and their product
    $userB = User::factory()->create();
    $vendorB = Vendor::factory()->create(['user_id' => $userB->id]);
    $productB = Product::factory()->create(['vendor_id' => $vendorB->id]);

    // Vendor A tries to delete Vendor B's product
    $response = $this->actingAs($userA)->delete(route('products.destroy', $productB));

    $response->assertStatus(403);
});
