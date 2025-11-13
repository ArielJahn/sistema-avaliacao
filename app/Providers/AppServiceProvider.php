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

    /**
     * Bootstrap any application services.
     * Inicia diretiva do blade (Função que determina a cor do input[radio] de resposta)
     */
    public function boot(): void
    {
        Blade::directive('colorForNote', function ($expression) {
            return "
                <?php
                    echo (
                        function(int \$note, int \$min = 0, int \$max = 10): string {
                            if (\$max - \$min == 0) {
                                return 'hsl(0, 85%, 50%)';
                            }

                            \$percentage = (\$note - \$min) / (\$max - \$min);

                            \$hue = \$percentage * 120;

                            return \"hsl({\$hue}, 85%, 50%)\";
                        }
                    )($expression);
                ?>
            ";
        });
    }
}