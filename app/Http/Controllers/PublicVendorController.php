<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;

class PublicVendorController extends Controller
{
    public function show(Vendor $vendor)
    {
        $products = $vendor->products()
            ->where('is_active', true)
            ->latest()
            ->paginate(12);

        return view('vendors.show', compact('vendor', 'products'));
    }
}
