@php
    use App\Models\PageSetting;
    $current  = PageSetting::get($key, $default ?? '');
    $hasError = $errors->has($key);
@endphp
<div data-field-key="{{ $key }}">
    <label style="display:block;color:{{ $hasError ? '#e07030' : '#888' }};font-size:0.75rem;font-family:'Space Grotesk',sans-serif;font-weight:600;text-transform:uppercase;letter-spacing:0.06em;margin-bottom:6px;">
        {{ $label }}
    </label>
    <input type="text"
           name="{{ $name }}"
           value="{{ old($key, $current) }}"
           @isset($max) maxlength="{{ $max }}" @endisset
           style="width:100%;background:#111;border:1px solid {{ $hasError ? '#e07030' : '#1a1a1a' }};border-radius:6px;padding:9px 12px;color:#f5f5f0;font-size:0.85rem;font-family:'Space Grotesk',sans-serif;box-sizing:border-box;transition:border-color 0.2s;outline:none;"
           onfocus="this.style.borderColor='{{ $hasError ? '#e07030' : '#4caf7d55' }}'"
           onblur="this.style.borderColor='{{ $hasError ? '#e07030' : '#1a1a1a' }}'">
    @if($hasError)
    <p style="margin:4px 0 0;color:#e07030;font-size:0.72rem;font-family:'Space Grotesk',sans-serif;">
        {{ $errors->first($key) }}
    </p>
    @endif
</div>
