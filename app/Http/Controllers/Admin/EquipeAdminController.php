<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Concerns\HandlesTranslations;
use App\Http\Controllers\Controller;
use App\Models\EquipeMembre;
use App\Models\EquipeRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class EquipeAdminController extends Controller
{
    use HandlesTranslations;

    private const TRANSLATABLE = ['poste', 'bio'];

    public function index()
    {
        $membres = EquipeMembre::with('roleOption')->orderBy('ordre')->orderBy('nom')->get();

        return view('admin.equipe.index', compact('membres'));
    }

    public function create()
    {
        $roles = EquipeRole::actif()->get();

        return view('admin.equipe.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $data = $this->validatedData($request);
        $data['actif'] = $request->boolean('actif', true);
        $data['ordre'] = $data['ordre'] ?? ((EquipeMembre::max('ordre') ?? 0) + 1);
        $data['reseaux_sociaux'] = $this->parseReseaux($request);
        $data['competences']     = $this->parseCompetences($request);

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('equipe', 'public');
        }

        $membre = EquipeMembre::create($data);
        $this->applyEnglishTranslations($membre, $request, self::TRANSLATABLE);

        return redirect()->route('admin.equipe.index')
            ->with('success', 'Membre ajouté avec succès.');
    }

    public function show(EquipeMembre $equipe)
    {
        return redirect()->route('equipe');
    }

    public function edit(EquipeMembre $equipe)
    {
        $roles = EquipeRole::ordered()->get();

        return view('admin.equipe.edit', compact('equipe', 'roles'));
    }

    public function update(Request $request, EquipeMembre $equipe)
    {
        $data = $this->validatedData($request);
        $data['actif']           = $request->boolean('actif');
        $data['reseaux_sociaux'] = $this->parseReseaux($request);
        $data['competences']     = $this->parseCompetences($request);

        if ($request->hasFile('photo')) {
            $this->deleteFile($equipe->photo);
            $data['photo'] = $request->file('photo')->store('equipe', 'public');
        }

        if ($request->boolean('remove_photo') && !$request->hasFile('photo')) {
            $this->deleteFile($equipe->photo);
            $data['photo'] = null;
        }

        $equipe->update($data);
        $this->applyEnglishTranslations($equipe, $request, self::TRANSLATABLE);

        return redirect()->route('admin.equipe.index')
            ->with('success', 'Membre mis à jour.');
    }

    public function destroy(EquipeMembre $equipe)
    {
        $this->deleteFile($equipe->photo);
        $equipe->delete();

        return redirect()->route('admin.equipe.index')
            ->with('success', 'Membre supprimé.');
    }

    public function toggleActif(EquipeMembre $equipe)
    {
        $equipe->update(['actif' => !$equipe->actif]);

        return back()->with('success', 'Visibilité mise à jour.');
    }

    public function reorder(Request $request)
    {
        $request->validate(['ordre' => ['required', 'array']]);

        foreach ($request->ordre as $position => $id) {
            EquipeMembre::where('id', $id)->update(['ordre' => $position]);
        }

        return response()->json(['success' => true]);
    }

    // ─── Helpers ───────────────────────────────────────────────────

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'nom'       => ['required', 'string', 'max:100'],
            'prenom'    => ['required', 'string', 'max:100'],
            'poste'     => ['required', 'string', 'max:160'],
            'role'      => ['required', Rule::exists('equipe_roles', 'slug')],
            'bio'       => ['nullable', 'string', 'max:2000'],
            'email'     => ['nullable', 'email', 'max:200'],
            'telephone' => ['nullable', 'string', 'max:40'],
            'photo'     => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'ordre'     => ['nullable', 'integer', 'min:0'],
            'actif'     => ['nullable', 'boolean'],
            'remove_photo' => ['nullable', 'boolean'],
            'rs_facebook'  => ['nullable', 'url', 'max:300'],
            'rs_instagram' => ['nullable', 'url', 'max:300'],
            'rs_linkedin'  => ['nullable', 'url', 'max:300'],
            'rs_twitter'   => ['nullable', 'url', 'max:300'],
            'competences_raw' => ['nullable', 'string', 'max:1000'],
        ]);
    }

    private function parseReseaux(Request $request): array
    {
        return array_filter([
            'facebook'  => $request->input('rs_facebook'),
            'instagram' => $request->input('rs_instagram'),
            'linkedin'  => $request->input('rs_linkedin'),
            'twitter'   => $request->input('rs_twitter'),
        ]);
    }

    private function parseCompetences(Request $request): array
    {
        $raw = $request->input('competences_raw', '');
        return collect(explode(',', $raw))
            ->map(fn ($c) => trim($c))
            ->filter()
            ->values()
            ->all();
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
