<?php

namespace NicolaiBaaring\AgentationLaravel;

use Illuminate\Support\ServiceProvider;
use NicolaiBaaring\AgentationLaravel\View\Components\Agentation;

class AgentationServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'agentation');

        $this->publishes([
            __DIR__ . '/../resources/js' => resource_path('vendor/agentation-laravel'),
        ], 'agentation-assets');

        $this->app->resolving('blade.compiler', function ($blade) {
            $blade->component('agentation', Agentation::class);
        });
    }
}
