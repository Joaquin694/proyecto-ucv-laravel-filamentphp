<x-filament-panels::page.simple>
    <style>
        body {
            background-image: url('{{ asset('ucvFondo.jpg') }}') !important;
            background-size: cover !important;
            background-position: center !important;
            height: 100vh !important;
            margin: 0 !important;
        }

        /* Fondo semi-transparente para el formulario */
        .filament-panels-form {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
        }

        /* Estilo rojo para el botón de login */
        button[type="submit"] {
            background-color: #dc2626 !important; /* Rojo */
            color: white !important;
            border: none !important;
            padding: 0.75rem 1.5rem !important;
            border-radius: 8px !important;
            font-weight: bold !important;
            cursor: pointer !important;
            transition: background-color 0.3s ease !important;
        }

        button[type="submit"]:hover {
            background-color: #b91c1c !important; /* Rojo más oscuro al pasar el mouse */
        }
    </style>

    @if (filament()->hasRegistration())
        <x-slot name="subheading">
            {{ __('filament-panels::pages/auth/login.actions.register.before') }}
            {{ $this->registerAction }}
        </x-slot>
    @endif

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_BEFORE, scopes: $this->getRenderHookScopes()) }}

    <x-filament-panels::form id="form" wire:submit="authenticate">
        {{ $this->form }}

        <x-filament-panels::form.actions
            :actions="$this->getCachedFormActions()"
            :full-width="$this->hasFullWidthFormActions()"
        />
    </x-filament-panels::form>

    {{ \Filament\Support\Facades\FilamentView::renderHook(\Filament\View\PanelsRenderHook::AUTH_LOGIN_FORM_AFTER, scopes: $this->getRenderHookScopes()) }}
</x-filament-panels::page.simple>
