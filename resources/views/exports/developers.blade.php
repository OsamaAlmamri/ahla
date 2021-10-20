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
                بيانات المنشطين
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

    <table class="table">
        <thead>
        <tr>
            <th style="word-wrap: break-word; background: #00AEEF; width:25px">name</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:20px">username</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:20px">phone</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:25px">email</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:25px">supervisor</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:20px">region</th>
        </tr>
        @foreach(json_decode($exportable)  as $data)
        <tr>
            <td>{{$data->name}}</td>
            <td>{{$data->username}}</td>
            <td>{{$data->phone}}</td>
            <td>{{$data->email}}</td>
            <td>{{$data->supervisor}}</td>
            <td>{{$data->region}}</td>

        </tr>
            @endforeach
        </thead>

    </table>
    {{--    cookie('name', 'value', $minutes);--}}

{{--    {{dd($exportable)}}--}}
{{--    {{dd( Cookie::get('supervisor'))}}--}}



</div>
</body>
</html>
