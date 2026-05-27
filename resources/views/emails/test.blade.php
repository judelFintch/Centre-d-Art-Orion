<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test de configuration mail</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f0;font-family:'Helvetica Neue',Arial,sans-serif;">

<table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f0;padding:40px 20px;">
    <tr>
        <td align="center">
            <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#0a0a0a;border-radius:8px;overflow:hidden;">

                {{-- En-tête --}}
                <tr>
                    <td style="background:linear-gradient(135deg,#0d1a12,#0a1510);padding:40px;text-align:center;border-bottom:1px solid #1a2e20;">
                        <p style="font-family:Georgia,serif;font-size:1.6rem;font-weight:700;color:#f5f5f0;margin:0 0 8px;letter-spacing:0.02em;">Centre d'Art Orion</p>
                        <p style="color:#4caf7d;font-size:0.78rem;font-weight:700;letter-spacing:0.14em;text-transform:uppercase;margin:0;">Test de configuration mail</p>
                    </td>
                </tr>

                {{-- Corps --}}
                <tr>
                    <td style="padding:40px;">
                        <p style="color:#aaa;font-size:0.95rem;line-height:1.8;margin:0 0 20px;">
                            Bonjour,
                        </p>
                        <p style="color:#888;font-size:0.9rem;line-height:1.8;margin:0 0 24px;">
                            Cet e-mail confirme que la configuration de votre serveur d'envoi est correctement enregistrée et opérationnelle.
                        </p>

                        <div style="background:#111;border:1px solid #1a1a1a;border-radius:6px;padding:20px 24px;margin:0 0 28px;">
                            <p style="font-family:'Helvetica Neue',Arial,sans-serif;font-size:0.72rem;font-weight:700;letter-spacing:0.1em;text-transform:uppercase;color:#555;margin:0 0 10px;">Informations</p>
                            <p style="color:#777;font-size:0.85rem;margin:0 0 6px;">Expéditeur : <strong style="color:#f5f5f0;">{{ config('mail.from.name') }}</strong></p>
                            <p style="color:#777;font-size:0.85rem;margin:0 0 6px;">Adresse : <strong style="color:#f5f5f0;">{{ config('mail.from.address') }}</strong></p>
                            <p style="color:#777;font-size:0.85rem;margin:0;">Transporteur : <strong style="color:#4caf7d;">{{ strtoupper(config('mail.default')) }}</strong></p>
                        </div>

                        <p style="color:#555;font-size:0.82rem;line-height:1.7;margin:0;">
                            Si vous recevez cet e-mail, votre configuration est fonctionnelle. Vous pouvez retourner au panneau d'administration.
                        </p>
                    </td>
                </tr>

                {{-- Pied --}}
                <tr>
                    <td style="padding:24px 40px;border-top:1px solid #161616;text-align:center;">
                        <p style="color:#333;font-size:0.75rem;margin:0;">
                            © {{ date('Y') }} Centre d'Art Orion — E-mail automatique, merci de ne pas y répondre.
                        </p>
                    </td>
                </tr>

            </table>
        </td>
    </tr>
</table>

</body>
</html>
