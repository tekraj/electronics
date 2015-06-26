<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo ucfirst($title); ?> -Management</h1>
        </div>
        <!-- /.col-lg-12 -->
        
    </div>

    <div class="row">
        <!-- <span><a class="btn btn-primary" href="<?php echo link_url.$title; ?>/add" style="color:#fff;">Add New</a></span> -->
        <span><a class="btn btn-primary" href="<?php echo link_url.$title; ?>/viewall" style="color:#fff;">View All</a></span>
        <p></p>
        <?php if(isset($_COOKIE['message'])): ?>
        <?php  if(!empty($_COOKIE['message'])): ?>
            <div class="alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><?php echo ucfirst($title).' '.$_COOKIE['message']; ?></div>
        <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="row">
            <?php 
          if($template=='viewdata'){
                  include_once('site/'.$title.'/viewdata.php');
              }
            else if($template=='verify'){
                include_once('site/'.$title.'/verify.php');
            } else if($template=='viewdetail'){
                include_once('site/'.$title.'/viewdetail.php');
            }
            else{
                include_once('site/'.$title.'/datalist.php');
            }
        ?>
    </div>
    <div id="output">
    <h1>User Succesfully Created</h1>
    <button type="button" id="closeIt">CLOSE</button>
</div>
</div>