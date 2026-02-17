@props(['endpoint' => null])

{{-- Safe in production: the Vite plugin only registers the agentation entry
     point in development mode. This guard prevents the @vite directive from
     executing regardless, as a second layer of protection. --}}
@if(app()->environment('local'))
    <div
        id="agentation-root"
        @if($endpoint) data-endpoint="{{ $endpoint }}" @endif
    ></div>
    @vite('resources/vendor/agentation-laravel/agentation.js')
@endif
