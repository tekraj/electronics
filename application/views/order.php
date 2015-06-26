<?php 

    // code for inserting paypal verification to database
  if(isset($_POST['business'])):
    if($_POST['business']== 'tekrajpant224-facilitator@gmail.com'):

      $mc_gross=$_POST['mc_gross'];
      $payer_email=$_POST['payer_email'];
      $verify_sign=$_POST['verify_sign'];
      $auth=$_POST['auth'];
      $receiver_id=$_POST['receiver_id'];
      $payment_date=$_POST['payment_date'];
      $payer_id=$_POST['payer_id'];
      $tax=$_POST['tax'];
      $payment_gross=$_POST['payment_gross'];
?>
<?php if($payment_gross == ($mc_gross+ $tax)): ?>

<script type="text/javascript">

  var paypalObj={
                  paypal_payer_email:'<?php echo $payer_email; ?>',
                  paypal_verify_sign:'<?php echo $verify_sign; ?>',
                  paypal_auth:'<?php echo $auth; ?>',
                  paypal_payer_id:'<?php echo $payer_id; ?>',
                  paypal_payment_date:'<?php echo $payment_date; ?>',
                  paypal_payment:'<?php echo $payment_gross; ?>'
                 }
    $.ajax({
      method:'POST',
      url:'<?php echo link_url.$title."/verifyPaypal"; ?>',
      data:paypalObj,
      success:function(data){
        var data=JSON.parse(data);
        if(data.status==true){
          alert('Your Order is Successfully Placed. We will contact you back');
          window.location.assign('<?php echo link_url; ?>');
        }
      }
    });
</script>
<?php endif; ?>

<?php
    endif;
  else:


 ?>
<div class="container">
<br><br>
<?php if ( isset($_SESSION['member'])): ?>
  <?php if( isset($_SESSION['cartId']) && count($_SESSION['cartId']) > 0 ): ?>
    <div class="panel panel-default">
      <div class="panel-heading"> Place Order</div>
      <div class="panel-body">
        <div class="row order-result">
          <div class="col-lg-6">
            <form role="form" method="post" action="" name="order">
              
              <div class="form-group">
                <i>Full Name</i>
                <input name="fullname" type="text" class="form-control" placeholder="Full Name..." required>
              </div>
               <div class="form-group">
               <i>Mobile</i>
                <input name="mobile" type="number" class="form-control" placeholder="Mobile" required>
              </div>          
              <div class="form-group">
                <i>Address</i>
                <input type="text" name="address" class="form-control" placeholder="Address...">
              </div>
              <div class="form-group">
                <i>Postal Code</i>
                <input type="text" name="postalcode" class="form-control" placeholder="Postal Code..">
              </div>
              <div class="form-group">
                <b>Payment Mode</b><br>
                <input type="radio" name="cod" id="cod" value="cash"><label for="cod"> &nbsp;&nbsp;&nbsp;Cash On Delivery</label><br>
                <input type="radio" name="cod" id="pap" value="paypal"><label for="cod"> &nbsp;&nbsp;&nbsp;Pay with Paypal</label>
              </div>
              <button name="order" type="submit" class="btn btn-default send-info" id="porder">Place Order</button>
              <button name="pay" type="submit" class="btn btn-default send-info" id="payorder">Pay with PayPal</button>
              <button type="reset" class="btn btn-default">Reset
              </button>
            </form>
          </div> 
          <div class="col-md-6">
            <h3>Cart Summary</h3>
            <table class="table">
              <thead>
                <tr>
                    <th>
                      Products
                    </th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total Price</th>
                </tr>
              </thead>
              <tbody>
                    <?php 
                    $totalPrice=0;
                    foreach($cartProduct as $myProduct):
                    ?>
                        <tr c_id="<?php echo $myProduct->id; ?>" class="c_id">
                        <td><?php echo $myProduct->name; ?></td>
                        <td><?php echo $myProduct->quantity; ?></td>
                        <td><?php echo $myProduct->price; ?></td>
                        <td class="subprice">
                            <?php
                                 echo $myProduct->price * $myProduct->quantity;
                                 $totalPrice=($myProduct->price * $myProduct->quantity) + $totalPrice;
                            ?>
                         </td>
                        </tr>
                    <?php endforeach; ?>
                    <tr>
                    <th><b>Grand Total</b></th>
                    <th></th>
                    <th></th>
                    <th id="grandTotal"><b><?php echo $totalPrice; ?></b></th>
                    </tr>
              </tbody>
            </table>
              <form name="confirmation" id="confirmation" method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
                <input type="hidden" name="business" value="tekrajpant224-facilitator@gmail.com">

                <input type="hidden" name="cmd" value="_xclick">
                <input type="hidden" name="rm" value="2">
                <input type="hidden" name="amount" value="<?php echo $totalPrice; ?>">
                <input type="hidden" name="return" value="<?php echo link_url; ?>order/success">
                <input type="hidden" name="cancel_return" value="<?php echo link_url ?>order/success">
                <input type="hidden" name="item_name" value="Shopping cart payment">
                <input type="hidden" name="currency_code" value="USD">
                <input type="hidden" name="no_note" value="0">

               </form>

          </div>         
        </div>
        <!-- /.row (nested) --> 
      </div>
      <!-- /.panel-body --> 
    </div>
    

  <?php else: ?>
    <h1>There are No Items on The cart</h1>
    <a href="<?php echo link_url; ?>" class="btn btn-primary">Continue Shopping</a>
  <?php endif; ?>
<?php else: ?>
<script type="text/javascript">
  window.location.assign('<?php echo link_url; ?>member/login');
</script>
<?php endif; ?>
</div>

<script type="text/javascript">
   
    $(document).ready(function(){

       $('button[type="submit"]').hide();

        $('input[name="cod"]').click(function(){

          if($('#cod').prop("checked")){
            $('#porder').show();
            $('#payorder').hide();
          }

          if($('#pap').prop("checked")){
            $('#porder').hide();
            $('#payorder').show();
          }
          
        });


        // ajax request for cash on delivery
        $('.send-info').click(function(e){
            var payButton=$(this).attr('id');

              e.preventDefault();

              var fullname=$('input[name="fullname"]').val(),

              mobile=$('input[name="mobile"]').val(),

              address=$('input[name="address"]').val(),

              postalcode=$('input[name="postalcode"]').val(),

              paymentmethod=$('input[name="cod"]:checked').val();

              var memberId='<?php echo $_SESSION["member"]->id; ?>';

              var productCartIds={};

              $('.c_id').each(function(key,val){
                var value=$(this).attr('c_id');
                productCartIds[key]=value;
              })

              var totalPrice='<?php echo $totalPrice; ?>';

              var orderDetail={
                                fullname:fullname,mobile:mobile,address:address,postalcode:postalcode,paymentmethod:paymentmethod,member_id:memberId,totalprice:totalPrice
              };

              var postobject={orderDetail:orderDetail,cartId:productCartIds};

              $.ajax({
                
                  method:'POST',
                  url:'<?php echo link_url; ?>order/placeorder',
                  data:postobject,
                  success:function(data){
                    var data=JSON.parse(data);
                    if(data.status==true){
                      if(payButton =='payorder'){

                        $('#confirmation').submit();
                        $('.panel').html('<h2>Please Wait. Redirecting to PayPal...</h2>')
                      }else{
                        alert('Your Order is placed');
                        window.location.assign('<?php echo link_url; ?>');
                      }
                      
                    }else{
                    $('#orderResult').html('Soory Some Error Occured Please Try Again');
                    }
                  }
              });

        });
      
      

    });

    </script>

  <?php endif; ?>

    


 








    
