<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Monthwise Report</title>
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        
        table {
            border-collapse: collapse;
        }
        
        td,
        th {
            padding: 10px 15px;
            border: #ddd 1px solid;
            text-align: center;
        }
        
        .p0 {
            padding: 0;
        }
        
        .noBdr {
            border: 0;
        }
        
        .text-left {
            text-align: left;
        }
    </style>
</head>

<body>
    <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" style="font-family:Gotham, 'Helvetica Neue', Helvetica, Arial, sans-serif; color:#333; font-size:14px;">
        <tr>
            <td colspan="13" class="noBdr text-left">Daily Receipts and Sales</td>
        </tr>
        <tr>
            <td colspan="13" class="noBdr text-left">Name of Licence : <strong> {{$shop_name}}</strong></td>
        </tr>
        <tr>
            <td colspan="13" class="noBdr text-left">For The Month of :<strong> {{@$month}}</strong></td>
        </tr>
        <tr>
            <th rowspan="2" valign="top">Date</th>
            @forelse ($categories as $category)
                <th colspan="4">{{$category->name}} Bulk Litr.</th>
                {{-- <th colspan="4">Country Spirits Bulk Litr.</th>
                <th colspan="4">Beer Bulk Litr.</th> --}}
            @empty
                
            @endforelse
        </tr>
        <tr>
            @forelse ($categories as $category)
                <td>Opening</td>
                <td>Purchase</td>
                <td>Sale</td>
                <td>Closing</td>
            @empty
                
            @endforelse
            {{-- <td>Opening</td>
            <td>Purchase</td>
            <td>Sale</td>
            <td>Closing</td>
            <td>Opening</td>
            <td>Purchase</td>
            <td>Sale</td>
            <td>Closing</td> --}}
        </tr>
        @forelse ($items as $date => $item)
            <tr>
                <td>{{$date}}</td>
                @foreach ($item as $key=> $catval)
                    <td>{{@$catval['opening']}}</td>
                    <td>{{@$catval['purchase']}}</td>
                    <td>{{@$catval['sale']}}</td>
                    <td>{{@$catval['closing']}}</td>
                    
                @endforeach
            </tr>
            
        @empty
            
        @endforelse
        {{-- <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr>
        <tr>
            <td>01-Sep-22</td>
            <td>3136.415</td>
            <td>0.000</td>
            <td>181.175</td>
            <td>2955.240</td>
            <td>2365.200</td>
            <td>1200.000</td>
            <td>598.200</td>
            <td>2967.000</td>
            <td>3828.990</td>
            <td>0.000</td>
            <td>428.080</td>
            <td>3400.910</td>
        </tr> --}}
        
    </table>

</body>

</html>