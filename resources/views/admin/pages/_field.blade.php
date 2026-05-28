@php
    use App\Models\PageSetting;
    $current = PageSetting::get($key, $default ?? '');
@endphp
<div>
    <label style="display:block;color:#888;font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">{{ $label }}</label>
    <input type="text"
           name="{{ $name }}"
           value="{{ old(str_replace(['[',']'],['.','>'], $name), $current) }}"
           style="width:100%;background:#111;border:1px solid #1a1a1a;border-radius:6px;padding:9px 12px;color:#f5f5f0;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;box-sizing:border-box;transition:border-color 0.2s;outline:none;"
           onfocus="this.style.borderColor='#4caf7d55'"
           onblur="this.style.borderColor='#1a1a1a'">
</div>
