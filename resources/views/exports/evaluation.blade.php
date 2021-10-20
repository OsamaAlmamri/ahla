<!DOCTYPE html>

<html lang="ar">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body dir="rtl" style="text-align: right">
<div style="text-align: center" dir="rtl">
    <table style="table-layout: fixed; border-collapse: collapse; width: 100%">
        <tr>
            <td colspan="10"></td>
            <td colspan="3" rowspan="1">
                تقييم المنشطين لشهر
                {{$monthly->month}}
                سنة {{$monthly->year}}
                :
            </td>
        <tr>
            <td colspan="10"></td>
            <td colspan="3" style=" background:  #002060 ;color: white ; text-align: center "> معايير تقييم الأداء</td>
        </tr>
        <tr>
            <td colspan="10"></td>
            <td colspan="2" style=" background:  #002060 ;color: white ;">نسبة المبيعات الى الهدف</td>
            <td>{{$monthly->sales_percent}} %</td>
        </tr>
        <tr>
            <td colspan="10"></td>
            <td colspan="2" style=" background:  #002060 ;color: white ;">نسبة العقود الغير مسلمة الى المبيعات</td>
            <td>{{$monthly->contracts_percent}} %</td>
        </tr>
        <tr>
            <td colspan="10"></td>
            <td colspan="2" style=" background:  #002060 ;color: white ;">نسبة اعتماد نقاط بيع جديدة</td>
            <td>{{$monthly->new_pos_percent}} %</td>
        </tr>
        <tr>
            <td colspan="10"></td>
            <td colspan="2" style=" background:  #002060 ;color: white ;">نسبة نقاط البيع الخاملة الى اجمالي نقاط
                البيع
            </td>
            <td>{{$monthly->reassign_percent}} %</td>
        </tr>
        <tr>
            <td colspan="10"></td>
            <td colspan="2" style=" background:  #002060 ;color: white ;"> نسبة اعاده التخصيص من المبيعات</td>
            <td>{{$monthly->inactive_pos_percent}} %</td>
        </tr>

    </table>
    <table class="table">
        <thead>
        <tr>
        <th colspan="4" style="background: #bdd7ee">
            Developers Full Name
        </th>
        <th style="background: #bdd7ee">
            Developer Current Region
        </th>
        <th style="background: #bdd7ee">
            Monthly Sales Target
        </th>
        <th colspan="4" style="background: #bdd7ee">
            Supervisor
        </th>
        <th style="background: #bdd7ee">
            Total Stock
        </th>
        <th style="background: #bdd7ee">
            Total 2021 Sales
        </th>
        <th style="background: #bdd7ee">
            Total Pending Contracts
        </th>

        <th style="background: #bdd7ee">
            Sales % to Target

        </th>

        <th style="background: #a9d08e">
            Sales Evaluation


        </th>
        <th  style="display: inline-block; background: #bdd7ee">
            2020 contracts achived % to 2021 sales

        </th>



        <th style="background: #a9d08e">
            contracts achived Evaluation
        </th>

        <th style="background: #bdd7ee">
            No.POS
        </th>

        <th style="background: #bdd7ee" >
            New pos %to Target
        </th>

        <th style="background: #a9d08e">
            % to new to %
        </th>

        <th style="background: #bdd7ee">
            Reassing
        </th>

        <th style="background: #bdd7ee">
            Ressign to Sales
        </th>

        <th style="background:#a9d08e">
            % to reassing to %
        </th>

        <th style="background: #bdd7ee">
            sales less than 10
        </th>

        <th style="background: #bdd7ee">
            All pos
        </th>

        <th style="background: #bdd7ee">
            Zero sales to all pos
        </th>

        <th style="background: #a9d08e">
            Pos Sales zero
        </th>

        <th style="background:#a9d08e">
            Final Rate
        </th>
        </tr>

        </thead>
        <tbody>
        @foreach($exportable as $data)
            <tr>
                <td colspan="4" >

                    {{$data->developer_name}}
                </td>
                <td>
                    {{$data->governorate_name}}
                </td>
                <td>
                    {{$data->target}}
                </td>
                <td colspan="4">

                    {{$data->supervisor_name}}
                </td>
                <td>
                    {{$data->stocks}}
                </td>

                <td>
                    {{$data->sales}}
                </td>
                <td>
                    {{$data->pending_contracts}}
                </td>

                <td>
                    {{$data->sales_to_target}}%

                </td>
                <td style="background: #a9d08e">
                    {{$data->sales_evaluation}}%
                </td>


                <td >
                    {{$data->contracts_achived_evaluation}}%
                </td>

                <td style="background: #a9d08e">
                    {{$data->contracts_achived_evaluation}}%
                </td>

                <td>
                    {{$data->new_pos}}
                </td>

                <td >
                    {{$data->new_pos_to_target}}%
                </td>

                <td style="background: #a9d08e">
                    {{$data->new_pos_evaluation}}
                </td>

                <td>
                    {{$data->reassign_contracts}}
                </td>


                <td>
                    {{$data->reassign_to_sales}}%
                </td>

                <td style="background:#a9d08e" >
                    {{$data->reassign_evaluation}}%


                </td>

                <td>
                    {{$data->inactive_pos}}
                </td>

                <td>
                    {{$data->all_pos}}
                </td>

                <td>
                    {{$data->zero_sales_to_all_pos}} %
                </td>

                <td  style="background:#a9d08e" >
                    {{$data->inactive_pos_evaluation}}%
                </td>

                <td style="background:#a9d08e" >
                    {{$data->final_rate}} %
                </td>

            </tr>
        @endforeach

        </tbody>
    </table>

</div>
</body>
</html>
