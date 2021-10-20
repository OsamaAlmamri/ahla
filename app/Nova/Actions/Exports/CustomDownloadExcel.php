<?php

namespace App\Nova\Actions\Exports;

use App\Exports\UserInfoPrintDetails;
use Illuminate\Support\Facades\URL;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Http\Requests\ActionRequest;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\LaravelNovaExcel\Actions\ExportToExcel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class CustomDownloadExcel extends ExportToExcel
{
    /**
     * Get the displayable name of the action.
     *
     * @return string
     */


    public function name()
    {
        return $this->name ?? __('Download Excel');
    }

    /**
     * @param ActionRequest $request
     * @param Action $exportable
     *
     * @return array
     */

//    public function get_exported_data()
//    {
//        $data = new UserInfoPrintDetails();
//    }
//    public function get_exported_data ();
    public function get_exported_data()
    {
        // TODO: Implement get_exported_data() method.

    }

    public function handle(ActionRequest $request, Action $exportable): array
    {
        $data = $this->get_exported_data();
//        $data = new UserInfoPrintDetails($request->all());
//        return Excel::download($sal, "fingerprintDetails.xlsx");
        $response = Excel::download(
            $data,
            $this->getFilename(),
            $this->getWriterType()
        );


        if (!$response instanceof BinaryFileResponse || $response->isInvalid()) {
            return \is_callable($this->onFailure)
                ? ($this->onFailure)($request, $response)
                : Action::danger(__('Resource could not be exported.'));
        }

        return \is_callable($this->onSuccess)
            ? ($this->onSuccess)($request, $response)
            : Action::download(
                $this->getDownloadUrl($response),
                $this->getFilename()
            );
    }

    /**
     * @param BinaryFileResponse $response
     *
     * @return string
     */
    protected function getDownloadUrl(BinaryFileResponse $response): string
    {
        return URL::temporarySignedRoute('laravel-nova-excel.download', now()->addMinutes(1), [
            'path' => encrypt($response->getFile()->getPathname()),
            'filename' => $this->getFilename(),
        ]);
    }

    /**
     * @param ActionRequest $request
     * @param Action $exportable
     *
     * @return array
     */

}
