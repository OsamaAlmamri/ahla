<?php

namespace App\Providers;

use Anaseqal\NovaImport\NovaImport;


use App\Nova\GeneralSettings;
use CodencoDev\NovaGridSystem\NovaGridSystem;

use DigitalCreative\CollapsibleResourceManager\CollapsibleResourceManager;
use DigitalCreative\CollapsibleResourceManager\Resources\InternalLink;
use DigitalCreative\CollapsibleResourceManager\Resources\NovaResource;
use DigitalCreative\CollapsibleResourceManager\Resources\TopLevelResource;
use Illuminate\Support\Facades\Gate;
use Joedixon\NovaTranslation\NovaTranslation;

use Laravel\Nova\Nova;
use App\Nova\Metrics\NewUsers;
use App\Nova\Metrics\TotalUsers;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */


    public function boot()
    {
        parent::boot();

//        Nova::serving(function () {
//            $default_lang = isset(auth()->user()->default_lang) && auth()->user()->default_lang ? auth()->user()->default_lang : 'ar';
//            app()->setLocale("en");
//        });
//
//        Nova::sortResourcesBy(function ($resource) {
//            return $resource::$priority ?? 999;
//        });
        Nova::style("custom-theme", ("css/custom.css"));
//        Nova::style("custom-theme", ("G:/sites/Sabafon_Laravel/public/css/custom.css"));
    }

    /**
     * /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
        // Gate::define('viewNova', function ($user) {
        //     if( !$user->isSuperAdmin() ) {
        //         abort(redirect('/dashboard')->with('warning', 'You do not have permission to access this page!'));
        //     }
        //     return true;
        // });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */

    public function cards()
    {


        return [

      //      (new NewUsers)->help('This is calculated using all users that are active and not banned.'),
        //    (new TotalUsers)->help(view('Metrics.users')->render()),
         //            (new allDevelopers)->help('This is calculated using all users that are active and not banned.'),
        ];
    }



    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
//            (new \App\Nova\Dashboards\Pos211Call()),
//            (new General)
//                ->canSee(function ($request) {
//                return $request->user()->can('GeneralDashBoard', \App\Models\General\User::class);
//            }),

