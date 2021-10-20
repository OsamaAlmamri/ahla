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

    @yield("ReportHeader")
    <table style="table-layout: fixed; border-collapse: collapse; width: 100%">
        <thead>
        <tr>
            @foreach($cols as $col)
                @if(!( (isset($col['printable']) and $col['printable']==false)  ))
                    <th style="word-wrap: break-word; background: #00AEEF;" @if(isset($col['class'])) class="{{$col['class']}}" @endif >{{$col['title']}}</th>
                @endif
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($data as $user)
            <col span="1" style="width: 100px">
            <tr>
                @foreach($cols as $col)
                    @if(!( (isset($col['printable']) and $col['printable']==false)  ))
                        <td
                                style="word-wrap: break-word; width:{{ (isset($col['width']))?$col['width']:"8px"}}"
                                @if(isset($col['class'])) class="{{$col['class']}}"@endif
                        > {{ $user[$col['data']] }}</td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        @yield('additional_data')
        </tbody>
    </table>
</div>
</body>
</html>
