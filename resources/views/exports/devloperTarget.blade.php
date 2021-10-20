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
                هدف المنشطين
                @if ($year!="all")
                    سنة {{$year}}
                @endif
                @if ($month!="all")
                    شهر {{$month}}
                @endif
                :


            </td>
        </tr>
        <tr></tr>

        <tr></tr>
        <tr>
            <td colspan="4"> تاريخ الطباعة {{now()}}</td>
            <td colspan="2"></td>
            <td colspan="4"> تم الطباعة بواسطة {{auth()->user()->name}}</td>
        </tr>
        <tr></tr>
    </table>

    <table class="table">
        <thead>

        <tr>
            <th style="word-wrap: break-word; background: #00AEEF; width:15px">Month</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:15px">Year</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:25px">developer</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:25px">supervisor</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:15px">governorate</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:10px">target</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:15px">no of sold sims</th>
            <th style="word-wrap: break-word; background: #00AEEF; width:15px">rate</th>

        </tr>
        @foreach(json_decode($exportable)  as $data)
            <tr>
                <td>{{$data->month}}</td>
                <td>{{$data->year}}</td>
                <td>{{$data->developer_name}}</td>
                <td>{{$data->supervisor_name}}</td>
                <td>{{$data->governorate_name}}</td>
                <td>{{$data->target}}</td>
                <td>{{$data->no_of_sold_sims}}</td>
                <td>{{$data->rate}} %</td>

            </tr>
        @endforeach
        </thead>

    </table>


</div>
</body>
</html>
