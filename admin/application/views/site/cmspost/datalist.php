<div class="panel panel-default">
  <div class="panel-heading"> List of Articles  </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped" > 
         <thead>
          <tr>
            <?php foreach($tableFields as $value): ?>
                <th><?php echo $value; ?></th>
            <?php endforeach; ?>
            <th>Edit/Delete</th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($allData)>0):
           foreach($allData as $value): ?>
            
            <tr>
              <?php foreach($tableFields as $key=>$val): ?>
                <td><?php echo $value->$key; ?></td>
              <?php endforeach; ?>
              <td>
               </a><a href="<?php echo link_url.$title.'/viewdata/'.$value->id;?>" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="View this row">
                  <i class="glyphicon glyphicon-eye-open"></i>
                </a>

                <a href="<?php echo link_url.$title.'/edit_'.$value->type.'/'.$value->id; ?>" class="btn btn-primary btn-circle updateIt" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit this row">
                  <i class="fa fa-edit"></i>
                </a>
                <a href="<?php echo link_url.$title.'/delete/'.$value->id; ?>" class="btn btn-danger btn-circle del_item" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete this row" onclick="return confirm('Do you want to delete this Item')">                              
                  <i class="glyphicon glyphicon-trash"> </i>
                  </a>                 
               
                   
                             
                </td>
            </tr>
          <?php
            endforeach;
             else:
           ?>
         <tr><th>No data Found</th></tr>
       <?php endif; ?>
        </tbody>
      </table>
  
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>