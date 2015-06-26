<?php     
    if($template=='edit_content'){
      $editForm=true;
    }

 ?>

<div class="panel panel-default">
  <div class="panel-heading"> <?php echo "Add Content"; ?></div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12">
        <?php 
            if(isset($editForm)){
              $action=link_url.$title.'/updateContent/'.$itemdata->id; 
            }else{
              $action=link_url.$title.'/addContent';
            }


         ?>
         <form role="form" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" <?php echo $title.'-form'; ?> >
          <div class="col-lg-6">
            <div class="form-group">
              <i>Heading</i>
              <input name="content[heading]" type="text" class="form-control" placeholder="Heading..." value="<?php echo isset($editForm) ? $itemdata->heading: ''; ?>">
              <input type="hidden" value="content" name="content[type]">
            </div>
            <div class="form-group">
            <i>Category</i>
            <select name="content[cms_category_id]" class="form-control">
            <option>SELECT</option>
             <?php foreach($category as $value): ?>
                <option value="<?php echo $value->id; ?>" <?php if(isset($editForm)){if($itemdata->cms_category_id==$value->id){echo "selected";}} ?>><?php echo ucfirst($value->title); ?></option>
                <?php endforeach; ?>
            </select>
          </div>
             <div class="form-group">
             <i>SEO Description</i>
              <textarea name="content[seo_desc]" class="form-control" placeholder="SEO Description..." ><?php echo isset($editForm) ? $itemdata->seo_desc: ''; ?></textarea>
            </div>
            </div>
            <div class="col-lg-12">
            <div class="form-group">
             <i>Detail</i>
              <textarea name="content[content]" class="form-control ckeditor" placeholder="Detail..." style="overflow:auto;resize:none" id="content-detail"><?php echo isset($editForm) ? $itemdata->content: ''; ?></textarea>
            </div>
            </div>
            <div class="col-lg-6">

              <div class="form-group">

                <i>Insert Image</i>
                 <a onclick="BrowseServer()" class="btn btn-primary imageUpload">Select Images</a> 

              </div>

            <div class="form-group">
              <label>Status</label>
              
              <select name="content[status]" class="form-control" id="status">
                <option selected="selected" value="1" <?php if(isset($editForm)){if($itemdata->status=='1'){echo 'selected';}} ?> >Active</option>
                <option value="0" <?php if(isset($editForm)){if($itemdata->status=='0'){echo 'selected';}} ?>>In-active</option>
              </select>
            </div>
              <button name="create" type="submit" class="btn btn-default"><?php echo isset($editForm)? 'Update' : 'Create'; ?></button>
            <button type="reset" class="btn btn-default">Reset
            </button>

          </div>
        </form>
        
      </div>
      
    </div>
    <!-- /.row (nested) --> 
  </div>
  <!-- /.panel-body --> 
</div>


<script type="text/javascript">
  
  function BrowseServer(){
  // You can use the "CKFinder" class to render CKFinder in a page:
  var finder = new CKFinder();
  finder.basePath = '../';  // The path for the installation of CKFinder (default = "/ckfinder/").
  finder.selectActionFunction = newuploadImage;
  finder.popup();

  // It can also be done in a single line, calling the "static"
  // popup( basePath, width, height, selectFunction ) function:
  // CKFinder.popup( '../', null, null, SetFileField ) ;
  //
  // The "popup" function can also accept an object as the only argument.
  // CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
}


  function newuploadImage(url){
    var detailValue = CKEDITOR.instances['content-detail'].getData();
    detailValue+='<img src="'+url+'" >';
    CKEDITOR.instances['content-detail'].setData(detailValue);
  } 

  // function deleteImage end
</script>

 

