@php
    $theme = env('APP_THEME', 'default');
@endphp

@if ($theme === 'prepharma')
    @include('prepharma.farmacia.index')
@else
    @include('default.farmacia.index')
@endif
