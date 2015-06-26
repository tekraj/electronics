<?php 
    
      if($template=='edit_slider'){
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
            $action= link_url.$title.'/updateSlider';
          }else{
            $action=link_url.$title.'/addSlider';
          }

       ?>
         <form role="form" method="post" action="<?php echo $action; ?>" enctype="multipart/form-data" <?php echo $title.'-form'; ?> >
              <div class="col-md-12">
                <div class="form-group col-md-6">
                <i>Heading</i>
                  <input type="text" name="heading" class="form-control" placeholder="Heading..." value="<?php echo isset($editForm) ? $itemdata->heading : ''; ?>">
                </div>
                <div class="form-group col-md-6">
                <i>Category</i>
                <select name="" class="form-control" id="post_cat">
                <option>SELECT</option>
                <?php foreach($category as $value): ?>
                <option value="<?php echo $value->id; ?>" <?php if(isset($editForm)){if($itemdata->cms_category_id==$value->id){echo "selected";}} ?>><?php echo ucfirst($value->title); ?></option>
                <?php endforeach; ?>
                </select>
                </div>
              </div>

              <?php if(isset($editForm)): ?>
                <div class="col-md-12">
                  <h2>Content</h2>
                  <div class="col-md-6 old-content">
                    <?php echo $itemdata->content; ?>
                  </div>
                  <button class="btn btn-primary remove-old">Remove Old Content</button>
                </div>
              <?php endif; ?>
               <div class="form-group">
                <h3><i>Add Images for slider</i></h3>
                    <ul id="slider_image_ul">
                         <li>
                              <a href="#" class="btn btn-success add-img">Add New Image <i class="glyphicon glyphicon-plus-sign"></i></a>

                              <div class="img-detail">

                                   <div class="col-md-6">

                                         <label>Image Note Heading</label>
                                         <input type="text" class="form-control">
                                         <label>Image Note</label>
                                         <textarea class="form-control"></textarea>
                                         <br><br>
                                         <a href="#" class="btn btn-danger remove-img">Remove Image <i class="glyphicon glyphicon-remove-sign"></i></a>

                                   </div>

                                  <div class="col-md-6">

                                        <img src="" class="img-responsive">
                                        <p>
                                             <br><br><br>
                                             <a  href="#" class="btn btn-primary imageUpload" onclick="BrowseServer()">Select Images</a>
                                        </p>

                                  </div>
                                  <div style="clear:both;"></div>
                              </div>
                         </li>
                    </ul>
               </div>
              <br><br>
               <div class="clear"></div>
               <div class="col-md-6">
                    <div class="form-group">
                   <label>Status</label>
                   
                   <select name="content[status]" class="form-control" id="status">
                     <option selected="selected" value="1" >Active</option>
                     <option value="0">In-active</option>
                   </select>
                 </div>
                   <button name="create" type="submit" class="btn btn-default submit"><?php echo isset($editForm) ? 'Update Slider' : 'Create New Slider'; ?></button>
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
  $('#slider_image_ul').on('click','.add-img',function(e){
    e.preventDefault();
    $(this).parent().addClass('opendiv');
  })

  $('#slider_image_ul').on('click','.remove-img',function(e){
      e.preventDefault();
      addImage.removeImage();
    $(this).parent().parent().parent().remove();  
    
  });

  $('.remove-old').click(function(e){
    e.preventDefault();
    $('.old-content').html('');
  })
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
    addImage.addToDom(url);
  } 

  var addImage={
    count:0,
    addToDom:function(urls){


      var liHtml=$('#slider_image_ul').find('li:eq('+this.count+')').html();

      $('#slider_image_ul').find('li:eq('+this.count+')').find('.img-detail').find('img').attr('src',urls);

      $('#slider_image_ul').find('li:eq('+this.count+')').find('.add-img').hide();

      $('#slider_image_ul').find('li:eq('+this.count+')').find('.img-detail').find('.imageUpload').hide();

      $('#slider_image_ul').find('li:eq('+this.count+')').find('.remove-img').show();

      var newLiHtml=$('<li>'+liHtml+'</li>');
      $('#slider_image_ul').append(newLiHtml);
      this.count++;
    },
    removeImage:function(){
      this.count -=1;
    }
  }


// function to get the content of the input fields 

function getContents(){

     var totalLi=$('#slider_image_ul').find('li').length;
     var ulHtml='<ul>';
     for(var i=0; i<(totalLi-1); i++){
          var currentList=$('#slider_image_ul').find('li:eq('+i+')');
          var heading=currentList.find('input[type="text"]').val();
          var imgDesc=currentList.find('textarea').val();
          var img=currentList.find('img').attr('src');

          var liHtml='<li>';
          liHtml+='<img src="'+img+'" class="img-responsive">';
          liHtml+='<div class="fig-caption">';
          liHtml+='<h3>'+heading+'</h3>';
          liHtml+='<p>'+imgDesc+'</p>';
          liHtml+='</div>';
          liHtml+='</li>';

          ulHtml+=liHtml;

     }
     ulHtml+='</ul>';
     var headingTitle=$('input[name="heading"]').val(),
     status=$('#status').val(),
     catValue=$('#post_cat').val();

     <?php if(isset($editForm)): ?>
     ulHtml= $('.old-content').html() + ulHtml;
      var item ='<?php echo $itemdata->id; ?>';
      var sendObj={item:item,content:{heading:headingTitle,type:'slider',content:ulHtml,status:status,cms_category_id:catValue}};

     <?php else: ?>
     var sendObj={heading:headingTitle,type:'slider',content:ulHtml,status:status,cms_category_id:catValue};
     <?php endif; ?>

     $.ajax({
          method:'POST',
          url:'<?php echo $action; ?>',
          data:sendObj,
          success:function(data){
            var data=JSON.parse(data);
               if(data.status==true){
                    alert('Slider successfully created');
                    window.location.assign('<?php echo link_url.$title; ?>');
               }else if(data.status=='update'){
                    alert('Slider successfully updated');
                    window.location.assign('<?php echo link_url.$title; ?>');
               }else{
                    alert('Sorry slider can not be created');
               }
          }
     });
}

$('.submit').click(function(e){
     e.preventDefault();
     getContents();

})

  // function deleteImage end
</script>
 

