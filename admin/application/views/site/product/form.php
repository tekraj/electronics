<?php
     if($template=='add'){
       $formRole='create';
    }else{
      $formRole='edit';
      $formData=$itemdata;
      // print_r($itemdata);
    } 
?>
<div class="panel panel-default">
  <div class="panel-heading"> <?php echo ucfirst($formRole).'-'.ucfirst($title); ?></div>
  <div class="panel-body">
    <div class="row">
      <div class="col-lg-12">
        <form role="form" method="post" action="<?php echo isset($formData)? link_url.$title.'/update/'.$formData->id : link_url.$title.'/insertdata'; ?>" name="<?php echo $title.'-form' ?>" enctype="multipart/form-data">
          <div class="col-lg-6">
            <div class="form-group">
              <i>Name</i>
              <input name="product[name]" type="text" class="form-control" placeholder="Name..." value="<?php echo isset($formData)?$formData->name:''; ?>" id="beurl">
            </div>
             <div class="form-group">
              <i>URL</i>
              <input name="product[url]" type="text" class="form-control" placeholder="URL..." value="<?php echo isset($formData)?$formData->url:''; ?>" id="puturl">
            </div>
            <div class="form-group">
              <i>Category</i>
              <select name="product[category_id]" class="form-control" id="product_category" onchange="displayBrand(this)">
                <option>SELECT</option>
                <?php foreach( $category as $row): ?>
                  <option value="<?php echo $row->id; ?>" <?php if(isset($formData)){if($formData->category==$row->title){echo 'selected';}} ?>><?php echo ucfirst($row->title); ?></option>
                <?php endforeach; ?> 
              </select>
            </div>
            <div class="form-group">
              <i>Brand</i>
              <select name="product[brand_id]" class="form-control" id="product_brand">
                <option>SELECT</option>
                <?php if(isset($formData)): ?>
                 <?php foreach($brand as $row): ?>
                  <option value="<?php echo $row->id; ?>" <?php if($formData->brand_id==$row->id){echo 'selected';} ?>><?php echo ucfirst($row->name); ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
              </select>
            </div>
          
             <div class="form-group">
             <i>SEO Description</i>
              <textarea name="product[seoDesc]" class="form-control" placeholder="SEO Description..." ><?php echo isset($formData)?$formData->seoDesc:''; ?></textarea>
            </div>
         
 
            <div class="form-group">
             <i>Price</i>
              <input type="text" name="product[price]" class="form-control" placeholder="Price.." value="<?php echo isset($formData)?$formData->price:''; ?>">
            </div>
            </div>
          <div class="col-lg-12">
            <div class="form-group">
             <i>Detail</i>
              <textarea name="product[detail]" class="form-control ckeditor" placeholder="Detail..." style="overflow:auto;resize:none" ><?php echo isset($formData)?$formData->detail:''; ?></textarea>
            </div>
            </div>
            <div class="col-lg-6">

            <div class="form-group">                  

              <div class="col-md-12 featured_image">
                
                  <img src="<?php echo isset($formData) ? $formData->featured_image:''; ?>" class="img-responsive">
                  <a href="#" class="btn btn-primary add_featured_img"><?php echo isset($formData) ? "Edit Featured Image" : "Set Featured Image";  ?></a>                   
                                       
              </div>                    

            </div>
            <h1>...........................................</h1>
            </div>
            <div class="col-md-12 slider_image">
              <p>
                <i><b><?php echo isset($formData) ? "Edit" : "Add"; ?> Image For Product Image Slider</b></i>
              </p>
              <div class="col-md-3">
                <button class="btn btn-success show-it add_slider_img <?php if(isset($formData)){if($imageData[0]->image!='null'){echo "hide-it";}} ?>">Add Slider Image 1 <i class="glyphicon glyphicon-plus"></i></button>

                 <button class="btn btn-danger remove-img <?php if(isset($formData)){if($imageData[0]!='null'){echo "show-it";}else{echo "hide-it";}}else{echo "hide-it";} ?>">Remove Image <i class="glyphicon glyphicon-remove"></i></button>
                <img src="<?php if(isset($formData)){if($imageData[0]->image!='null'){echo $imageData[0]->image;}} ?>" class="img-responsive">

                <input type="hidden" name="slider[image1]" value="<?php if(isset($formData)){if($imageData[0]->image!='null'){echo $imageData[0]->image;}else{echo 'null';}}else{echo 'null';} ?>" class="hidden-img">

                <?php
                 if(isset($formData)){

                    if(isset($imageData[0])){ ?>

                    <input type="hidden" name="slider[id1]" value="<?php echo $imageData[0]->id; ?>">
                    <?php

                    }

                  }
                ?>
              </div>
              <div class="col-md-3">
                 <button class="btn btn-success show-it add_slider_img <?php if(isset($formData)){if($imageData[1]->image!='null'){echo "hide-it";}} ?>">Add Slider Image 2 <i class="glyphicon glyphicon-plus"></i></button>

                  <button class="btn btn-danger remove-img <?php if(isset($formData)){if($imageData[1]->image!='null'){echo "show-it";}else{echo "hide-it";}}else{echo "hide-it";} ?>">Remove Image <i class="glyphicon glyphicon-remove"></i></button>

                  <img src="<?php if(isset($formData)){if($imageData[1]->image!='null'){echo $imageData[1]->image;}} ?>" class="img-responsive">

                  <input type="hidden" name="slider[image2]" value="<?php if(isset($formData)){if($imageData[1]->image!='null'){echo $imageData[1]->image;}else{echo 'null';}}else{echo 'null';} ?>" class="hidden-img">

                  <?php
                   if(isset($formData)){

                      if(isset($imageData[1])){ ?>

                      <input type="hidden" name="slider[id2]" value="<?php echo $imageData[1]->id; ?>">
                      <?php

                      }

                    }
                  ?>
              </div>
              <div class="col-md-3">
                 <button class="btn btn-success show-it add_slider_img <?php if(isset($formData)){if($imageData[2]->image!='null'){echo "hide-it";}} ?>">Add Slider Image 3 <i class="glyphicon glyphicon-plus"></i></button>

                 <button class="btn btn-danger remove-img <?php if(isset($formData)){if($imageData[2]->image!='null'){echo "show-it";}else{echo "hide-it";}}else{echo "hide-it";} ?>">Remove Image <i class="glyphicon glyphicon-remove"></i></button>

                 <img src="<?php if(isset($formData)){if($imageData[2]->image!='null'){echo $imageData[2]->image;}} ?>" class="img-responsive">

                  <input type="hidden" name="slider[image3]" value="<?php if(isset($formData)){if($imageData[2]->image!='null'){echo $imageData[2]->image;}else{echo 'null';}}else{echo 'null';} ?>" class="hidden-img" class="hidden-img">

                  <?php
                   if(isset($formData)){

                      if(isset($imageData[2])){ ?>

                      <input type="hidden" name="slider[id3]" value="<?php echo $imageData[2]->id; ?>">
                      <?php

                      }

                    }
                  ?>
              </div>
              <div class="col-md-3">
                   <button class="btn btn-success show-it add_slider_img <?php if(isset($formData)){if($imageData[3]->image!='null'){echo "hide-it";}} ?>">Add Slider Image 4 <i class="glyphicon glyphicon-plus"></i></button>

                   <button class="btn btn-danger remove-img <?php if(isset($formData)){if($imageData[3]->image!='null'){echo "show-it";}else{echo "hide-it";}}else{echo "hide-it";} ?>">Remove Image <i class="glyphicon glyphicon-remove"></i></button>

                   <img src="<?php if(isset($formData)){if($imageData[3]->image!='null'){echo $imageData[3]->image;}} ?>" class="img-responsive">

                    <input type="hidden" name="slider[image4]" value="<?php if(isset($formData)){if($imageData[3]->image!='null'){echo $imageData[2]->image;}else{echo 'null';}}else{echo 'null';} ?>" class="hidden-img">

                    <?php
                     if(isset($formData)){

                        if(isset($imageData[2])){ ?>

                        <input type="hidden" name="slider[id4]" value="<?php echo $imageData[3]->id; ?>">
                        <?php

                        }

                      }
                    ?>
              </div>
            </div>
            <div class="col-md-6">
            
            <div class="form-group">


              <label>Status</label>
              
              <select name="product[status]" class="form-control" id="status">
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

  function addSliderImage(element){
  // You can use the "CKFinder" class to render CKFinder in a page:
  var finder = new CKFinder();
  finder.basePath = '../';  // The path for the installation of CKFinder (default = "/ckfinder/").
  finder.selectActionFunction =   function (url){
   
      if(!element.parent().hasClass('added')){
        element.parent().find('img').attr('src',url);
        element.parent().find('.hidden-img').val(url);
        element.parent().addClass('added');
        element.parent().find('.add_slider_img').removeClass('show-it').addClass('hide-it');
        element.parent().find('.remove-img').addClass('show-it').removeClass('hide-it');
        return false;
      }
    
   }
  finder.popup();

  // It can also be done in a single line, calling the "static"
  // popup( basePath, width, height, selectFunction ) function:
  // CKFinder.popup( '../', null, null, SetFileField ) ;
  //
  // The "popup" function can also accept an object as the only argument.
  // CKFinder.popup( { basePath : '../', selectActionFunction : SetFileField } ) ;
}

  $('.add_featured_img').click(function(){

    BrowseServer();
  });

  function newuploadImage(url){
    $('.featured_image').append('<input type="hidden" name="product[featured_image]" value="'+url+'">');
    $('.featured_image').find('img').attr('src',url);
  }

   // code for slider Image 
   $('.add_slider_img').click(function(e){
      e.preventDefault();
      addSliderImage($(this));
      
   })
   // 

   // 
   // function uploadSliderImage(url){
   //  $('.slider_image').find('.col-md-3').each(function(){
   //    if(!$(this).hasClass('added')){
   //      $(this).find('img').attr('src',url);
   //      $(this).find('input[type="hidden"]').val(url);
   //      $(this).addClass('added');
   //      $(this).find('.add_slider_img').removeClass('show-it').addClass('hide-it');
   //      $(this).find('.remove-img').addClass('show-it').removeClass('hide-it');
   //      return false;
   //    }
   //  })
    
   // }

   $('.slider_image').find('.remove-img').click(function(e){
    e.preventDefault();
    $(this).parent().find('img').attr('src','');
    $(this).parent().find('.hidden-img').val('null');
    $(this).parent().removeClass('added');
    $(this).removeClass('show-it').addClass('hide-it');
    $(this).parent().find('.add_slider_img').addClass('show-it').removeClass('hide-it');
   })
   // function displayBrand to display brand in brand select option according to category
  function displayBrand(element){
    $('#product_brand').html('<option>SELECT</option>');
    var category=$(element).find('option:selected').val();
    var brandData={categoryId:category};
    var brandUrl='<?php echo link_url.$title."/getCategoryBrand" ?>';
    $.ajax({
      method:'POST',
      url:brandUrl,
      data:brandData,
      success:function(data){
        if(data!='false'){
          var data=JSON.parse(data);

          for(option in data){

            $('#product_brand').append('<option value="'+data[option].id+'">'+data[option].name+'</option>');
          }
        }
      }
    });
  }
</script>

