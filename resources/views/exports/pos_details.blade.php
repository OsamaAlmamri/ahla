<!DOCTYPE html>

<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body dir="rtl">
<div style="text-align: center" dir="rtl">
    <table style="table-layout: fixed; border-collapse: collapse; width: 100%">
        <tr>
            <td colspan="2"></td>
            <td colspan="3" rowspan="1">
                بيانات نقاط البيع
                :
            </td>
        </tr>
        <tr></tr>

        <tr></tr>
        <tr>
            <td colspan="2"> تاريخ الطباعة {{now()}}</td>
            <td colspan="1"></td>
            <td colspan="3"> تم الطباعة بواسطة {{auth()->user()->name}}</td>
        </tr>
        <tr></tr>
    </table>
    <table class="table" style="text-align: center">
        <thead>
        <th colspan="12">
            basic info
        </th>
        <th colspan="4">
            Zone info
        </th>
        <th colspan="5">
            Contact info
        </th>
        <th colspan="8">
            Work info
        </th>
        <th colspan="6">
            Needs
        </th>

        </thead>
    </table>
    <table class="table">
        <thead>

        <tr>
            @foreach($getCollomns as $col)
                <th style="{{$col['style'].$col['width']}}">{{$col['name']}}</th>
            @endforeach

        </tr>
        @foreach(json_decode($exportable)  as $data)
            <tr>
                @foreach($getCollomns as $key=>$col)
                    <td>{{$data->$key}}</td>
                @endforeach
            </tr>
        @endforeach

        </thead>

    </table>

</div>
</body>
</html>
