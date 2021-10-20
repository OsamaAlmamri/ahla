<?php

namespace App\Nova\Actions;

use Anaseqal\NovaImport\Actions\Action;

use App\Imports\ImportVisitors;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use KossShtukert\LaravelNovaSelect2\Select2;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\File;
use Laravel\Nova\Fields\Text;
use Maatwebsite\Excel\Facades\Excel;

class ImportDeveloperTargets extends Action
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Indicates if this action is only available on the resource detail view.
     *
     * @var bool
     */

    public $type;

    public function __construct($type = "targets")
    {
        $this->type = $type;
    }

    public $onlyOnIndex = true;

    /**
     * Get the displayable name of the action.
     *
     * @return string
     */
    public function name()
    {

        return __('Import  ' . $this->type);
    }

    /**
     * @return string
     */
    public function uriKey(): string
    {

        return 'import-' . $this->type;

    }


    /**
     * Perform the action.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        ini_set('max_execution_time', 0);

        Excel::import(new ImportVisitors( $fields->occasion_id), $fields->file);

//        Excel::import(new Pos2Import(), $fields->file);

        return Action::message('It worked!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {

        $pos = \App\Models\Occasion::where('id', '>', 0)
          ->get()->pluck('name', 'id');;
//


        return [
            Select2::make(__('Name '), 'occasion_id')
                ->placeholder('From Pos ')// Add this just if you want to customize the placeholder
                ->searchable()->options($pos)->displayUsingLabels()
                ->onlyOnForms()
                ->rules('required'),

            File::make('File')
                ->rules('required'),
        ];
    }
}
