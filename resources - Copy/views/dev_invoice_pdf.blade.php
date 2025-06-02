<html>
    <head>
        <style>
            table {
                width:100%;
                margin-top:30px;
                padding:10px;                   
            }  
        </style>   
    </head>
    <body>
       <center> <img src="{{ URL::asset('public/front/assets/images/divano-logo.png') }}" alt=""  width="200" height="200"/> </center>

        <table style='border:1px solid #ccc;'>
            <thead><tr><th style="text-align:left;">Shipping info <hr style=""></th>
                <th style="text-align:left;">Shipping info <hr style=""></th></tr></thead>
            <tbody>
                <tr>
                <td style="width:50%">
                    @foreach ($shows as $key => $inv)
                    <span>Name : </span>{{$inv->fname}}<br><br>
                    <span>Contact No. : </span>{{$inv->phone}}<br><br>
                    <span>Email Id : </span>{{$inv->email}}<br><br>
                    <span>Code : </span>{{$inv->code}}<br><br>
                     @endforeach
                </td>
                <td>

                   @foreach ($shows as $key => $inv)
                    <span>City : </span>{{$inv->city}}<br><br>
                    <span>Address : </span>{{$inv->address_one}}<br><br>
                    <span>Company name : </span>{{$inv->company_name}}<br><br>
                     @endforeach
                </td>
                </tr>
            </tbody>
        </table>
        <table style="border:1px solid #ccc;">
            <thead><tr><th style="text-align:left;">Payment Details <hr style=""></th></tr></thead>
            <tbody>
              <tr>
                <td style="width:50%">
                    @foreach ($shows as $key => $inv)
                    <span>Order No. :</span>{{ $inv->order_id }}<br><br>
                    <span>Payment status: </span>{{ $inv->status }}<br><br>
                    <span>Order Date : </span>{{ $inv->date }}<br><br>
                    @endforeach
                    @foreach ($details as $key => $dd)
                    <span>Transaction ID :</span>{{ $dd->razorpay_payment_id }}<br><br>
                    @endforeach
                </td>
              </tr>
            </tbody>
        </table>
        <table>
            <thead style="border:1px solid #ccc">
                <tr>
                    <th>S No</th>
                    <th>Developer Name</th>
                    <th>Developer Image</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i=1;
                $price=0;
                foreach($show as $d) {
                $price+=$d->perhr; ?>
                <tr>
                    <td style="border:1px solid #ccc; padding:0px 10px 10px 35px;"> {{$i}}</td>
                    <td style="border:1px solid #ccc; padding:0px 10px 10px 35px;">{{$d->name}}</td>
                    <td style="border:1px solid #ccc; padding:0px 10px 10px 35px;"><img src="<?php echo URL::asset('public/upload/developer/'.$d->image); ?>" width="100" height="100" alt="Product Image"></td>
                    <td style="border:1px solid #ccc; padding:0px 10px 10px 35px;">{{$d->perhr}}</td>
                </tr>            
                <?php $i++;
                } ?>
                <tr><th colspan="6" style="text-align:right">Total Price : {{$price}}</th></tr>
            </tbody>
        </table>

