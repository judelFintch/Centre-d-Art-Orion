<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HeroSlideAdminController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::ordonne()->get();
        return view('admin.hero.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'label'     => 'required|string|max:80',
            'title_one' => 'required|string|max:100',
            'title_two' => 'required|string|max:100',
            'lead'      => 'required|string|max:300',
            'cta_label' => 'required|string|max:60',
            'cta_url'   => 'required|string|max:255',
            'accent'    => 'required|string|max:20',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'ordre'     => 'nullable|integer|min:0',
            'actif'     => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        $data['actif'] = $request->boolean('actif', true);
        $data['ordre'] = $data['ordre'] ?? HeroSlide::max('ordre') + 1;

        HeroSlide::create($data);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide créé avec succès.');
    }

    public function edit(HeroSlide $hero)
    {
        return view('admin.hero.edit', compact('hero'));
    }

    public function update(Request $request, HeroSlide $hero)
    {
        $data = $request->validate([
            'label'     => 'required|string|max:80',
            'title_one' => 'required|string|max:100',
            'title_two' => 'required|string|max:100',
            'lead'      => 'required|string|max:300',
            'cta_label' => 'required|string|max:60',
            'cta_url'   => 'required|string|max:255',
            'accent'    => 'required|string|max:20',
            'image'     => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'ordre'     => 'nullable|integer|min:0',
            'actif'     => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            if ($hero->image) Storage::disk('public')->delete($hero->image);
            $data['image'] = $request->file('image')->store('hero', 'public');
        }

        $data['actif'] = $request->boolean('actif');

        $hero->update($data);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide mis à jour.');
    }

    public function destroy(HeroSlide $hero)
    {
        if ($hero->image) Storage::disk('public')->delete($hero->image);
        $hero->delete();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide supprimé.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['ordre' => 'required|array', 'ordre.*' => 'integer']);

        foreach ($request->ordre as $position => $id) {
            HeroSlide::where('id', $id)->update(['ordre' => $position]);
        }

        return response()->json(['ok' => true]);
    }

    public function toggleActif(HeroSlide $hero)
    {
        $hero->update(['actif' => !$hero->actif]);

        return redirect()->route('admin.hero.index')
            ->with('success', $hero->actif ? 'Slide activé.' : 'Slide désactivé.');
    }
}
