<div class="panel panel-default">
  <div class="panel-heading"> Details of Order No <?php  echo ucfirst($itemdata->order_id); ?>  </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped" > 
        <thead>
          <tr>
            <?php foreach($orderFields as $value): ?>
                <th><?php echo $value; ?></th>
            <?php endforeach; ?>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($orderDetail)>0):
           foreach($orderDetail as $value): ?>
            
            <tr>
              <?php foreach($orderFields as $key=>$val): ?>
                <td><?php echo $value->$key; ?></td>
              <?php endforeach; ?>
          <?php
            endforeach;
             else:
           ?>
         <tr><th>No data Found</th></tr>
       <?php endif; ?>
        </tbody>
      </table>
      <div id="pagination"></div>
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>