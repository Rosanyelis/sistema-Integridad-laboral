<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Route;

class CheckRouteTemplatesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'route:check-templates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verificar que las rutas de routetemplates.php se carguen correctamente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('🔍 Verificando rutas de routetemplates.php...');
        
        // Rutas esperadas de routetemplates.php
        $expectedRoutes = [
            'peoples.index',
            'peoples.create',
            'peoples.store',
            'peoples.show',
            'peoples.edit',
            'peoples.update',
            'peoples.destroy',
            'roles.index',
            'roles.create',
            'roles.store',
            'roles.show',
            'roles.edit',
            'roles.update',
            'roles.destroy',
            'users.index',
            'users.create',
            'users.store',
            'users.show',
            'users.edit',
            'users.update',
            'users.destroy',
            'personal-references.index',
            'residence-information.index',
            'educational-skills.index',
            'work-experiences.index',
            'aspirations.index',
            'dashboard.index',
            'api.peoples.index',
            'utils.generate-code',
        ];
        
        $loadedRoutes = [];
        $missingRoutes = [];
        
        foreach ($expectedRoutes as $routeName) {
            if (Route::has($routeName)) {
                $loadedRoutes[] = $routeName;
            } else {
                $missingRoutes[] = $routeName;
            }
        }
        
        // Mostrar resultados
        $this->info("✅ Rutas cargadas: " . count($loadedRoutes));
        $this->info("❌ Rutas faltantes: " . count($missingRoutes));
        
        if (!empty($loadedRoutes)) {
            $this->info("\n📋 Rutas cargadas correctamente:");
            foreach ($loadedRoutes as $route) {
                $this->line("  ✓ {$route}");
            }
        }
        
        if (!empty($missingRoutes)) {
            $this->error("\n⚠️  Rutas faltantes:");
            foreach ($missingRoutes as $route) {
                $this->line("  ✗ {$route}");
            }
        }
        
        // Verificar archivo routetemplates.php
        $templateFile = base_path('routes/routetemplates.php');
        if (file_exists($templateFile)) {
            $this->info("\n📁 Archivo routetemplates.php encontrado: " . $templateFile);
        } else {
            $this->error("\n❌ Archivo routetemplates.php no encontrado: " . $templateFile);
        }
        
        // Verificar integración en bootstrap/app.php
        $bootstrapFile = base_path('bootstrap/app.php');
        if (file_exists($bootstrapFile)) {
            $content = file_get_contents($bootstrapFile);
            if (strpos($content, 'routetemplates.php') !== false) {
                $this->info("✅ Integración en bootstrap/app.php encontrada");
            } else {
                $this->error("❌ Integración en bootstrap/app.php no encontrada");
            }
        }
        
        // Mostrar resumen
        if (empty($missingRoutes)) {
            $this->info("\n🎉 ¡Todas las rutas se cargaron correctamente!");
        } else {
            $this->warn("\n⚠️  Algunas rutas no se cargaron. Verifica la configuración.");
        }
        
        return Command::SUCCESS;
    }
}
