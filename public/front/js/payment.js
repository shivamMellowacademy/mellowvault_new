jQuery(document).ready(function($) {

    var options = {
        "key": "rzp_test_oGWqJW6LQBc9Gs", 
        "amount": "<?php echo $tprice*100 ; ?>",
        "currency": "INR",
        "name": "Mellow Element",
        "description": "Mellow Element",
        "image": "{{ URL::asset('public/front/assets/images/divano-logo.svg') }}",
        "handler": function (response){
        var v_token = "{{csrf_token()}}";
        console.log(response);
        $.ajax({
            type:"POST",
            url:"{{route('checkout')}}",
            data:{_token:v_token,name:name,email:email,phone:phone,purpose:purpose},
            success:function(res)
            {
                alert("successful");
            }
        });
        }
    };
    var rzp1 = new Razorpay(options);
    jQuery('#payment-form').on('submit',function(e){
        rzp1.open();
        e.preventDefault();
    }); 
});