@extends('exports.reportsLayout')
@section('customCss')
    <style>
    </style>
@endsection
@section('ReportHeader')
    <table style="table-layout: fixed; border-collapse: collapse; width: 100%">
        <tr>
            <td colspan="2"></td>

            <td colspan="3" rowspan="1">
              بيانات الموظفين

            </td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2"> الادارة : {{($main_department=="all")?trans('app.all'):App\Team::find($main_department)->team_name}}</td>
            <td colspan="1"></td>
            <td colspan="2"> القسم : {{($department=="all")?trans('app.all'):App\Team::find($department)->team_name}}</td>
        </tr>
        <tr></tr>
        <tr>
            <td colspan="1"></td>
            <td colspan="2"> تاريخ الطباعة {{now()}}</td>
            <td colspan="1"></td>
            <td colspan="3"> تم الطباعة بواسطة {{auth()->user()->name}}</td>
        </tr>
        <tr></tr>
    </table>
@endsection
@section('additional_data')

@endsection
