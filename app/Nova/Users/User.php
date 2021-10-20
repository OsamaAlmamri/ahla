<?php

namespace App\Nova\Users;

use App\Nova\Actions\Active;
use App\Nova\Actions\Deactive;
use App\Nova\Actions\Imports\ImportUsers;
use App\Nova\Resource;
use Eminiarts\NovaPermissions\Nova\Permission;
use Eminiarts\NovaPermissions\Nova\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Gravatar;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\MorphToMany;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\Text;
use Maatwebsite\LaravelNovaExcel\Actions\Exports\Developers;

class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\General\User::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'username';

    public static $displayInNavigation = true;

    public function __construct($resource)
    {
        parent::__construct($resource);
//        $this->middleware('permission:show teachers', ['only' => ['index']]);
//        $this->middleware('permission:manage documents', ['only' => ['create', 'edit', 'update', 'delete', 'deleteMulti']]);
//        $this->middleware('permission:manage deleted documents', ['only' => ['deleted', 'forceDelete', 'restore', 'delete']]);

    }


    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name', 'email', 'phone'
    ];

    public static $priority = 1;

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function fields(Request $request)
    {

        return [
            Gravatar::make('avatar', 'email')->maxWidth(50),



            Text::make(__('name'), 'name')
                ->sortable()
                ->rules('required', 'max:191'),

            Text::make(__('email'), 'email')
                ->sortable()
                ->rules('required', 'email', 'max:191')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

            Text::make(__('username'), 'username')
                ->sortable()
                ->rules('required', 'max:191')
                ->creationRules('unique:users,username')
                ->updateRules('unique:users,username,{{resourceId}}'),

            Password::make(__('password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8')->onlyOnForms(),


            Image::make(__('avatar'), 'avatar')
                ->disk('Root')
                ->store(function (Request $request, $model) {
                    $filename = Str::random(50) . '.' . $request->avatar->getClientOriginalExtension();
                    $request->avatar->move(public_path('/uploads/users/'), $filename);

                    return [
                        'avatar' => '/uploads/users/' . $filename,
                    ];
                })
                ->prunable()
                ->creationRules('image', 'mimes:png,jpeg,jpg,gif')
                ->updateRules('image', 'mimes:png,jpeg,jpg,gif')->hideFromIndex(),


            Text::make(__('phone'), 'phone')
                ->sortable(),
            Boolean::make(__('active'), 'active')->trueValue(1)->falseValue(0)->sortable()->default(1),


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
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
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


        ];
    }


}
