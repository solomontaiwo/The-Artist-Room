<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
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

    // Direttiva blade per fare in modo che determinate logiche si vedano solo se l'utente è un admin
    public function boot()
    {
        Blade::directive('admin', function () {
            return "<?php if(auth()->check() && auth()->user()->is_admin): ?>";
        });

        Blade::directive('endadmin', function () {
            return '<?php endif; ?>';
        });
    }
}
