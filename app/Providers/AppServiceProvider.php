<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Register the admin view namespace
        View::addNamespace('layouts', resource_path('views/admin/layouts'));
        
        // components location
        Blade::component('admin.components.application-logo', 'application-logo');
        Blade::component('admin.components.auth-session-status', 'auth-session-status');
        Blade::component('admin.components.danger-button', 'danger-button');
        Blade::component('admin.components.dropdown-link', 'dropdown-link');
        Blade::component('admin.components.dropdown', 'dropdown');
        Blade::component('admin.components.input-error', 'input-error');
        Blade::component('admin.components.input-label', 'input-label');
        Blade::component('admin.components.modal', 'modal');
        Blade::component('admin.components.nav-link', 'nav-link');
        Blade::component('admin.components.primary-button', 'primary-button');
        Blade::component('admin.components.responsive-nav-link', 'responsive-nav-link');
        Blade::component('admin.components.secondary-button', 'secondary-button');
        Blade::component('admin.components.text-input', 'text-input');

        // layouts location
        Blade::component('admin.layouts.app', 'app');
        Blade::component('admin.layouts.guest', 'guest');
        Blade::component('admin.layouts.navigation', 'navigation');
    }
}
