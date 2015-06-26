<?php
     if($template=='add'){
       $formRole='create';
    }else{
      $formRole='edit';
      $formData=$itemdata;
    } 
?>
<div class="panel panel-default">
  <div class="panel-heading"> <?php echo ucfirst($formRole).'-'.ucfirst($title); ?></div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-6">
        <form role="form" method="post" action="<?php echo isset($formData)? link_url.$title.'/update/'.$formData->id : link_url.$title.'/insertdata'; ?>" name="<?php echo $title.'-form' ?>" >
          
          <div class="form-group">
            <i>Title</i>
            <input name="category[title]" type="text" class="form-control" placeholder="Title..." value="<?php echo isset($formData)?$formData->title:''; ?>" id="beurl">
          </div>
           <div class="form-group">
            <i>URL</i>
            <input name="category[url]" type="text" class="form-control" placeholder="URL..." value="<?php echo isset($formData)?$formData->url:''; ?>" id="puturl">
          </div>

           <div class="form-group">
           <i>SEO Description</i>
            <input name="category[seoDesc]" type="text" class="form-control" placeholder="SEO Description..." value="<?php echo isset($formData)?$formData->seoDesc:''; ?>">
          </div>          
          <div class="form-group">
            <label>Status</label>
            
            <select name="category[status]" class="form-control" id="status">
              <?php
                 $status=isset($formData)?$formData->status:1;
                  $active='selected="selected"';
                  $inactive='';
                  if($status==0){
                     $active='';
                     $inactive='selected="selected"';
                  }
            ?>
              <option selected="selected" value="1" <?php echo $active; ?>>Active</option>
              <option value="0" <?php echo $inactive; ?>>In-active</option>
            </select>
          </div>
          <?php if($formRole=='edit'): ?>
              <button name="create" type="submit" class="btn btn-default">Update <?php echo  ucfirst($title); ?></button>
          <?php else: ?>
            <button name="update" type="submit" class="btn btn-default">Create <?php echo  ucfirst($title); ?></button>
          <?php endif; ?>
          <button type="reset" class="btn btn-default">Reset
          </button>
        </form>
      </div>
      
    </div>
    <!-- /.row (nested) --> 
  </div>
  <!-- /.panel-body --> 
</div>

