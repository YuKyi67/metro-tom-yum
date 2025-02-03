<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuItemController extends Controller
{
    //
    public function index() {
        return view("menu.items");
    }

    public function create() {
        return view("menu.create");
    }

    public function edit() {
        return view("menu.edit");
    }

    public function destroy() {
        //
    }
}
