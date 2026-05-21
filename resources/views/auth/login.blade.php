<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin — Centre d'Art Orion</title>
    @vite(['resources/css/app.css'])
</head>
<body style="background:#0a0a0a;display:flex;align-items:center;justify-content:center;min-height:100vh;padding:24px;">

    <div style="width:100%;max-width:400px;">

        {{-- Logo --}}
        <div style="text-align:center;margin-bottom:40px;">
            <div style="width:64px;height:64px;border-radius:50%;background:linear-gradient(135deg,#4caf7d,#d4a030);display:flex;align-items:center;justify-content:center;font-family:'Space Grotesk',sans-serif;font-weight:900;font-size:1.5rem;color:#0a0a0a;margin:0 auto 16px;">O</div>
            <h1 style="font-family:'Playfair Display',Georgia,serif;font-size:1.5rem;font-weight:900;color:#f5f5f0;margin:0 0 4px;">Centre d'Art Orion</h1>
            <p style="color:#555;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;">Espace d'administration</p>
        </div>

        {{-- Form --}}
        <div style="background:#111;border:1px solid #1a1a1a;border-radius:10px;padding:36px;">
            <h2 style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:0.85rem;letter-spacing:0.08em;text-transform:uppercase;color:#f5f5f0;margin:0 0 28px;text-align:center;">Connexion</h2>

            @if($errors->any())
            <div style="background:rgba(224,112,48,0.1);border:1px solid rgba(224,112,48,0.3);border-radius:6px;padding:14px;margin-bottom:20px;color:#e07030;font-size:0.85rem;">
                @foreach($errors->all() as $error)
                <p style="margin:0;">{{ $error }}</p>
                @endforeach
            </div>
            @endif

            <form method="POST" action="{{ route('login') }}" style="display:flex;flex-direction:column;gap:18px;">
                @csrf
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:8px;">Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required autofocus
                           class="orion-input" placeholder="admin@centreartorion.cd">
                </div>
                <div>
                    <label style="display:block;font-family:'Space Grotesk',sans-serif;font-size:0.75rem;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#777;margin-bottom:8px;">Mot de passe</label>
                    <input type="password" name="password" required
                           class="orion-input" placeholder="••••••••">
                </div>
                <div style="display:flex;align-items:center;gap:8px;">
                    <input type="checkbox" name="remember" id="remember" style="width:16px;height:16px;accent-color:#4caf7d;">
                    <label for="remember" style="font-family:'Space Grotesk',sans-serif;font-size:0.82rem;color:#888;cursor:pointer;">Se souvenir de moi</label>
                </div>
                <button type="submit" class="btn-primary" style="width:100%;justify-content:center;padding:14px;">
                    Se connecter
                </button>
            </form>
        </div>

        <div style="text-align:center;margin-top:24px;">
            <a href="{{ route('home') }}" style="color:#555;font-size:0.8rem;font-family:'Space Grotesk',sans-serif;text-decoration:none;transition:color 0.2s;"
               onmouseover="this.style.color='#f5f5f0'" onmouseout="this.style.color='#555'">← Retour au site</a>
        </div>
    </div>

</body>
</html>
