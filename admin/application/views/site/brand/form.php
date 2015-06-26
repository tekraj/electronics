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
        <form role="form" method="post" action="<?php echo isset($formData)? link_url.$title.'/update/'.$formData->id : link_url.$title.'/insertdata'; ?>" name="<?php echo $title.'-form' ?>" enctype="multipart/form-data" id="brand-form">
          
          <div class="form-group">
            <i>Name</i>
            <input name="brand[name]" type="text" class="form-control" placeholder="Name..." value="<?php echo isset($formData)?$formData->name:''; ?>" id="brand-beurl">
          </div>

          
          <div class="form-group">
            <i>Category</i>
            <select name="brand[category_id]" class="form-control" id="brand-cat">
            <option>SELECT</option>
             <?php foreach($category as $value): ?>
              <option value="<?php echo $value->id; ?>" <?php if(isset($formData)){if($formData->category_id==$value->id){echo "selected";}} ?>><?php echo ucfirst($value->title); ?></option>
              <?php endforeach; ?>
            </select>
          </div>
          <div class="form-group">
            <i>URL</i>
            <input name="brand[url]" type="text" class="form-control" placeholder="URL..." value="<?php echo isset($formData)?$formData->url:''; ?>" id="brand-puturl">
          </div>
           <div class="form-group">
           <i>SEO Description</i>
            <input name="brand[seoDesc]" type="seoDesc" class="form-control" placeholder="SEO Description..." value="<?php echo isset($formData)?$formData->seoDesc:''; ?>">
          </div> 
           <div class="form-group">
            <i>Brand Logo</i>
            <input name="image" type="file" class="form-control">
            <?php if($formRole=='edit'): ?>
              <img src="<?php echo $formData->image; ?>" class="img-responsive">
            <?php endif; ?>
          </div>         
          <div class="form-group">
            <label>Status</label>
            
            <select name="brand[status]" class="form-control" id="status">
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

<script type="text/javascript">

        $('#brand-cat').change(function(){

          var inputName= $('#brand-beurl').val();
          var optionValue=$(this).find('option:selected').text();
          var titleNames=inputName+' '+optionValue;
          var brandUrl=createUrl(titleNames);
          $('#brand-puturl').val(brandUrl);
        })


        $('#brand-form').submit(function(){
          var inputName= $('#brand-beurl').val();
          var optionValue=$('#brand-cat').find('option:selected').text();
          var titleNames=inputName+' '+optionValue;
          var brandUrl=createUrl(titleNames);
          $('#brand-puturl').val(brandUrl);
        })

        function createUrl(data){
          data=data.trim();
          data=data.replace(/[&\/\\#,+()$~%.'":*?@<>{}]/g,'-');
          data=data.replace(/\s{1,}/g, '-');
          data=data.replace(/-{2,}/g, '-');
          data=data.toLowerCase();
          return data;
        }
</script>

