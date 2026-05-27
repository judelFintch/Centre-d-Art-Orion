@extends('layouts.admin')
@section('title', 'Configuration Mail')

@section('content')

@php $fs = "width:100%;padding:11px 14px;background:#0d0d0d;border:1px solid #222;border-radius:6px;color:#f5f5f0;font-family:'Space Grotesk',sans-serif;font-size:0.88rem;outline:none;box-sizing:border-box;"; @endphp

<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:28px;flex-wrap:wrap;gap:12px;">
    <div>
        <h2 style="font-family:'Playfair Display',serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0;">Configuration Mail</h2>
        <p style="color:#555;font-size:0.82rem;margin:4px 0 0;font-family:'Space Grotesk',sans-serif;">
            Expéditeur, serveur SMTP et test d'envoi.
            @if($setting->actif)
                <span style="color:#4caf7d;margin-left:8px;">● Configuration BDD active</span>
            @else
                <span style="color:#888;margin-left:8px;">○ Utilisation des variables .env</span>
            @endif
        </p>
    </div>
    <a href="{{ route('equipe') }}" target="_blank" style="display:none;"></a>{{-- spacer --}}
</div>

{{-- Alertes --}}
@if(session('success'))
<div style="background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);border-radius:6px;padding:14px 18px;margin-bottom:20px;color:#4caf7d;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;display:flex;align-items:center;gap:10px;">
    <span>✓</span> {{ session('success') }}
</div>
@endif

@if(session('test_success'))
<div style="background:rgba(76,175,125,0.1);border:1px solid rgba(76,175,125,0.25);border-radius:6px;padding:14px 18px;margin-bottom:20px;color:#4caf7d;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;display:flex;align-items:center;gap:10px;">
    <span>✉</span> {{ session('test_success') }}
</div>
@endif

@if(session('test_error'))
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:20px;color:#e07030;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
    <strong>Erreur :</strong> {{ session('test_error') }}
</div>
@endif

@if($errors->any())
<div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px 18px;margin-bottom:20px;color:#e07030;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">
    <ul style="margin:0;padding-left:18px;">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
</div>
@endif

