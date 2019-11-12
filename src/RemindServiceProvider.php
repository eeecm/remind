<?php

namespace Encore\Remind;

use Illuminate\Support\ServiceProvider;

class RemindServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function boot(Remind $extension)
    {
        if (! Remind::boot()) {
            return ;
        }

        if ($views = $extension->views()) {
            $this->loadViewsFrom($views, 'remind');
        }

        if ($this->app->runningInConsole() && $assets = $extension->assets()) {
            $this->publishes(
                [$assets => public_path('vendor/laravel-admin-ext/remind')],
                'remind'
            );
        }

        $this->app->booted(function () {
            Remind::routes(__DIR__.'/../routes/web.php');
        });
    }
}