
    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
     <script type="text/javascript">
        var title='<?php echo $title; ?>'
        var pageTitle='<?php echo $title; ?>';
        var titleForm='<?php echo $title."-form"; ?>';
        var urls=$('form[name='+titleForm+']').attr('action');
        var totalRow='<?php echo isset($totalRow) ? $totalRow : 0; ?>';
        var limit=5;
        var totalPage=(totalRow/limit);
        if(totalPage>(Math.round(totalPage))){
            totalPage=parseInt(totalPage)+1;
        }
        totalPage=Math.round(totalPage);
        var currentPage=parseInt('<?php echo isset($currentPage) ? $currentPage : 1; ?>');
    </script>
    
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo link_url; ?>assests/js/sb-admin-2.js"></script>
    <script src="<?php echo link_url; ?>assests/js/formvalidation.js"></script>
    <script src="<?php echo link_url; ?>assests/js/searchTable.js"></script>
    <script src="<?php echo link_url; ?>assests/js/extra.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo link_url; ?>assests/js/bootstrap.min.js"></script>

    <!-- script for ckfinder -->
    <script src="<?php echo link_url; ?>assests/ckfinder/ckfinder.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo link_url; ?>assests/js/plugins/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="<?php echo link_url; ?>assests/js/plugins/morris/raphael.min.js"></script>
    <script src="<?php echo link_url; ?>assests/js/plugins/morris/morris.min.js"></script>
    <script src="<?php echo link_url; ?>assests/js/plugins/morris/morris-data.js"></script>
    <script>
    // ckfinder initialisin

    // tooltip demo
    $('[data-toggle=tooltip]').tooltip({
        //selector: "[data-toggle=tooltip]",
        container: "body"
    })

    // popover demo
    $("[data-toggle=popover]")
        .popover()
    </script>

</body>

</html>
