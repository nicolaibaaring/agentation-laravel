# Laravel Agentation

A minimal Laravel wrapper for [Agentation](https://agentation.dev) — the visual feedback tool for AI coding agents. Annotate your UI during development and give agents structured selectors instead of vague descriptions.

Works with any Laravel frontend: Livewire, Alpine, Vue, or plain Blade. The React runtime is isolated and only loads in development.

## Requirements

- PHP 8.1+
- Laravel 10, 11, or 12
- Node.js and npm (for Vite asset compilation)
- Vite (default in Laravel 10+)

## Installation

**1. Install the Composer package**

```bash
composer require nicolaibaaring/agentation-laravel --dev
```

**2. Publish the JS assets**

```bash
php artisan vendor:publish --tag=agentation-assets
```

This copies the JS entry point to `resources/vendor/agentation-laravel/agentation.js`.

**3. Install npm dependencies**

```bash
npm install react react-dom agentation -D
```

**4. Add the Vite plugin**

Import the agentation plugin and add it alongside your existing Laravel plugin:

```js
import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import agentation from 'agentation-laravel/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        agentation(),
    ],
});
```

The plugin handles everything automatically — it registers the entry point and loads the React transform only during `npm run dev`. Running `npm run build` produces no React-related output in your production bundle.

**5. Add the component to your layout**

Place the component in your main layout, just before `</body>`:

```blade
<body>
    {{-- Your app content --}}

    <x-agentation />
</body>
```

That's it. Run `npm run dev` and the Agentation toolbar appears in the bottom-right corner of your local environment.

## Connecting to an MCP server

To sync annotations with an AI coding agent in real time, start the Agentation MCP server and pass the endpoint:

```bash
npx agentation-mcp server
```

```blade
<x-agentation endpoint="http://localhost:4747" />
```

For Claude Code, add the MCP server to your project config:

```bash
claude mcp add agentation -- npx agentation-mcp server
```

Or add to `.mcp.json`:

```json
{
    "mcpServers": {
        "agentation": {
            "command": "npx",
            "args": ["agentation-mcp", "server"]
        }
    }
}
```

## How it works

The package mounts a tiny, isolated React root that renders only the Agentation toolbar component. Your actual application code (Livewire, Alpine, Vue) is completely untouched. Agentation works by inspecting the DOM directly, so it can annotate any element on the page regardless of which framework rendered it.

The component includes two layers of environment protection: a `shouldRender()` guard on the PHP component class and an `@if(app()->environment('local'))` check in the Blade template. Nothing is rendered or loaded in production.

## Uninstalling

```bash
composer remove nicolaibaaring/agentation-laravel
npm uninstall react react-dom agentation
```

Remove the `agentation()` plugin from `vite.config.js`, the `<x-agentation />` tag from your layout, and the `resources/vendor/agentation-laravel/` directory.
