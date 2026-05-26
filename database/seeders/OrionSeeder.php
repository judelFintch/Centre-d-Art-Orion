<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Formation;
use App\Models\HeroSlide;
use App\Models\Evenement;
use App\Models\EquipeMembre;
use App\Models\Temoignage;
use App\Models\GalerieItem;
use Illuminate\Support\Str;

class OrionSeeder extends Seeder
{
    public function run(): void
    {
        // ── Hero Slides ───────────────────────────────────────
        $heroSlides = [
            ['label'=>'Production','title_one'=>'DONNER VIE','title_two'=>"A L'OEUVRE",'lead'=>'Studios, techniques et savoir-faire pour transformer chaque vision en création aboutie.','cta_label'=>'Voir nos services','cta_url'=>'/services','accent'=>'#e07030','ordre'=>1],
            ['label'=>'Formation','title_one'=>'APPRENDRE','title_two'=>'PROGRESSER','lead'=>'Des programmes concrets pour grandir, créer et professionnaliser son talent artistique.','cta_label'=>'Voir nos formations','cta_url'=>'/formations','accent'=>'#4caf7d','ordre'=>2],
            ['label'=>'Création','title_one'=>"L'ART NAIT",'title_two'=>'ICI','lead'=>'Résidences, ateliers et collaborations pour faire éclore des œuvres uniques et audacieuses.','cta_label'=>'Voir la galerie','cta_url'=>'/galerie','accent'=>'#d4a030','ordre'=>3],
            ['label'=>'Inspiration','title_one'=>"L'ÉTINCELLE",'title_two'=>'EST EN VOUS','lead'=>'Un espace vivant où chaque artiste puise, partage et rayonne au-delà des frontières.','cta_label'=>'Notre histoire','cta_url'=>'/a-propos','accent'=>'#4caf7d','ordre'=>4],
        ];
        foreach ($heroSlides as $s) {
            HeroSlide::firstOrCreate(
                ['label' => $s['label'], 'title_one' => $s['title_one']],
                array_merge($s, ['actif' => true])
            );
        }

        // ── Équipe ────────────────────────────────────────────
        $membres = [
            ['prenom' => 'Aras M.', 'nom' => 'NGONGO', 'poste' => 'CEO & Fondateur', 'role' => 'ceo',
             'bio' => 'Visionnaire et fondateur du Centre d\'Art Orion, Aras M. NGONGO a consacré sa vie à la promotion des arts et des talents émergents en RDC. Sa vision : faire d\'Orion un pilier de la culture africaine contemporaine.',
             'ordre' => 1],
            ['prenom' => 'Magellan', 'nom' => 'KAHOZI', 'poste' => 'Chef de Centre', 'role' => 'chef_centre',
             'bio' => 'Magellan KAHOZI dirige les opérations quotidiennes du Centre d\'Art Orion avec passion et rigueur. Fort d\'une expérience solide dans la gestion culturelle, il veille à l\'excellence de chaque programme.',
             'ordre' => 2],
            ['prenom' => 'Marie', 'nom' => 'LUKEBA', 'poste' => 'Formatrice en Arts Visuels', 'role' => 'formateur',
             'bio' => 'Artiste plasticienne et pédagogue, Marie LUKEBA accompagne les talents dans leur développement artistique avec une approche unique mêlant tradition africaine et modernité.',
             'ordre' => 3],
            ['prenom' => 'Jean-Paul', 'nom' => 'MWAMBA', 'poste' => 'Formateur en Musique', 'role' => 'formateur',
             'bio' => 'Musicien professionnel avec plus de 15 ans d\'expérience, Jean-Paul MWAMBA transmet sa passion de la musique à travers des cours théoriques et pratiques.',
             'ordre' => 4],
            ['prenom' => 'Amina', 'nom' => 'BANZA', 'poste' => 'Artiste Associée — Danse', 'role' => 'artiste',
             'bio' => 'Danseuse et chorégraphe primée, Amina BANZA fusionne les danses traditionnelles congolaises avec les styles contemporains pour créer des performances uniques.',
             'ordre' => 5],
        ];

        foreach ($membres as $m) {
            EquipeMembre::firstOrCreate(
                ['nom' => $m['nom'], 'prenom' => $m['prenom']],
                array_merge($m, ['actif' => true])
            );
        }

        // ── Formations ────────────────────────────────────────
        $formations = [
            ['titre' => 'Arts Plastiques & Peinture', 'categorie' => 'Arts Visuels',
             'description' => 'Maîtrisez les techniques fondamentales et avancées des arts plastiques — dessin, peinture à l\'huile, aquarelle, acrylique — encadrées par nos artistes professionnels.',
             'duree' => '3 mois', 'niveau' => 'Tous niveaux', 'public_cible' => 'Adolescents et adultes passionnés d\'art',
             'prix' => 150.00, 'ordre' => 1],
            ['titre' => 'Musique & Instruments', 'categorie' => 'Musique',
             'description' => 'Apprenez à jouer de la guitare, du piano ou de la batterie avec nos formateurs expérimentés. Programme adapté à chaque niveau.',
             'duree' => '6 mois', 'niveau' => 'Débutant à intermédiaire', 'public_cible' => 'Enfants (8+) et adultes',
             'prix' => 200.00, 'ordre' => 2],
            ['titre' => 'Danse Contemporaine & Traditionnelle', 'categorie' => 'Danse',
             'description' => 'Explorez le mouvement à travers les danses traditionnelles congolaises et les styles contemporains. Développez votre expression corporelle et votre créativité.',
             'duree' => '4 mois', 'niveau' => 'Tous niveaux', 'public_cible' => 'Enfants (6+) et adultes',
             'prix' => 120.00, 'ordre' => 3],
            ['titre' => 'Photographie Artistique', 'categorie' => 'Photographie',
             'description' => 'De la prise en main de votre appareil à la retouche numérique, ce programme complet vous forme à l\'art de capturer la beauté du monde qui vous entoure.',
             'duree' => '2 mois', 'niveau' => 'Débutant', 'public_cible' => 'Adultes et jeunes professionnels',
             'prix' => 180.00, 'ordre' => 4],
            ['titre' => 'Théâtre & Expression Scénique', 'categorie' => 'Théâtre',
             'description' => 'Développez votre présence scénique, maîtrisez les techniques de jeu d\'acteur et participez à des productions théâtrales au sein du centre.',
             'duree' => '5 mois', 'niveau' => 'Tous niveaux', 'public_cible' => 'Adolescents et adultes',
             'prix' => 160.00, 'ordre' => 5],
            ['titre' => 'Production Musicale & Studio', 'categorie' => 'Musique',
             'description' => 'Initiez-vous aux logiciels de production musicale (DAW), à l\'enregistrement en studio et au mixage professionnel pour donner vie à vos créations.',
             'duree' => '3 mois', 'niveau' => 'Intermédiaire', 'public_cible' => 'Musiciens souhaitant évoluer',
             'prix' => 250.00, 'ordre' => 6],
        ];

        foreach ($formations as $f) {
            Formation::firstOrCreate(
                ['slug' => Str::slug($f['titre'])],
                array_merge($f, ['actif' => true])
            );
        }

        // ── Événements ────────────────────────────────────────
        $evenements = [
            ['titre' => 'Gala des Arts Orion 2026', 'statut' => 'a_venir', 'type' => 'gala',
             'description' => 'La grande soirée annuelle du Centre d\'Art Orion réunit artistes, partenaires et mécènes pour célébrer l\'excellence artistique et récompenser les meilleurs talents de l\'année.',
             'date_debut' => now()->addMonths(2), 'lieu' => 'Centre d\'Art Orion — Salle Principale', 'gratuit' => false, 'prix' => 10.00],
            ['titre' => 'Exposition Collective — Regards Croisés', 'statut' => 'a_venir', 'type' => 'exposition',
             'description' => 'Une exposition mettant en lumière les œuvres de nos artistes en résidence, autour du thème "Identité & Modernité". Entrée libre.',
             'date_debut' => now()->addMonth(), 'lieu' => 'Galerie Orion', 'gratuit' => true, 'prix' => 0],
            ['titre' => 'Atelier Ouvert — Initiation à la Peinture', 'statut' => 'a_venir', 'type' => 'atelier',
             'description' => 'Venez découvrir les joies de la peinture lors de cet atelier ouvert à tous. Matériel fourni. Places limitées à 15 participants.',
             'date_debut' => now()->addWeeks(3), 'lieu' => 'Atelier Créatif — RDC', 'gratuit' => false, 'prix' => 5.00],
            ['titre' => 'Concert de Fin d\'Année', 'statut' => 'passe', 'type' => 'concert',
             'description' => 'Les apprenants de la filière musique présentent le fruit de leurs mois de travail lors d\'un concert live devant familles et amis.',
             'date_debut' => now()->subMonths(3), 'lieu' => 'Auditorium Orion', 'gratuit' => true, 'prix' => 0],
            ['titre' => 'Showcase Danse Urbaine', 'statut' => 'passe', 'type' => 'showcase',
             'description' => 'Un showcase vibrant mettant en vedette les danseurs d\'Orion dans un spectacle mêlant hip-hop, afrobeats et danses traditionnelles.',
             'date_debut' => now()->subMonths(5), 'lieu' => 'Scène Extérieure — Centre Orion', 'gratuit' => true, 'prix' => 0],
        ];

        foreach ($evenements as $e) {
            Evenement::firstOrCreate(
                ['slug' => Str::slug($e['titre'])],
                array_merge($e, ['actif' => true])
            );
        }

        // ── Témoignages ──────────────────────────────────────
        $temoignages = [
            ['auteur' => 'Claudine MUTOMBO', 'poste' => 'Étudiante en Arts Plastiques', 'note' => 5,
             'contenu' => 'Le Centre d\'Art Orion a transformé ma vie. En moins de 3 mois, j\'ai acquis des compétences que je n\'aurais jamais pu développer seule. Les formateurs sont passionnés et très professionnels.'],
            ['auteur' => 'Patrick KAZADI', 'poste' => 'Musicien professionnel', 'note' => 5,
             'contenu' => 'C\'est grâce à Orion que j\'ai pu franchir le cap vers la production professionnelle. Le studio et l\'encadrement sont de très haute qualité.'],
            ['auteur' => 'Sylvie NGALULA', 'poste' => 'Danseuse', 'note' => 5,
             'contenu' => 'Une ambiance unique, des formateurs exceptionnels et un vrai tremplin pour les artistes. Je recommande à 100% le Centre d\'Art Orion.'],
            ['auteur' => 'Didier LUFUNGULA', 'poste' => 'Photographe', 'note' => 5,
             'contenu' => 'La formation en photographie a dépassé toutes mes attentes. Approche pédagogique moderne, équipement professionnel et suivi personnalisé.'],
        ];

        foreach ($temoignages as $i => $t) {
            Temoignage::firstOrCreate(
                ['auteur' => $t['auteur']],
                array_merge($t, ['actif' => true, 'ordre' => $i + 1])
            );
        }

        // ── Galerie (placeholders) ────────────────────────────
        $galerie = [
            ['titre' => 'Atelier Peinture', 'type' => 'photo', 'categorie' => 'atelier',
             'fichier' => 'galerie/placeholder-1.jpg'],
            ['titre' => 'Concert Live', 'type' => 'photo', 'categorie' => 'evenement',
             'fichier' => 'galerie/placeholder-2.jpg'],
            ['titre' => 'Exposition Œuvres', 'type' => 'photo', 'categorie' => 'production',
             'fichier' => 'galerie/placeholder-3.jpg'],
            ['titre' => 'Cours de Danse', 'type' => 'photo', 'categorie' => 'atelier',
             'fichier' => 'galerie/placeholder-4.jpg'],
            ['titre' => 'Studio Enregistrement', 'type' => 'photo', 'categorie' => 'production',
             'fichier' => 'galerie/placeholder-5.jpg'],
            ['titre' => 'Showcase Final', 'type' => 'photo', 'categorie' => 'evenement',
             'fichier' => 'galerie/placeholder-6.jpg'],
        ];

        foreach ($galerie as $i => $g) {
            GalerieItem::firstOrCreate(
                ['titre' => $g['titre']],
                array_merge($g, ['actif' => true, 'ordre' => $i + 1])
            );
        }
    }
}
