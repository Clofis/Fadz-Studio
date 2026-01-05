<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Template;
use App\Models\Testimony;
use App\Models\Setting;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Get Settings
Route::get('/settings', function () {
    return Setting::first();
});

// Get All Templates
Route::get('/templates', function (Request $request) {
    $query = Template::with('category')->where('is_active', true);
    
    // Filter by category
    if ($request->has('category_id')) {
        $query->where('category_id', $request->category_id);
    }
    
    return $query->latest()->get();
});

// Get Single Template
Route::get('/templates/{id}', function ($id) {
    return Template::with('category')->findOrFail($id);
});

// Get Categories
Route::get('/categories', function () {
    return Category::withCount('templates')->get();
});

// Get Testimonies
Route::get('/testimonies', function () {
    return Testimony::latest()->get();
});