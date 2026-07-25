<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PageSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PageSettingAdminController extends Controller
{
    /* ────────────────────────────────── HOME ── */

    public function home()
    {
        return view('admin.pages.home');
    }

    public function updateHome(Request $request)
    {
        $data = $request->validate([
            /* ── Identité ── */
            'home.ni.kicker'        => 'nullable|string|max:80',
            'home.ni.titre_em'      => 'nullable|string|max:120',
            'home.ni.titre'         => 'nullable|string|max:120',
            'home.ni.stat1_val'     => 'nullable|string|max:20',
            'home.ni.stat1_lbl'     => 'nullable|string|max:40',
            'home.ni.stat2_val'     => 'nullable|string|max:20',
            'home.ni.stat2_lbl'     => 'nullable|string|max:40',
            'home.ni.stat3_val'     => 'nullable|string|max:20',
            'home.ni.stat3_lbl'     => 'nullable|string|max:40',
            'home.ni.prose'         => 'nullable|string|max:1000',
            'home.ni.feat1_text'    => 'nullable|string|max:120',
            'home.ni.feat2_text'    => 'nullable|string|max:120',
            'home.ni.feat3_text'    => 'nullable|string|max:120',
            'home.ni.cta_label'     => 'nullable|string|max:80',
            'home.ni.img1_label'    => 'nullable|string|max:50',
            'home.ni.img2_label'    => 'nullable|string|max:50',
            'home.ni.img3_label'    => 'nullable|string|max:50',
            'home.ni.annee'         => 'nullable|string|max:40',
            /* ── Images identité ── */
            'home.ni.img1_file'     => 'nullable|image|max:4096',
            'home.ni.img2_file'     => 'nullable|image|max:4096',
            'home.ni.img3_file'     => 'nullable|image|max:4096',
            /* ── Services ── */
            'home.services.tag'     => 'nullable|string|max:80',
            'home.services.titre_1' => 'nullable|string|max:80',
            'home.services.titre_2' => 'nullable|string|max:80',
            'home.services.desc'    => 'nullable|string|max:200',
            'home.services.item1_icon'  => 'nullable|string|max:10',
            'home.services.item1_titre' => 'nullable|string|max:80',
            'home.services.item1_desc'  => 'nullable|string|max:200',
            'home.services.item1_img'   => 'nullable|image|max:4096',
            'home.services.item2_icon'  => 'nullable|string|max:10',
            'home.services.item2_titre' => 'nullable|string|max:80',
            'home.services.item2_desc'  => 'nullable|string|max:200',
            'home.services.item2_img'   => 'nullable|image|max:4096',
            'home.services.item3_icon'  => 'nullable|string|max:10',
            'home.services.item3_titre' => 'nullable|string|max:80',
            'home.services.item3_desc'  => 'nullable|string|max:200',
            'home.services.item3_img'   => 'nullable|image|max:4096',
            'home.services.item4_icon'  => 'nullable|string|max:10',
            'home.services.item4_titre' => 'nullable|string|max:80',
            'home.services.item4_desc'  => 'nullable|string|max:200',
            'home.services.item4_img'   => 'nullable|image|max:4096',
            'home.services.item5_icon'  => 'nullable|string|max:10',
            'home.services.item5_titre' => 'nullable|string|max:80',
            'home.services.item5_desc'  => 'nullable|string|max:200',
            'home.services.item5_img'   => 'nullable|image|max:4096',
            'home.services.item6_icon'  => 'nullable|string|max:10',
            'home.services.item6_titre' => 'nullable|string|max:80',
            'home.services.item6_desc'  => 'nullable|string|max:200',
            'home.services.item6_img'   => 'nullable|image|max:4096',
            /* ── Podcasts ── */
            'home.podcasts.kicker'       => 'nullable|string|max:80',
            'home.podcasts.titre_1'      => 'nullable|string|max:80',
            'home.podcasts.titre_gradient' => 'nullable|string|max:80',
            'home.podcasts.desc'         => 'nullable|string|max:500',
            'home.podcasts.serie_titre'  => 'nullable|string|max:80',
            'home.podcasts.serie_desc'   => 'nullable|string|max:300',
            'home.podcasts.img_file'     => 'nullable|image|max:4096',
            /* ── CTA Final ── */
            'home.cta.kicker'   => 'nullable|string|max:80',
            'home.cta.titre_1'  => 'nullable|string|max:80',
            'home.cta.titre_em' => 'nullable|string|max:80',
            'home.cta.prose'    => 'nullable|string|max:400',
            /* ── Ordres ── */
            'home.services.order'   => 'nullable|string|max:20',
            'home.ni.stats_order'   => 'nullable|string|max:10',
            'home.ni.feats_order'   => 'nullable|string|max:10',
        ]);

        // Sauvegarder les champs texte
        PageSetting::saveMany($this->flatten($this->stripFiles($data)));

        // Dériver automatiquement les clés images depuis les règles de validation
        foreach ($this->imageKeysFrom($data) as $key) {
            $this->handleImageUpload($request, $key);
        }

        $this->saveEnglishFields($request);

        PageSetting::clearCache();

        return back()->with('success', 'Page d\'accueil mise à jour avec succès.');
    }

    /* ────────────────────────────────── ABOUT ── */

    public function about()
    {
        return view('admin.pages.about');
    }

    public function updateAbout(Request $request)
    {
        $data = $request->validate([
            /* ── Hero ── */
            'about.hero.titre_1'  => 'nullable|string|max:120',
            'about.hero.titre_2'  => 'nullable|string|max:120',
            'about.hero.desc'     => 'nullable|string|max:400',
            /* ── Histoire ── */
            'about.histoire.kicker'      => 'nullable|string|max:80',
            'about.histoire.titre'       => 'nullable|string|max:120',
            'about.histoire.para1'       => 'nullable|string|max:1000',
            'about.histoire.para2'       => 'nullable|string|max:1000',
            'about.histoire.para3'       => 'nullable|string|max:1000',
            'about.histoire.item1_emoji' => 'nullable|string|max:10',
            'about.histoire.item1_titre' => 'nullable|string|max:60',
            'about.histoire.item1_desc'  => 'nullable|string|max:200',
            'about.histoire.item2_emoji' => 'nullable|string|max:10',
            'about.histoire.item2_titre' => 'nullable|string|max:60',
            'about.histoire.item2_desc'  => 'nullable|string|max:200',
            'about.histoire.item3_emoji' => 'nullable|string|max:10',
            'about.histoire.item3_titre' => 'nullable|string|max:60',
            'about.histoire.item3_desc'  => 'nullable|string|max:200',
            'about.histoire.item4_emoji' => 'nullable|string|max:10',
            'about.histoire.item4_titre' => 'nullable|string|max:60',
            'about.histoire.item4_desc'  => 'nullable|string|max:200',
            /* ── Vision / Mission / Valeurs ── */
            'about.vision.texte'   => 'nullable|string|max:600',
            'about.mission.texte'  => 'nullable|string|max:600',
            'about.valeurs.item1'  => 'nullable|string|max:120',
            'about.valeurs.item2'  => 'nullable|string|max:120',
            'about.valeurs.item3'  => 'nullable|string|max:120',
            'about.valeurs.item4'  => 'nullable|string|max:120',
            'about.valeurs.item5'  => 'nullable|string|max:120',
            /* ── Direction ── */
            'about.direction.ceo_initiales'   => 'nullable|string|max:4',
            'about.direction.ceo_nom'         => 'nullable|string|max:80',
            'about.direction.ceo_role'        => 'nullable|string|max:60',
            'about.direction.ceo_sous_titre'  => 'nullable|string|max:80',
            'about.direction.ceo_bio'         => 'nullable|string|max:600',
            'about.direction.chef_initiales'  => 'nullable|string|max:4',
            'about.direction.chef_nom'        => 'nullable|string|max:80',
            'about.direction.chef_role'       => 'nullable|string|max:60',
            'about.direction.chef_sous_titre' => 'nullable|string|max:80',
            'about.direction.chef_bio'        => 'nullable|string|max:600',
            /* ── Photos direction ── */
            'about.direction.ceo_photo'  => 'nullable|image|max:4096',
            'about.direction.chef_photo' => 'nullable|image|max:4096',
            /* ── CTA ── */
            'about.cta.titre_1'        => 'nullable|string|max:80',
            'about.cta.titre_gradient' => 'nullable|string|max:40',
            'about.cta.desc'           => 'nullable|string|max:400',
            /* ── Ordres ── */
            'about.histoire.order' => 'nullable|string|max:12',
            'about.valeurs.order'  => 'nullable|string|max:12',
        ]);

        // Champs texte
        PageSetting::saveMany($this->flatten($this->stripFiles($data)));

        // Photos direction
        foreach ($this->imageKeysFrom($data) as $key) {
            $this->handleImageUpload($request, $key);
        }

        $this->saveEnglishFields($request);

        PageSetting::clearCache();

        return back()->with('success', 'Page "À propos" mise à jour avec succès.');
    }

    /* ────────────────────────────────── PODCASTS ── */

    public function podcasts()
    {
        return view('admin.pages.podcasts');
    }

    public function updatePodcasts(Request $request)
    {
        $data = $request->validate([
            'podcasts.hero.tag'                    => 'nullable|string|max:80',
            'podcasts.hero.title_1'                => 'nullable|string|max:100',
            'podcasts.hero.title_2'                => 'nullable|string|max:100',
            'podcasts.hero.description'            => 'nullable|string|max:600',
            'podcasts.hero.listen_label'           => 'nullable|string|max:80',
            'podcasts.hero.propose_label'          => 'nullable|string|max:80',
            'podcasts.featured.label'              => 'nullable|string|max:80',
            'podcasts.latest.tag'                  => 'nullable|string|max:80',
            'podcasts.latest.title'                => 'nullable|string|max:120',
            'podcasts.latest.description'          => 'nullable|string|max:500',
            'podcasts.empty.title'                 => 'nullable|string|max:160',
            'podcasts.empty.description'           => 'nullable|string|max:500',
            'podcasts.participate.tag'             => 'nullable|string|max:80',
            'podcasts.participate.title'           => 'nullable|string|max:160',
            'podcasts.participate.description'     => 'nullable|string|max:800',
            'podcasts.participate.step1_title'     => 'nullable|string|max:120',
            'podcasts.participate.step1_desc'      => 'nullable|string|max:400',
            'podcasts.participate.step2_title'     => 'nullable|string|max:120',
            'podcasts.participate.step2_desc'      => 'nullable|string|max:400',
            'podcasts.participate.step3_title'     => 'nullable|string|max:120',
            'podcasts.participate.step3_desc'      => 'nullable|string|max:400',
            'podcasts.participate.button_label'    => 'nullable|string|max:100',
        ]);

        PageSetting::saveMany($this->flatten($data));
        $this->saveEnglishFields($request);
        PageSetting::clearCache();

        return back()->with('success', 'Contenu de la page Podcasts mis à jour avec succès.');
    }

    /* ────────────────────────────────── HELPERS ── */

    /**
     * Enregistre les traductions anglaises soumises via les champs `en_fields[clé.pointée]`
     * générés par les partiels _field / _textarea, sans passer par la validation stricte
     * (champs optionnels, non contraints en longueur côté anglais).
     */
    private function saveEnglishFields(Request $request): void
    {
        foreach ($request->input('en_fields', []) as $key => $value) {
            if (is_string($key) && is_string($value)) {
                PageSetting::set($key, ['en' => $value]);
            }
        }
    }

    /**
     * Extrait les clés dot-notation correspondant à des fichiers image
     * depuis le tableau de données validé (valeurs UploadedFile ou null).
     * Évite de maintenir une liste séparée en parallèle des règles de validation.
     */
    private function imageKeysFrom(array $data, string $prefix = ''): array
    {
        $keys = [];
        foreach ($data as $key => $value) {
            $dotKey = $prefix !== '' ? $prefix . '.' . $key : $key;
            if (is_array($value)) {
                $keys = array_merge($keys, $this->imageKeysFrom($value, $dotKey));
            } elseif ($value instanceof \Illuminate\Http\UploadedFile || $value === null) {
                // On ne retient que les clés dont le nom finit par _file, _img ou _photo
                if (preg_match('/(_file|_img|_photo)$/', $dotKey)) {
                    $keys[] = $dotKey;
                }
            }
        }
        return $keys;
    }

    /**
     * Stocke un fichier image uploadé, supprime l'ancien, enregistre le chemin.
     * La clé utilise la notation pointée : 'home.ni.img1_file'
     * L'input HTML correspondant doit être nommé : home[ni][img1_file]
     */
    private function handleImageUpload(Request $request, string $key): void
    {
        // Convertit 'home.ni.img1_file' → 'home.ni.img1_file' (dot notation)
        // Laravel résout automatiquement home[ni][img1_file] en home.ni.img1_file
        if (!$request->hasFile($key)) {
            return;
        }

        $file = $request->file($key);
        if (!$file || !$file->isValid()) {
            return;
        }

        // Supprimer l'ancien fichier s'il existe
        $old = PageSetting::get($key);
        if ($old && Storage::disk('public')->exists($old)) {
            Storage::disk('public')->delete($old);
        }

        // Stocker le nouveau fichier
        $path = $file->store('page-images', 'public');
        PageSetting::set($key, $path);
    }

    /**
     * Retire les valeurs UploadedFile du tableau validé (elles sont gérées séparément).
     */
    private function stripFiles(array $data): array
    {
        array_walk_recursive($data, function (&$value) {
            if ($value instanceof \Illuminate\Http\UploadedFile) {
                $value = null;
            }
        });
        return $data;
    }

    /**
     * Transforme un tableau imbriqué en tableau plat avec des clés dot-notation.
     * ['home' => ['ni' => ['titre' => 'foo']]] → ['home.ni.titre' => 'foo']
     */
    private function flatten(array $array, string $prefix = ''): array
    {
        $result = [];
        foreach ($array as $key => $value) {
            $newKey = $prefix !== '' ? $prefix . '.' . $key : $key;
            if (is_array($value)) {
                $result = array_merge($result, $this->flatten($value, $newKey));
            } else {
                $result[$newKey] = $value;
            }
        }
        return $result;
    }
}