<div style="display:grid;grid-template-columns:minmax(0,1.4fr) minmax(300px,0.7fr);gap:24px;align-items:start;">

    {{-- Formulaire principal --}}
    <form action="{{ route('admin.mail.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div style="display:flex;flex-direction:column;gap:20px;">

            {{-- Section Expéditeur --}}
            <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:28px;display:flex;flex-direction:column;gap:18px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:4px;">
                    <span style="font-size:1rem;">✉</span>
                    <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0;">Expéditeur</h3>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                    <div>
                        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Nom affiché <span style="color:#e07030;">*</span></label>
                        <input type="text" name="from_name" required
                               value="{{ old('from_name', $setting->from_name ?: config('mail.from.name')) }}"
                               style="{{ $fs }}" placeholder="Centre d'Art Orion">
                        @error('from_name')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Adresse d'envoi <span style="color:#e07030;">*</span></label>
                        <input type="email" name="from_email" required
                               value="{{ old('from_email', $setting->from_email ?: config('mail.from.address')) }}"
                               style="{{ $fs }}" placeholder="contact@centreartorion.cd">
                        @error('from_email')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Adresse Reply-To <span style="color:#555;">(optionnel)</span></label>
                    <input type="email" name="reply_to"
                           value="{{ old('reply_to', $setting->reply_to) }}"
                           style="{{ $fs }}" placeholder="noreply@centreartorion.cd">
                    <p style="color:#444;font-size:0.74rem;margin:5px 0 0;font-family:'Space Grotesk',sans-serif;">Adresse de réponse si différente de l'expéditeur.</p>
                    @error('reply_to')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
            </div>

            {{-- Section SMTP --}}
            <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:28px;display:flex;flex-direction:column;gap:18px;" id="smtp-section">
                <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <span style="font-size:1rem;">⚙</span>
                        <h3 style="font-family:'Space Grotesk',sans-serif;font-size:0.78rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#f5f5f0;margin:0;">Serveur d'envoi</h3>
                    </div>
                    <div>
                        <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Transporteur</label>
                        <select name="mailer" id="mailer-select" style="{{ $fs }}width:auto;cursor:pointer;appearance:auto;"
                                onchange="document.getElementById('smtp-fields').style.display=this.value==='smtp'?'contents':'none'">
                            @foreach(['smtp' => 'SMTP', 'log' => 'Log (développement)', 'sendmail' => 'Sendmail'] as $val => $label)
                            <option value="{{ $val }}" {{ old('mailer', $setting->mailer) === $val ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('mailer')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                    </div>
                </div>

                <div id="smtp-fields" style="{{ old('mailer', $setting->mailer) !== 'smtp' ? 'display:none;' : 'display:contents;' }}">

                    <div style="display:grid;grid-template-columns:1fr auto auto;gap:14px;align-items:end;">
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Hôte SMTP</label>
                            <input type="text" name="host"
                                   value="{{ old('host', $setting->host ?: config('mail.mailers.smtp.host')) }}"
                                   style="{{ $fs }}" placeholder="smtp.gmail.com">
                            @error('host')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Port</label>
                            <input type="number" name="port" min="1" max="65535"
                                   value="{{ old('port', $setting->port ?: 587) }}"
                                   style="{{ $fs }}width:90px;">
                            @error('port')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Chiffrement</label>
                            <select name="encryption" style="{{ $fs }}width:auto;cursor:pointer;appearance:auto;">
                                <option value="tls"  {{ old('encryption', $setting->encryption) === 'tls'  ? 'selected' : '' }}>TLS</option>
                                <option value="ssl"  {{ old('encryption', $setting->encryption) === 'ssl'  ? 'selected' : '' }}>SSL</option>
                                <option value=""     {{ old('encryption', $setting->encryption) === ''     ? 'selected' : '' }}>Aucun</option>
                            </select>
                            @error('encryption')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;">
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Identifiant</label>
                            <input type="text" name="username" autocomplete="username"
                                   value="{{ old('username', $setting->username) }}"
                                   style="{{ $fs }}" placeholder="votre@email.com">
                            @error('username')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                        </div>
                        <div>
                            <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">
                                Mot de passe
                                @if($setting->hasPassword()) <span style="color:#4caf7d;font-size:0.65rem;">(déjà défini)</span> @endif
                            </label>
                            <input type="password" name="password" autocomplete="new-password"
                                   style="{{ $fs }}" placeholder="{{ $setting->hasPassword() ? 'Laisser vide pour conserver' : 'Mot de passe SMTP' }}">
                            @error('password')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                        </div>
                    </div>

                    {{-- Présets fournisseurs --}}
                    <div>
                        <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#555;margin:0 0 10px;">Préréglages rapides</p>
                        <div style="display:flex;gap:8px;flex-wrap:wrap;">
                            @foreach([
                                ['Gmail',     'smtp.gmail.com',        587, 'tls'],
                                ['Outlook',   'smtp.office365.com',    587, 'tls'],
                                ['OVH',       'ssl0.ovh.net',          465, 'ssl'],
                                ['Mailtrap',  'smtp.mailtrap.io',     2525, 'tls'],
                            ] as [$name, $host, $port, $enc])
                            <button type="button"
                                    onclick="applyPreset('{{ $host }}', {{ $port }}, '{{ $enc }}')"
                                    style="padding:5px 12px;background:#0d0d0d;border:1px solid #2a2a2a;border-radius:4px;color:#888;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;cursor:pointer;transition:all 0.2s;"
                                    onmouseover="this.style.borderColor='#4caf7d';this.style.color='#4caf7d'" onmouseout="this.style.borderColor='#2a2a2a';this.style.color='#888'">
                                {{ $name }}
                            </button>
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>

            {{-- Bouton enregistrer --}}
            <div style="display:flex;justify-content:flex-end;">
                <button type="submit"
                        style="padding:12px 32px;background:linear-gradient(135deg,#4caf7d,#2d7a52);color:#0a0a0a;font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:700;border:none;border-radius:6px;cursor:pointer;transition:opacity 0.2s;"
                        onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                    Enregistrer la configuration
                </button>
            </div>

        </div>
    </form>

    {{-- Colonne droite --}}
    <div style="display:flex;flex-direction:column;gap:20px;">

        {{-- Activation --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0 0 16px;">Source de configuration</h4>

            <form action="{{ route('admin.mail.update') }}" method="POST">
                @csrf @method('PUT')
                <input type="hidden" name="mailer"     value="{{ $setting->mailer }}">
                <input type="hidden" name="from_name"  value="{{ $setting->from_name ?: config('mail.from.name') }}">
                <input type="hidden" name="from_email" value="{{ $setting->from_email ?: config('mail.from.address') }}">
                <input type="hidden" name="host"       value="{{ $setting->host }}">
                <input type="hidden" name="port"       value="{{ $setting->port }}">
                <input type="hidden" name="username"   value="{{ $setting->username }}">
                <input type="hidden" name="encryption" value="{{ $setting->encryption }}">

                <div style="display:flex;flex-direction:column;gap:10px;margin-bottom:16px;">
                    @foreach([
                        [false, 'Variables .env', 'Utilise MAIL_* du fichier .env (recommandé pour la production).', '#888'],
                        [true,  'Base de données', 'Les paramètres ci-dessus écrasent le .env à chaque requête.', '#4caf7d'],
                    ] as [$val, $label, $desc, $color])
                    <label style="display:flex;align-items:flex-start;gap:12px;padding:14px;background:#0d0d0d;border:1px solid {{ $setting->actif === $val ? $color.'44' : '#1a1a1a' }};border-radius:6px;cursor:pointer;transition:border-color 0.2s;">
                        <input type="radio" name="actif" value="{{ $val ? '1' : '0' }}"
                               {{ ($setting->actif ? '1' : '0') === ($val ? '1' : '0') ? 'checked' : '' }}
                               style="accent-color:{{ $color }};margin-top:2px;flex-shrink:0;">
                        <div>
                            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.85rem;font-weight:600;color:#f5f5f0;margin:0 0 4px;">{{ $label }}</p>
                            <p style="color:#555;font-size:0.78rem;margin:0;line-height:1.5;">{{ $desc }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>

                <button type="submit"
                        style="width:100%;padding:10px;background:rgba(76,175,125,0.08);border:1px solid rgba(76,175,125,0.2);color:#4caf7d;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;border-radius:6px;cursor:pointer;transition:all 0.2s;"
                        onmouseover="this.style.background='rgba(76,175,125,0.16)'" onmouseout="this.style.background='rgba(76,175,125,0.08)'">
                    Appliquer la source
                </button>
            </form>
        </div>

        {{-- Test d'envoi --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:8px;padding:24px;">
            <h4 style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin:0 0 6px;">Tester la configuration</h4>
            <p style="color:#555;font-size:0.78rem;line-height:1.6;margin:0 0 16px;">Envoie un e-mail de test avec la configuration actuellement active.</p>

            <form action="{{ route('admin.mail.test') }}" method="POST">
                @csrf
                <div style="margin-bottom:12px;">
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#777;margin-bottom:8px;">Destinataire du test</label>
                    <input type="email" name="test_email"
                           value="{{ old('test_email', auth()->user()->email ?? '') }}"
                           style="{{ $fs }}" placeholder="admin@exemple.com" required>
                    @error('test_email')<p style="color:#e07030;font-size:0.75rem;margin:4px 0 0;">{{ $message }}</p>@enderror
                </div>
                <button type="submit"
                        style="width:100%;padding:10px;background:rgba(212,160,48,0.08);border:1px solid rgba(212,160,48,0.2);color:#d4a030;font-family:'Space Grotesk',sans-serif;font-size:0.82rem;font-weight:600;border-radius:6px;cursor:pointer;transition:all 0.2s;"
                        onmouseover="this.style.background='rgba(212,160,48,0.16)'" onmouseout="this.style.background='rgba(212,160,48,0.08)'">
                    ✉ Envoyer l'e-mail de test
                </button>
            </form>
        </div>

        {{-- Config .env actuelle --}}
        <div style="background:#0d0d0d;border:1px solid #161616;border-radius:8px;padding:20px;">
            <p style="font-family:'Space Grotesk',sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;color:#444;margin:0 0 12px;">.env actuel</p>
            <pre style="color:#555;font-size:0.72rem;line-height:1.8;margin:0;font-family:'Courier New',monospace;overflow-x:auto;">MAIL_MAILER={{ config('mail.default') }}
MAIL_HOST={{ config('mail.mailers.smtp.host') }}
MAIL_PORT={{ config('mail.mailers.smtp.port') }}
FROM={{ config('mail.from.address') }}</pre>
        </div>

    </div>
</div>

<script>
function applyPreset(host, port, encryption) {
    var hostInput = document.querySelector('input[name="host"]');
    var portInput = document.querySelector('input[name="port"]');
    var encSelect = document.querySelector('select[name="encryption"]');
    if (hostInput) hostInput.value = host;
    if (portInput) portInput.value = port;
    if (encSelect) encSelect.value = encryption;
}
</script>

@endsection
