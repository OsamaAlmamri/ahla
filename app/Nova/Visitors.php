<?php

namespace App\Nova;


use App\Models\Occasion;
use App\Nova\Actions\ImportDeveloperTargets;
use App\Nova\Resource;
use App\Nova\Visits\ProblemsCategories;
use AwesomeNova\Filters\DependentFilter;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Kristories\Qrcode\Qrcode;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;

class Visitors extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Visitor::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static $priority = 3;


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [];


    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {
//        'target', 'access_target', 'year', 'month'

        return [
            ID::make(__('ID'), 'id')->sortable(),
            BelongsTo::make(__('Occasion'), 'cccasion', Occoasions::class),


            Qrcode::make(__('qr_code'), 'qr_code')
                ->sortable()
                ->indexSize(50)
                ->detailSize(200)
                ->rules('required', 'max:191'),

            Text::make(__('name'), 'name')
                ->sortable()
                ->rules('required', 'max:191'),

            Text::make(__('email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:191'),
//is_login','have_food','food_time'
//            ,'login_time','is_send','occasion_id'
            Text::make(__('phone'), 'phone')
                ->sortable()
                ->rules('required', 'max:191'),

            Text::make(__('company'), 'company')
                ->sortable(),
            Boolean::make(__('is_send'), 'is_send')
                ->trueValue(1)->falseValue(0)
                ->sortable()->default(1),
            Boolean::make(__('have_food'), 'have_food')
                ->trueValue(1)->falseValue(0)
                ->sortable()->default(1),
            Boolean::make(__('is_login'), 'is_login')
                ->trueValue(1)->falseValue(0)
                ->sortable()->default(1),
            DateTime::make('login_time','login_time'),




        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */

    public function filters(Request $request)
    {
//        if (auth()->user()->type == "Supervisor")
//            $filters_arry = [
//                DependentFilter::make('Developer', 'user_id')
//                    ->withOptions(function (Request $request) {
//                        return \App\Models\General\User::where("id", ">", 0)
//                            ->supervisorDevelopers()
//                            ->pluck('name', 'id');
//                    }),
//            ];
//        elseif (auth()->user()->type == "SuperAdmin")
//            $filters_arry = [
//                DependentFilter::make('Supervisor', 'supervisor_id')
//                    ->withOptions(function (Request $request) {
//                        if (auth()->user()->type == "Supervcomisor")
//                            return [auth()->user()->name => auth()->user()->id];
//                        else
//                            return \App\Models\General\User::where("type", "Supervisor")->pluck('name', 'id');
//                    }),
//                DependentFilter::make('Developer', 'user_id')
//                    ->dependentOf('supervisor_id')
//                    ->withOptions(function (Request $request, $filters) {
//                        return \App\Models\General\User::where("id", ">", 0)
//                            ->supervisorDevelopers($filters['supervisor_id'])
//                            ->pluck('name', 'id');
//                    }),
//            ];
//        else
//            $filters_arry = [];
//
//        return array_merge($filters_arry, [
//
////            new  Year('developer_targets'),
////            new Month('developer_targets'),
//        ]);

        return  [
            DependentFilter::make('Occasion', 'occasion_id')
                ->withOptions(function (Request $request) {
                    return \App\Models\Occasion::where("id", ">", 0)
                        ->pluck('name', 'id');
                }),
        ];

    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [

        ];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            (new ImportDeveloperTargets('visitors')),
//            (new \App\Nova\Actions\Exports\ExcelExport('visitors', 'view', 'Export visitors')),
         (new \App\Nova\Actions\Exports\DeveloperTargetTemplate)


        ];
    }




}
