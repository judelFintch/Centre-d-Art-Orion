<div style="display:flex;align-items:center;gap:8px;margin-bottom:10px;">
    <p style="color:#888;font-size:0.78rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.08em;margin:0;">{{ $label }}</p>
    <span style="display:inline-flex;align-items:center;gap:4px;padding:2px 8px;background:#4caf7d11;border:1px solid #4caf7d22;border-radius:12px;color:#4caf7d;font-size:0.65rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;">
        <svg width="9" height="9" viewBox="0 0 12 18" fill="currentColor"><circle cx="3.5" cy="3" r="1.8"/><circle cx="8.5" cy="3" r="1.8"/><circle cx="3.5" cy="9" r="1.8"/><circle cx="8.5" cy="9" r="1.8"/><circle cx="3.5" cy="15" r="1.8"/><circle cx="8.5" cy="15" r="1.8"/></svg>
        {{ $hint ?? 'Réordonnables' }}
    </span>
</div>
