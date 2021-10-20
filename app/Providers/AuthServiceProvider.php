<?php

namespace App\Providers;


use App\Models\General\GeneralSettings;

use App\Models\General\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Actions\ActionEvent;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
//        ActionEvent::class        => ActionEventPolicy::class,
//
//        User::class               => UsersPolicy::class,
//
//        GeneralSettings::class    => GeneralSettingsPolicy::class,
//        Role::class               => RolesPolicy::class,
//        Permission::class         => PermissionsPolicy::class,


    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    }
}