//            (new Statistics)->canSee(function ($request) {
//                return $request->user()->can('StaticsDashBoard', User::class);
//            }),
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
//            new NovaTelescope,
new NovaImport,
//new CollapsibleResourceManager([
//    'remember_menu_state' => true, // default
//    'navigation'          => [
//        TopLevelResource::make([
//            'label'     => 'Accounts ',
//            'expanded'  => false,
//            'resources' => [
//
//                NovaResource::make(\App\Nova\Users\User::class)->canSee(function ($request) {
//return 1;
//                }),
//
//                //                            Group::make(...),
//                //                            LensResource::make(...),
//                //                            InternalLink::make(...),
//                //                            ExternalLink::make(...),
//                //                            RawResource::make(...)
//            ]
//        ])->icon('<svg class="sidebar-icon" id="Capa_1" enable-background="new 0 0 512 512" height="25" viewBox="0 0 512 512" width="25" xmlns="http://www.w3.org/2000/svg"><circle cx="256" cy="40" fill="#4bc0ff" r="40"/><path d="m279.802 110h-47.604c-18.364 0-34.369 12.504-38.812 30.323l-9.29 37.258c-1.573 6.31 3.2 12.419 9.703 12.419h124.401c6.503 0 11.276-6.109 9.703-12.419l-9.29-37.258c-4.442-17.819-20.447-30.323-38.811-30.323z" fill="#4bc0ff"/><path d="m296 40c0-22.091-17.909-40-40-40v80c22.091 0 40-17.909 40-40z" fill="#0592fd"/><path d="m327.903 177.581-9.29-37.258c-4.442-17.819-20.447-30.323-38.811-30.323h-23.802v80h62.201c6.503 0 11.276-6.109 9.702-12.419z" fill="#0592fd"/><path d="m56 301c-.011 0-.021 0-.033 0-8.284-.018-14.985-6.748-14.968-15.032.123-57.246 22.488-111.068 62.974-151.554 5.857-5.858 15.355-5.858 21.213 0s5.858 15.355 0 21.213c-34.836 34.836-54.08 81.149-54.186 130.405-.018 8.274-6.73 14.968-15 14.968z" fill="#466288"/><path d="m455.999 301c-8.27 0-14.981-6.694-14.999-14.968-.106-49.257-19.351-95.569-54.187-130.406-5.858-5.858-5.858-15.355 0-21.213 5.857-5.858 15.355-5.858 21.213 0 40.485 40.485 62.85 94.308 62.974 151.554.018 8.284-6.684 15.015-14.968 15.032-.011.001-.022.001-.033.001z" fill="#354a67"/><path d="m256 501.467c-14.362 0-28.725-1.449-42.987-4.348-8.119-1.649-13.362-9.567-11.713-17.687 1.649-8.118 9.563-13.366 17.687-11.712 24.561 4.991 49.467 4.991 74.026 0 8.126-1.653 16.038 3.595 17.687 11.712 1.65 8.119-3.594 16.037-11.712 17.687-14.263 2.899-28.626 4.348-42.988 4.348z" fill="#466288"/><path d="m232.846 356.577c-3.839 0-7.678-1.465-10.606-4.394l-26.846-26.846c-5.858-5.857-5.858-15.355 0-21.213 5.857-5.857 15.355-5.857 21.213 0l16.239 16.239 62.548-62.548c5.857-5.858 15.355-5.858 21.213 0 5.858 5.857 5.858 15.355 0 21.213l-73.154 73.154c-2.93 2.93-6.768 4.395-10.607 4.395z" fill="#466288"/><circle cx="72.205" cy="362" fill="#e25a6e" r="40"/><path d="m96.007 432h-47.604c-18.364 0-34.369 12.504-38.812 30.323l-9.29 37.258c-1.573 6.31 3.2 12.419 9.703 12.419h124.401c6.503 0 11.276-6.109 9.703-12.419l-9.29-37.258c-4.442-17.819-20.447-30.323-38.811-30.323z" fill="#e25a6e"/><path d="m112.205 362c0-22.091-17.909-40-40-40v80c22.092 0 40-17.909 40-40z" fill="#d62f44"/><path d="m144.109 499.581-9.29-37.258c-4.443-17.819-20.448-30.323-38.812-30.323h-23.802v80h62.201c6.503 0 11.276-6.109 9.703-12.419z" fill="#d62f44"/><circle cx="439.795" cy="362" fill="#a3ce29" r="40"/><path d="m463.597 432h-47.604c-18.364 0-34.369 12.504-38.812 30.323l-9.29 37.258c-1.573 6.31 3.2 12.419 9.703 12.419h124.401c6.503 0 11.276-6.109 9.703-12.419l-9.29-37.258c-4.442-17.819-20.447-30.323-38.811-30.323z" fill="#a3ce29"/><path d="m479.795 362c0-22.091-17.909-40-40-40v80c22.091 0 40-17.909 40-40z" fill="#8eba05"/><path d="m511.698 499.581-9.29-37.258c-4.443-17.819-20.447-30.323-38.811-30.323h-23.802v80h62.201c6.502 0 11.275-6.109 9.702-12.419z" fill="#8eba05"/><g fill="#354a67"><path d="m316.606 257.816c-5.857-5.858-15.355-5.858-21.213 0l-39.393 39.394v42.426l60.606-60.606c5.859-5.858 5.859-15.356 0-21.214z"/><path d="m310.699 479.433c-1.648-8.117-9.561-13.365-17.687-11.712-12.279 2.496-24.646 3.743-37.013 3.743v30.003c14.362 0 28.725-1.449 42.987-4.348 8.119-1.649 13.364-9.567 11.713-17.686z"/></g></svg>'),
//
//
//        TopLevelResource::make([
//            'label'     => 'Settings',
//            'expanded'  => false,
//            'resources' => [
//
//                NovaResource::make(GeneralSettings::class)
//
//
//            ]
//        ]),
//
//
//    ]
//]),




//            new SwitchLocale([
//                "locales" => [
//                    "ar" => __('AR'),
//                    "en" => __('EN')
//                ],
//                "useFallback" => true,
//                "customDetailToolbar" => true //optional
//            ]),
//                new NovaTranslation,
new NovaGridSystem,
//           new OsamaBelongsToDepend,

//            new CollapsibleResourceManager([
//                'disable_default_resource_manager' => true, // default
//                'remember_menu_state' => true, // default
//                'navigation' => [
//                    TopLevelResource::make([
//                        'label' => 'Resources',
//                        'resources' => [
//                            \App\Nova\User::class
//                        ]
//                    ]),
//                ]
//            ])

        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {


    }

    protected function registerTools()
    {
        Nova::tools([
            new NovaTranslation,
        ]);
    }

}
