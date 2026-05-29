<?php

declare(strict_types=1);

namespace BagasTopati\FormBuilder;

use Illuminate\Support\ServiceProvider;

class FormBuilderServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(
            $this->packagePath('config/form-builder.php'),
            'form-builder'
        );

        $this->app->singleton(FormBuilderFactory::class, function ($app) {
            return new FormBuilderFactory($app);
        });

        $this->app->alias(FormBuilderFactory::class, 'form-builder');
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    $this->packagePath('config/form-builder.php') => config_path('form-builder.php'),
                ],
                'form-builder-config'
            );
        }
    }

    protected function packagePath(string $path = ''): string
    {
        return __DIR__ . '/../' . $path;
    }
}
