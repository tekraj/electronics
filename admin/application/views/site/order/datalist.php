<div class="panel panel-default">
  <div class="panel-heading"> Search <?php  echo ucfirst($title);?> </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12">
        <form role="form" action="<?php echo link_url.$title; ?>/search" method="post">
        <div class="col-lg-4">
          <div class="form-group">
            <label>Search By</label>
            <select name="searchby" class="form-control" id="searchby">
              <option value="">SELECT</option>
              <?php 
                  foreach($tableFields as $key=>$value): ?>
                  <option value="<?php echo $key; ?>"><?php echo ucfirst($value); ?></option>
              <?php endforeach;?>
            </select>
          </div>
          </div>
          <div class="col-lg-4">
          <div class="form-group">
            <label>Seach Keyword</label>
            <input name="searchkey" class="form-control" id="searchkey" placeholder="Enter keyword">
          </div>
          </div>
          
          <div class="col-lg-4">
          <div class="form-group">
            <br />
            <button type="submit" name="search" class="btn btn-default" id="searchButton">Search</button>
          </div>
          
          </div>
        </form>
      </div>
      
    </div>
    <!-- /.row (nested) --> 
  </div>
  <!-- /.panel-body --> 
</div>
<div class="panel panel-default">
  <div class="panel-heading"> List of <?php  echo ucfirst($title); ?>  </div>
  <!-- /.panel-heading -->
  <div class="panel-body">
    <div class="table-responsive">
      <table id="myTable" class="table table-striped" > 
        <thead>
          <tr>
            <?php foreach($tableFields as $value): ?>
                <th><?php echo $value; ?></th>
            <?php endforeach; ?>
            <th>View/Verify </th>
          </tr>
        </thead>
        <tbody>
          <?php
          if(count($tableData)>0):
           foreach($tableData as $value): ?>
            
            <tr>
              <?php foreach($tableFields as $key=>$val): ?>
                <td><?php echo $value->$key; ?></td>
              <?php endforeach; ?>
              <td>
               <a href="<?php echo link_url.$title; ?>/viewdata/<?php echo $value->id; ?>"  class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="View this row">
                  <i class="glyphicon glyphicon-eye-open"></i>
                </a>
                <a href="<?php echo link_url.$title; ?>/viewdetail/<?php echo $value->id; ?>"  class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Detail About Orders">
                  <i class="glyphicon glyphicon-zoom-in"></i>
                </a>
                </a>
                <?php if($value->status == 0): ?>
                <a href="<?php echo link_url.$title.'/verify/'.$value->id; ?>"  class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="" data-original-title="Verify Delivery And Payment">Verify Delivery
                  
                </a> 
                <?php else: ?>
                <button class="btn btn-success">Delivered<i class="glyphicon glyphicon-ok"></i></button>                       
                <?php endif; ?>         
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
      <div id="pagination"></div>
    </div>
    <!-- /.table-responsive --> 
  </div>
  <!-- /.panel-body --> 
</div>