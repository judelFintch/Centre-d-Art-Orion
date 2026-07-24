@props(['label' => 'Version anglaise (optionnel)'])

<details style="background:#111;border:1px solid rgba(76,175,125,0.25);border-radius:8px;overflow:hidden;">
    <summary style="padding:16px 24px;cursor:pointer;font-family:'Space Grotesk',sans-serif;font-size:0.8rem;font-weight:700;letter-spacing:0.06em;text-transform:uppercase;color:#4caf7d;display:flex;align-items:center;gap:8px;">
        🌐 {{ $label }}
    </summary>
    <div style="padding:0 24px 24px;display:flex;flex-direction:column;gap:18px;">
        <p style="color:#666;font-size:0.78rem;line-height:1.6;margin:0 0 4px;">
            Laissez vide pour afficher automatiquement le contenu français aux visiteurs anglophones en attendant la traduction.
        </p>
        {{ $slot }}
    </div>
</details>
