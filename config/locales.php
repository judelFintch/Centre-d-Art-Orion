<?php

return [

    // Locales gérées par le site public (ordre = ordre d'affichage du sélecteur)
    'supported' => ['fr', 'en'],

    'default' => env('APP_LOCALE', 'fr'),

    'names' => [
        'fr' => 'Français',
        'en' => 'English',
    ],

    // Code langue pour les balises og:locale / html lang
    'html' => [
        'fr' => 'fr_FR',
        'en' => 'en_US',
    ],

];
