<div class="panel panel-default">
  <div class="panel-heading">Add Stock to <?php echo $itemdata->name; ?></div>
  <div class="panel-body">
    <div class="row">
       <h3>Avialabe Stock of <?php echo $itemdata->name.' = '.$stockProduct; ?></h3> 
      <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo link_url.$title.'/addstock'; ?>" name="<?php echo $title.'-form' ?>" onsubmit="return stockValidation()">
          
          <div class="form-group">
            <i>Add more Items to the stock</i>
            <input name="id" type="hidden"  value="<?php echo $itemdata->id;?>">
            <input type="number" name="quantity" class="form-control" required>
          </div>
            <button name="stock" type="submit" class="btn btn-default">Add Stock</button>
          <button type="reset" class="btn btn-default">Reset
          </button>
        </form>
      </div>
      
    </div>
    <!-- /.row (nested) --> 
  </div>
  <!-- /.panel-body --> 
</div>

