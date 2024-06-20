<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\DataTables\SlidersDataTable;
use App\Models\Kategori;
use App\Models\Produk;

class SliderController extends Controller
{
    public function index(SlidersDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image',
        ]);

        $path = $request->file('image')->store('public/sliders');
        Slider::create(['image' => $path]);

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => 'sometimes|image',
        ]);

        $slider = Slider::findOrFail($id);
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('public/sliders');
            $slider->image = $path;
            $slider->save();
        }

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        $slider->delete();

        return redirect()->route('admin.slider.index')
            ->with('success', 'Slider berhasil dihapus.');
    }

    public function showSliders()
    {
        $sliders = Slider::all();
        $produks = Produk::all();
        $kategori = Kategori::all(); 
        return view('index', compact('sliders', 'produks','kategori'));
    }
}