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
                QR
                :
            </td>
        </tr>
        <tr></tr>

        <tr></tr>

        <tr></tr>
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
                    <td>{{$data->$key}}
{{--                        @if($key=='qr_code')--}}
{{--                            <img style="  max-width: 200px; margin: 10px;"--}}
{{--                                src="https://chart.googleapis.com/chart?cht=qr&chl={{$data->$key}}&chs=160x160&chld=L|0"--}}
{{--                                class="qr-code img-thumbnail img-responsive"/>--}}
{{--                    </td>--}}
{{--                    @endif--}}
                @endforeach
            </tr>
        @endforeach

        </thead>

    </table>


</div>
</body>
</html>
