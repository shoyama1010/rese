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

    public function dashboard()
    {
        $owner = Auth::guard('owner')->user();

        $shop = $owner->shop;

        return view('owner.dashboard', compact('owner', 'shop'));
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
    
    // 予約状況の確認
    public function reservations()
    {
        $owner = Auth::guard('owner')->user();
        $shop = $owner->shop;

        $reservations = $shop->reservations()
            ->with('user')
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->get();

        return view('owner.reservations.index', compact('owner', 'shop', 'reservations'));
    }

    public function editShop()
    {
        $owner = Auth::guard('owner')->user();
        $shop = $owner->shop;

        return view('owner.shop.edit', compact('owner', 'shop'));
    }

    public function updateShop(Request $request)
    {
        $owner = Auth::guard('owner')->user();
        $shop = $owner->shop;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:400',
            'image_url' => 'nullable|string|max:255',
        ]);

        $shop->update([
            'name' => $request->name,
            'description' => $request->description,
            'image_url' => $request->image_url,
        ]);

        return redirect()
            ->route('owner.dashboard')
            ->with('success', '店舗情報を更新しました。');
    }

    public function destroy($id)
    {
        $shop = Shop::where('id', $id)->where('owner_id', Auth::id())->firstOrFail();
        $shop->delete();

        return redirect()->route('owner.dashboard')->with('success', 'Shop deleted successfully');
    }
}

