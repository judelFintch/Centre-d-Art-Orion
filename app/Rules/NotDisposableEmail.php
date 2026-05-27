<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

/**
 * Refuse les domaines d'email temporaires / jetables connus.
 */
class NotDisposableEmail implements ValidationRule
{
    /**
     * Liste des domaines jetables les plus courants.
     * À enrichir si nécessaire.
     */
    protected array $disposableDomains = [
        // ── Mailinator family ───────────────────────────────────────
        'mailinator.com', 'mailinator.net', 'mailinator.org', 'mailinator.us',
        'mailinator2.com', 'notmailinator.com',
        // ── Guerrilla Mail ──────────────────────────────────────────
        'guerrillamail.com', 'guerrillamail.net', 'guerrillamail.org',
        'guerrillamail.biz', 'guerrillamail.de', 'guerrillamail.info',
        'guerrillamailblock.com', 'grr.la', 'sharklasers.com', 'spam4.me',
        // ── Yop Mail ────────────────────────────────────────────────
        'yopmail.com', 'yopmail.fr', 'cool.fr.nf', 'jetable.fr.nf',
        'nospam.ze.tc', 'nomail.xl.cx', 'mega.zik.dj', 'speed.1s.fr',
        'courriel.fr.nf', 'moncourrier.fr.nf', 'monemail.fr.nf', 'monmail.fr.nf',
        // ── 10-minute / temp mail ────────────────────────────────────
        '10minutemail.com', '10minutemail.net', '20minutemail.com',
        'tempmail.com', 'tempmailo.com', 'temp-mail.org', 'temp-mail.ru',
        'tempr.email', 'tempemail.com', 'tempinbox.com', 'tempalias.com',
        'temporaryemail.net', 'temporaryinbox.com', 'mytemp.email',
        // ── Throw-away ───────────────────────────────────────────────
        'throwam.com', 'throam.com', 'throwaway.email', 'discard.email',
        // ── Trash mail ───────────────────────────────────────────────
        'trashmail.com', 'trashmail.at', 'trashmail.io', 'trashmail.me',
        'trashmail.net', 'trashmail.org', 'trashmail.xyz', 'trashmailer.com',
        'trashymail.com', 'trash-mail.at', 'trash-mail.com', 'trash-mail.de',
        // ── Miscellaneous well-known ──────────────────────────────────
        'mailnull.com', 'mailnesia.com', 'mailcatch.com', 'mailexpire.com',
        'mailforspam.com', 'mailfreeonline.com', 'mailbucket.org',
        'maildrop.cc', 'maildrop.cf', 'fakeinbox.com', 'dispostable.com',
        'spamgourmet.com', 'spamgourmet.net', 'spamgourmet.org',
        'spamtrap.ro', 'spamfree24.org', 'spaml.de', 'spamoff.de',
        'getonemail.com', 'getonemail.net', 'hmamail.com', 'meltmail.com',
        'mt2009.com', 'mt2014.com', 'emailondeck.com', 'anonbox.net',
        'anonymbox.com', 'dodgit.com', 'pookmail.com', 'rcpt.at',
        'spambox.us', 'spamcan.org', 'spamex.com', 'spamhole.com',
        'safe-mail.net', 'safetymail.info', 'sofort-mail.de',
        'wegwerf-email.de', 'wegwerfmail.de', 'weg-werf-email.de',
        'nospamfor.us', 'nospammail.net', 'nospamthanks.info',
        'objectmail.com', 'owlpic.com', 'tagyourself.com',
        'ephemail.net', 'explodemail.com', 'filzmail.com',
        'brefmail.com', 'deadaddress.com', 'despam.it',
        'jetable.com', 'jetable.net', 'jetable.org',
        'kasmail.com', 'killmail.com', 'killmail.net',
        'link2mail.net', 'litedrop.com', 'lolfreak.net',
        'mail333.com', 'mailbidon.com', 'mailbiz.biz',
        'mailme.ir', 'mailme.lv', 'mailme24.com', 'mailmetrash.com',
        'mailmoat.com', 'mailms.com', 'mailnew.com',
        'mailpick.biz', 'mailquack.com', 'mailrock.biz',
        'mailseal.de', 'mailspam.me', 'mailspam.xyz',
        'mailtemp.info', 'mailtome.de', 'mailtothis.com',
        'mailtrash.net', 'mailzilla.com', 'mailzilla.org',
        'oneoffemail.com', 'oneoffmail.com',
        'privy-mail.com', 'privy-mail.de',
        'quickinbox.com', 'quickmail.nl',
        'rejectmail.com', 'sendspamhere.com',
        'shiftmail.com', 'shitmail.me', 'shitmail.org',
        'sneakemail.com', 'sofimail.com',
        'spam.la', 'spam.su', 'spamavert.com',
        'spambob.com', 'spambob.net', 'spambob.org',
        'spambog.com', 'spambog.de', 'spambog.ru',
        'spamday.com', 'spamdecoy.net', 'spamfree.eu',
        'spamify.com', 'spaminator.de', 'spamkill.info',
        'spamobox.com', 'spamspot.com', 'spamstack.net',
        'spamthisplease.com', 'spamtrail.com',
        'tempe-mail.com', 'tempemail.biz', 'tempemail.net',
        'tempinbox.co.uk', 'tempmail.eu', 'tempmail.it',
        'tempomail.fr', 'temporarymailaddress.com', 'tempthe.net',
        'tilien.com', 'tmailinator.com', 'toiea.com',
        'tradermail.info', 'trmailbox.com', 'turual.com',
        'umail.net', 'valemail.net', 'venompen.com',
        'walkmail.net', 'walkmail.ru', 'webemail.me',
        'wegwerfemail.com', 'wegwerfemail.de', 'wegwerfadresse.de',
        'willselfdestruct.com', 'wilemail.com',
        'xagloo.com', 'xemaps.com', 'xents.com',
        'yapped.net', 'youmail.ga',
        'zehnminutenmail.de', 'zippymail.info',
    ];

    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (! str_contains($value, '@')) {
            return; // Laisse la validation email:rfc gérer le format
        }

        $domain = strtolower(ltrim(strrchr($value, '@'), '@'));

        if (in_array($domain, $this->disposableDomains, true)) {
            $fail('Les adresses e-mail temporaires ou jetables ne sont pas acceptées.');
        }
    }
}
