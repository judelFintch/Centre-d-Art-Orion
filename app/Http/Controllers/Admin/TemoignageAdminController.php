<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesTranslations;
use App\Http\Controllers\Controller;
use App\Models\Temoignage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TemoignageAdminController extends Controller
{
    use HandlesTranslations;

    private const TRANSLATABLE = ['poste', 'contenu'];

    public function index()
    {
        $temoignages = Temoignage::query()->orderBy('ordre')->orderBy('id')->get();

        return view('admin.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        return view('admin.temoignages.create');
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['actif'] = $request->boolean('actif', true);
        $data['ordre'] = $data['ordre'] ?? ((Temoignage::max('ordre') ?? 0) + 1);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('temoignages', 'public');
        }

        $temoignage = Temoignage::create($data);
        $this->applyEnglishTranslations($temoignage, $request, self::TRANSLATABLE);

        return redirect()->route('admin.temoignages.index')
            ->with('success', 'Témoignage ajouté avec succès.');
    }

    public function edit(Temoignage $temoignage)
    {
        return view('admin.temoignages.edit', compact('temoignage'));
    }

    public function update(Request $request, Temoignage $temoignage)
    {
        $data = $this->validatedData($request);
        $data['actif'] = $request->boolean('actif');

        if ($request->hasFile('photo')) {
            $this->deletePhoto($temoignage->photo);
            $data['photo'] = $request->file('photo')->store('temoignages', 'public');
        } elseif ($request->boolean('remove_photo')) {
            $this->deletePhoto($temoignage->photo);
            $data['photo'] = null;
        }

        $temoignage->update($data);
        $this->applyEnglishTranslations($temoignage, $request, self::TRANSLATABLE);

        return redirect()->route('admin.temoignages.index')
            ->with('success', 'Témoignage mis à jour.');
    }

    public function destroy(Temoignage $temoignage)
    {
        $this->deletePhoto($temoignage->photo);
        $temoignage->delete();

        return redirect()->route('admin.temoignages.index')
            ->with('success', 'Témoignage supprimé.');
    }

    public function toggle(Temoignage $temoignage)
    {
        $temoignage->update(['actif' => ! $temoignage->actif]);

        return back()->with('success', 'Visibilité du témoignage mise à jour.');
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'auteur'       => ['required', 'string', 'max:160'],
            'poste'        => ['nullable', 'string', 'max:200'],
            'contenu'      => ['required', 'string', 'max:3000'],
            'photo'        => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'note'         => ['required', 'integer', 'between:1,5'],
            'ordre'        => ['nullable', 'integer', 'min:0'],
            'actif'        => ['nullable', 'boolean'],
            'remove_photo' => ['nullable', 'boolean'],
            'poste_en'     => ['nullable', 'string', 'max:200'],
            'contenu_en'   => ['nullable', 'string', 'max:3000'],
        ]);
    }

    private function deletePhoto(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
