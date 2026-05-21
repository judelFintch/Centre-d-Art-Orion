# Centre d'Art Orion — Site Vitrine

Site vitrine professionnel du **Centre d'Art Orion** — Production · Création · Formation

---

## Stack technique

| Composant | Version |
|---|---|
| PHP | 8.4+ |
| Laravel | 11+ |
| Tailwind CSS | v4 (`@tailwindcss/vite`) |
| Vite | 6+ |
| Base de données | SQLite (local) / MySQL (prod) |

---

## Installation rapide

```bash
# 1. Cloner le dépôt
git clone <url-du-depot> Centre-d-Art-Orion
cd Centre-d-Art-Orion

# 2. Dépendances PHP
composer install

# 3. Copier et configurer l'environnement
cp .env.example .env
php artisan key:generate

# 4. Dépendances Node
npm install

# 5. Migrations + données de démonstration
php artisan migrate --seed

# 6. Lien de stockage
php artisan storage:link

# 7. Lancer le serveur de développement
php artisan serve &
npm run dev
```

Ouvrir **http://localhost:8000**

---

## Structure des pages

| Route | Description |
|---|---|
| `/` | Accueil — hero, services, formations, événements, témoignages |
| `/a-propos` | Histoire, vision, mission, valeurs, direction |
| `/services` | 6 services détaillés |
| `/formations` | Liste des formations par catégorie |
| `/formations/{slug}` | Détail d'une formation |
| `/galerie` | Galerie photo/vidéo avec filtres |
| `/evenements` | Événements à venir et passés |
| `/evenements/{slug}` | Détail d'un événement |
| `/equipe` | Équipe par rôle (direction, formateurs, artistes) |
| `/contact` | Formulaire, coordonnées, carte |
| `/admin` | Back-office (auth requise) |

---

## Back-office Admin

Le back-office est accessible sur `/admin/login`.

> **Compte par défaut (seeder) :**
> Email : `admin@centreartorion.cd`
> Mot de passe : à définir via `php artisan tinker` → `User::first()->update(['password' => Hash::make('votre-mdp')])`

Modules disponibles :
- Tableau de bord avec statistiques
- Gestion des formations (CRUD)
- Gestion des événements (CRUD)
- Gestion de la galerie (CRUD)
- Gestion de l'équipe (CRUD)
- Gestion des messages reçus

---

## Charte graphique

| Variable CSS | Valeur | Usage |
|---|---|---|
| `--color-orion-black` | `#0a0a0a` | Fond principal |
| `--color-orion-dark` | `#111111` | Fond cartes |
| `--color-orion-white` | `#f5f5f0` | Texte principal |
| `--color-orion-green` | `#4caf7d` | Accent principal |
| `--color-orion-gold` | `#d4a030` | Accent secondaire |
| `--color-orion-orange` | `#e07030` | Accent tertiaire |

Polices :
- **Playfair Display** — titres, headings, chiffres
- **Space Grotesk** — navigation, labels, boutons
- **Inter** — corps du texte

---

## Commandes utiles

```bash
# Développement
php artisan serve
npm run dev

# Production
npm run build
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Réinitialiser les données
php artisan migrate:fresh --seed

# Créer un lien de stockage
php artisan storage:link
```

---

## Informations du centre

```
Centre d'Art Orion
CEO            : Aras M. NGONGO
Chef de centre : Magellan KAHOZI
Adresse        : 380, Av. Changalele, Q. Gambela
Référence      : Derrière le nouveau bâtiment de l'INPP
Email          : contact@centreartorion.cd
```

---

## Prochaines évolutions prévues

- [ ] Authentification complète (Laravel Breeze / Fortify)
- [ ] CRUD complet pour formations, événements, galerie, équipe
- [ ] Upload d'images avec compression automatique
- [ ] Newsletter et formulaire d'inscription
- [ ] Multiligues (FR / EN)
- [ ] Paiement en ligne pour les formations
- [ ] API REST pour applications mobiles

---

*Développé avec soin pour le Centre d'Art Orion*

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
