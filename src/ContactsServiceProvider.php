<?php
/**
 * Class ContactsServiceProvider
 *
 * @author Del
 */
namespace Delatbabel\Contacts;

use Delatbabel\Contacts\Commands\Geocode;
use Delatbabel\Keylists\KeylistsServiceProvider;
use Delatbabel\NestedCategories\NestedCategoriesServiceProvider;
use Illuminate\Support\ServiceProvider;

/**
 * Class ContactsServiceProvider
 *
 * Service providers are the central place of all Laravel application bootstrapping.
 * Your own application, as well as all of Laravel's core services are bootstrapped
 * via service providers.
 *
 * @see  Illuminate\Support\ServiceProvider
 * @link http://laravel.com/docs/5.1/providers
 */
class ContactsServiceProvider extends ServiceProvider
{
    /** @var array list of commands to be registered in the service provider */
    protected $moreCommands = [
        Geocode::class,
    ];

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path() . '/migrations'
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/../database/seeds' => database_path() . '/seeds'
        ], 'seeds');
        $this->publishes([
            __DIR__ . '/../config' => config_path()
        ], 'config');

        // Old versions of the views which are loaded from resource/views.
        // Should not need this because we will load views from the database, unless you
        // have decided not to use viewpages to store views in the database.
        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views')
        ], 'views');

        // Register other providers required by this provider, which saves the caller
        // from having to register them each individually.
        $this->app->register(NestedCategoriesServiceProvider::class);
        $this->app->register(KeylistsServiceProvider::class);

        // Define all commands
        $this->commands($this->moreCommands);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
