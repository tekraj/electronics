<div class="panel panel-default">
  <div class="panel-heading">Verify Delivery And Payment</div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo link_url.$title.'/veriyorder' ?>">
          
          <div class="form-group">
            <i>Delivered By</i>
            <input name="delivery[name]" type="text" class="form-control" placeholder="Name..." value="<?php echo isset($formData)?$formData->name:''; ?>" id="beurl">
          </div>
           <div class="form-group">
            <i>Date</i>
              <input type="date" name="delivery[date]" class="form-control">
          </div>
          <input type="hidden" name="delivery[id]" value="<?php echo $itemdata->id; ?>">
          <button type="submit" class="btn btn-success">Veriry</button>
          <button type="reset" class="btn btn-default">Reset
          </button>
        </form>
      </div>
      
    </div>
    <!-- /.row (nested) --> 
  </div>
  <!-- /.panel-body --> 
</div>

