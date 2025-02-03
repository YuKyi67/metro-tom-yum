<?php

namespace App\Http\Controllers;

use App\Models\MenuItem;
use Illuminate\Http\Request;
use Redirect;

class MenuItemController extends Controller
{
    //
    public function index()
    {
        $menuItems = MenuItem::all();

        return view("menu.items", ['menuItems' => $menuItems]);
    }

    public function create()
    {
        return view("menu.create");
    }

    public function store(Request $request)
    {
        // validate
        $attributes = $request->validate([
            'name' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'category' => ['required', 'min:3'],
            'imagePath' => ['required', 'image']
        ]);

        // For new image upload
        if ($request->hasFile('imagePath')) {
            $imagePath = $request->file('imagePath')->store('images', 'public');
            $attributes['imagePath'] = $imagePath;
        }

        // create
        MenuItem::create($attributes);

        // return
        return redirect()->route('menu.index');
    }

    public function edit($id)
    {
        $itemToBeUpdated = MenuItem::findOrFail($id);

        return view("menu.edit", ['item' => $itemToBeUpdated]);
    }

    // Route modal binding
    public function update(Request $request, MenuItem $item)
    {
        $attributes = $request->validate([
            'name' => ['required', 'min:3'],
            'price' => ['required', 'numeric'],
            'category' => ['required', 'min:3'],
            'imagePath' => ['required', 'image']
        ]);

        // passed the validated data to the form
        $item->fill($attributes);

        // For new image upload
        if ($request->hasFile('imagePath')) {
            $imagePath = $request->file('imagePath')->store('images', 'public');
            $item['imagePath'] = $imagePath;
        }

        // updated in the database
        $item->save();

        return redirect()->route('menu.index');
    }

    public function destroy($id)
    {
        // dd($id);
        MenuItem::destroy($id);

        return redirect()->route('menu.index');
    }
}
