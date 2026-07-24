@props(['variant' => 'desktop'])

@php
    $currentRoute = Route::current();
    $routeName = $currentRoute?->getName();
    $routeParams = $currentRoute ? $currentRoute->parameters() : [];

    $urlFor = function (string $loc) use ($routeName, $routeParams) {
        if (! $routeName) {
            return '/'.$loc;
        }
        try {
            return route($routeName, array_merge($routeParams, ['locale' => $loc]));
        } catch (\Throwable $e) {
            return '/'.$loc;
        }
    };
@endphp

@if($variant === 'mobile')
    <div class="lang-switch lang-switch-mobile">
        @foreach(config('locales.supported') as $loc)
            <a href="{{ $urlFor($loc) }}"
               class="lang-switch-link {{ app()->getLocale() === $loc ? 'active' : '' }}"
               @if(app()->getLocale() === $loc) aria-current="true" @endif>
                {{ strtoupper($loc) }}
            </a>
        @endforeach
    </div>
@else
    <div class="lang-switch">
        @foreach(config('locales.supported') as $loc)
            <a href="{{ $urlFor($loc) }}"
               class="lang-switch-link {{ app()->getLocale() === $loc ? 'active' : '' }}"
               @if(app()->getLocale() === $loc) aria-current="true" @endif
               title="{{ config('locales.names')[$loc] }}">
                {{ strtoupper($loc) }}
            </a>
        @endforeach
    </div>
@endif

<style>
.lang-switch {
    display: flex;
    align-items: center;
    gap: 2px;
    padding: 3px;
    background: rgba(28,21,16,0.05);
    border: 1px solid rgba(28,21,16,0.10);
    border-radius: 999px;
}
.lang-switch-link {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    min-width: 34px;
    padding: 5px 10px;
    font-family: 'Space Grotesk', sans-serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.04em;
    color: rgba(28,21,16,0.55);
    text-decoration: none;
    border-radius: 999px;
    transition: all 0.2s;
}
.lang-switch-link:hover { color: #1c1510; }
.lang-switch-link.active { background: #1c1510; color: #faf8f4; }

.lang-switch-mobile {
    display: flex;
    gap: 8px;
    padding: 0 24px 20px;
}
.lang-switch-mobile .lang-switch-link {
    flex: 1;
    justify-content: center;
    padding: 10px;
    background: rgba(28,21,16,0.05);
    border: 1px solid rgba(28,21,16,0.12);
    border-radius: 6px;
    color: rgba(28,21,16,0.65);
}
.lang-switch-mobile .lang-switch-link.active {
    background: #1c1510;
    border-color: #1c1510;
    color: #faf8f4;
}
</style>
