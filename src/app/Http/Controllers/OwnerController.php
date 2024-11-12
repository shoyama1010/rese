<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use Illuminate\Support\Facades\Auth;

class OwnerController extends Controller
{
    public function index()
    {
        $shops = Shop::where('owner_id', Auth::id())->get();
        return view('owners.index', compact('shops'));
    }

    public function create()
    {
        return view('owners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        Shop::create([
            'owner_id' => Auth::id(),
            'name' => $request->name,
            'area' => $request->area,
            'genre' => $request->genre,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('owner.dashboard')->with('success', 'Shop created successfully');
    }

    public function edit($id)
    {
        $shop = Shop::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();
        return view('owners.edit', compact('shop'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
        ]);

        $shop = Shop::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();

        $shop->update([
            'name' => $request->name,
            'area' => $request->area,
            'genre' => $request->genre,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        return redirect()->route('owner.dashboard')->with('success', 'Shop updated successfully');
    }

    public function destroy($id)
    {
        $shop = Shop::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();
        $shop->delete();

        return redirect()->route('owner.dashboard')->with('success', 'Shop deleted successfully');
    }
}

