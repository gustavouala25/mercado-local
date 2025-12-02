<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeVendor;

class VendorController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'whatsapp_number' => 'required|string|max:20',
            'location' => 'required|string|max:255',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(6);

        $vendor = $request->user()->vendor()->create($validated);

        // Send Welcome Email
        // Mail::to($request->user())->send(new WelcomeVendor($vendor));

        return redirect()->route('dashboard')->with('success', '¡Tu tienda ha sido creada exitosamente!');
    }
}
