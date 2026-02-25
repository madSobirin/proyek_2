<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;


class MenuController extends Controller
{
   public function index(Request $request)
{
    $search = $request->input('search');

    $menus = Menu::query()
        ->when($search, function ($query, $search) {
            return $query->where('nama_menu', 'like', "%{$search}%")
                         ->orWhere('deskripsi', 'like', "%{$search}%");
        })
        ->latest()
        ->get();

    return view('pages.menu', [ // Pastikan path view sesuai (pages.menu)
        'title' => 'Menu Sehat Premium',
        'menus' => $menus
    ]);
}


    public function showDetail($id)
    {
        $title = "Detail Menu";
        $menu = Menu::findOrFail($id);

        $menu->increment('dibaca');
        return view('pages.menu-detail', compact('menu', 'title'));
    }
}
