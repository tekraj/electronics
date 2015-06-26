<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->


    <!-- row -->
    <div class="row">
        <div class="col-md-12 btn btn-primary">

            <div class="btn-group pull-right">
              <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">


                Messages <span class="glyphicon glyphicon-comment"></span> <span class="caret"></span>
              </button>

                <!-- message alert div -->
                <div class="alert alert-warning alert-dismissible new-message" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                   <span id="new-message"></span>
                </div>
                <!-- message alert div end -->

              <ul class="dropdown-menu" role="menu" id="messageul">
               
              </ul>
            </div>
        </div>
    </div>


    <!-- message row end -->
    <div class="row">
        <h2>Current Status</h2>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="delivered">0</div>
                            <div>Items Delivered</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo link_url.'sold'; ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="chat-number">0</div>
                            <div>Members Online!</div>
                        </div>
                    </div>
                </div>
                <a href="#" id="chat-link">
                    <div class="panel-footer">
                        
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge" id="new-orders">0</div>
                            <div>New Orders!</div>
                        </div>
                    </div>
                </div>
                <a href="<?php echo link_url.'order'; ?>">
                    <div class="panel-footer">
                        <span class="pull-left">View Details</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row chat-up">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Order Graph By
                    <button class="btn btn-primary databutton" id="week" onclick="getOrderData('week')">Week</button><button class="btn btn-primary databutton" id="month" onclick="getOrderData('month')">Month</button><button class="btn btn-primary databutton" id="year" onclick="getOrderData('year')">Year</button>
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <canvas id="canvasChart"  width="600" height="300"></canvas>
                </div>
            
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-8 -->
    </div>

    <!-- /.row -->

    <div class="row chat-room">
    <div class="col-lg-12 chat-div">
        <div class="col-lg-4 col-md-4 chat-panel">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a class="pull-right remove-chat-box" href="#"><span class="glyphicon glyphicon-remove-circle"></span></a>

                </div>
                <div class="panel-body chat-body">

                    
                </div>
                <div class="panel-footer">
                    <form class="chat-form">
                        <input type="text" class="chatmessage" class="form-control">&nbsp;&nbsp;&nbsp;
                        
                        <button type="submit" class="btn btn-success send-message">Send</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

</div>

<!-- /#page-wrapper -->


<script type="text/javascript">



    var c=document.getElementById('canvasChart');
    var ctx=c.getContext('2d');
    ctx.beginPath();
    ctx.fillStyle="#fff";
    ctx.fillRect(0,0,600,300);
    ctx.closePath();
    // function to show orders by week
    function ordersByWeek(graphData){

        var height=c.height;
        var width=c.width;

        ctx.clearRect(0,0,width,height);
        ctx.beginPath();
        ctx.fillStyle="#fff";
        ctx.fillRect(0,0,width,height);
        ctx.closePath();
        var days=[
            'Mon',
            'Tue',
            'Wed',
            'Thu',
            'Fri',
            'Sat',
            'Sun'
        ];

        // code to draw horizontal and vertical lines with indicator

        var xFactor=width/(days.length+1);
        var yFactor=height/(days.length+1);
        
        for(var i=0; i < days.length;i++){

            var xAxis=(i+1)*xFactor;
            var yAxis=(height-yFactor);

            drawCircle(xAxis,yAxis,5,"#000");
            drawLine(xAxis,yAxis,xAxis,0,'#ccc',0.5);
            drawText(days[i],xAxis,(height-10));

        }

        drawLine(0,(height-yFactor) , width,(height-yFactor));

        drawLine(2,(height-yFactor) , 2,0);

        for(var i=0;i< days.length;i++){

            drawLine(0,yAxis,width,yAxis,'#ccc',0.5);
            yAxis=(i+1)*yFactor;

            drawCircle(2,yAxis,5,"#000");
            drawText((days.length-(i+1))*50,10,yAxis)

        }


        // code to draw horizontal line end


        // code to draw graph
        var count=0;
        var graphPoint=[];

        for(var order in graphData){

            var totalOrder=graphData[order][0].quantity;
            var point={x:((count+1)*xFactor), y:((height-yFactor)-(totalOrder*0.75))};

            graphPoint.push(point);
            count++;

        }
        

        for(var i=0;i<graphPoint.length;i++){
            var point=graphPoint[i];
             if(i==0){
                drawLine((width-xFactor,(height-yFactor, point.x,point.y)));
             }else{
                oldPoint=graphPoint[i-1];
                drawLine(oldPoint.x,oldPoint.y,point.x,point.y);
             }
        }
        // code to draw graph end

    }
    // function ordersByWeek End
    /*
    *=============================================
    */
     // function to show orders by month
    function ordersByMonth(graphData){

        var height=c.height;
        var width=c.width;

        ctx.clearRect(0,0,width,height);
        ctx.beginPath();
        ctx.fillStyle="#fff";
        ctx.fillRect(0,0,width,height);
        ctx.closePath();
        var month=[
            'Jan',
            'Feb',
            'March',
            'April',
            'May',
            'June',
            'July',
            'Aug',
            'Sep',
            'Oct',
            'Nov',
            'Dec'
        ];

        // code to draw horizontal and vertical lines with indicator

        var xFactor=width/(month.length+1);
        var yFactor=height/(month.length+1);
        
        for(var i=0; i < month.length;i++){

            var xAxis=(i+1)*xFactor;
            var yAxis=(height-yFactor);

            drawCircle(xAxis,yAxis,5,"#000");
            drawLine(xAxis,yAxis,xAxis,0,'#ccc',0.5);
            drawText(month[i],xAxis,(height-10));

        }

        drawLine(0,(height-yFactor) , width,(height-yFactor));

        drawLine(2,(height-yFactor) , 2,0);

        for(var i=0;i< month.length;i++){

            drawLine(0,yAxis,width,yAxis,'#ccc',0.5);
            yAxis=(i+1)*yFactor;

            drawCircle(2,yAxis,5,"#000");
            drawText((month.length-(i+1))*50,10,yAxis)

        }


        // code to draw horizontal line end


        // code to draw graph
        var count=0;
        var graphPoint=[];

        for(var order in graphData){

            var totalOrder=graphData[order][0].quantity;
            var point={x:((count+1)*xFactor), y:((height-yFactor)-(totalOrder*0.75))};

            graphPoint.push(point);
            count++;

        }
        

        for(var i=0;i<graphPoint.length;i++){
            var point=graphPoint[i];
             if(i==0){
                drawLine((width-xFactor,(height-yFactor, point.x,point.y)));
             }else{
                oldPoint=graphPoint[i-1];
                drawLine(oldPoint.x,oldPoint.y,point.x,point.y);
             }
        }
        // code to draw graph end

    }
    // function ordersByMonth End
    /*
    *=============================================
    */
     // function to show orders by Year
    function ordersByYear(graphData){

        var height=c.height;
        var width=c.width;

        ctx.clearRect(0,0,width,height);
        ctx.beginPath();
        ctx.fillStyle="#fff";
        ctx.fillRect(0,0,width,height);
        ctx.closePath();
        var yearArray=[];

        for(var year in graphData){
            yearArray.push(year);
        }

        // code to draw horizontal and vertical lines with indicator

        var xFactor=width/(yearArray.length+1);
        var yFactor=height/(yearArray.length+1);
        
        for(var i=0; i < yearArray.length;i++){

            var xAxis=(i+1)*xFactor;
            var yAxis=(height-yFactor);

            drawCircle(xAxis,yAxis,5,"#000");
            drawLine(xAxis,yAxis,xAxis,0,'#ccc',0.5);
            drawText(yearArray[i],xAxis,(height-10));

        }

        drawLine(0,(height-yFactor) , width,(height-yFactor));

        drawLine(2,(height-yFactor) , 2,0);

        for(var i=0;i< yearArray.length;i++){

            drawLine(0,yAxis,width,yAxis,'#ccc',0.5);
            yAxis=(i+1)*yFactor;

            drawCircle(2,yAxis,5,"#000");
            drawText((yearArray.length-(i+1))*50,10,yAxis)

        }


        // code to draw horizontal line end


        // code to draw graph
        var count=0;
        var graphPoint=[];

        for(var order in graphData){

            var totalOrder=graphData[order][0].quantity;
            var point={x:((count+1)*xFactor), y:((height-yFactor)-(totalOrder*0.75))};

            graphPoint.push(point);
            count++;

        }
        

        for(var i=0;i<graphPoint.length;i++){
            var point=graphPoint[i];
             if(i==0){
                drawLine((width-xFactor,(height-yFactor, point.x,point.y)));
             }else{
                oldPoint=graphPoint[i-1];
                drawLine(oldPoint.x,oldPoint.y,point.x,point.y);
             }
        }
        // code to draw graph end

    }
    // function ordersByYear End
    /*
    *=============================================
    */

    // function to get data for graph
    /*
    *===============================================
    */
    // function to get data for orders
    function getOrderData(type){
        $('.databutton').removeClass('btn-success');
        $('#'+type).addClass('btn-success');
        var dataUrl='<?php echo link_url."site/getGraphData"; ?>'

            var graphData={};
            $.ajax({
                method:'POST',
                url:dataUrl,
                data:{type:type},
                success:function(data){
                    var graphData=JSON.parse(data);
                    switch(type){
                        case 'week':
                        ordersByWeek(graphData);
                        break;
                        case 'month':
                        ordersByMonth(graphData);
                        break;
                        case 'year':
                        ordersByYear(graphData);
                        break;
                    }
                }
            });



    }

    getOrderData('week');


   
    
    

    function drawLine(x,y,x1,y1,color,width){
        var color=color ? color : '#000';
        var width=width ? width : 2;
        ctx.beginPath();
        ctx.moveTo(x,y);
        ctx.lineTo(x1,y1);
        ctx.closePath();
        ctx.strokeStyle=color;
        ctx.lineWidth=width;
        ctx.stroke();
    }

    function drawCircle(h,k,r,color,strokeColor){
        var color= color ? color : '#fff';
        var strokeColor = strokeColor ? strokeColor : '#000';
        ctx.beginPath();
        ctx.arc(h,k,r,0,2*Math.PI);
        ctx.fillStyle=color;
        ctx.strokeStyle=strokeColor;
        ctx.fill();
        ctx.stroke();
    }

    function drawText(text,x,y,color,fontStyle){
        var color=color ? color : '#000';
        var fontStyle=fontStyle ? fontStyle : 'italic 18px serif';
        ctx.beginPath();
        ctx.fillStyle=color;
        ctx.font=fontStyle;
        ctx.fillText(text,x,y);
        ctx.closePath();
    }



    /*
    *
    *Functiont to display the status data
    *
    */

    // function display status

    (function displayStatus(){

        var delivery=$('#delivered'),
        chatNo=$('#chat-number'),
        order=$('#new-orders');

        var deliveryUrl='<?php echo link_url."order/getTodaysDelivery" ?>',
        orderUrl='<?php echo link_url."order/getTodaysOrder" ?>',
        memberOnlineUrl='<?php echo link_url."site/onlineMember"; ?>',
        messageUrl='<?php echo link_url."site/detectMessage"; ?>',
        checkLi={};

        // ajax request to get delivery items

        $.ajax({
            method:'POST',
            url:deliveryUrl,
            data:{},
            success:function(data){
                var data=data ? data : 0;
                delivery.html(data);
            }
        });

        // ajax request for delivery item end

        // ajax request to get orders items
        $.ajax({
            method:'POST',
            url:orderUrl,
            data:{},
            success:function(data){
                 var data=data ? data : 0;
                 order.html(data);
            }
        });
        // ajax request for no of online Members


        
            setInterval(function(){

                $.ajax({

                    method:'POST',
                    url:memberOnlineUrl,
                    data:{},
                    success:function(data){
                        var data=data ? data : 0;
                        chatNo.html(data);
                    }
                });

            },3000);



           setInterval(function(){
                $.ajax({
                    method:'POST',
                    url:messageUrl,
                    data:{},
                    success:function(data){
                        if(data!='false'){
                            var data=JSON.parse(data);
                            // console.log(data);
                           
                            showChatBox(data,checkLi);
                        }
                    }   
                })
            },12000);


    })();

    // function to display chat box

    function  showChatBox(data,checkLi){

        var chatHistoryUrl='<?php echo link_url."site/chatHistory" ?>';

        var newMessage=$('#new-message');
        var memberData=data[(data.length-1)].memberdetail;
        newMessage.html('New Message From '+memberData.email);
        $('.new-message').show(300);

         var liHtml=$('<li class="chatLink chat'+memberData.id+'" chat_id="chat'+memberData.id+'" chat_email="'+memberData.email+'"><a href="#">Message From '+memberData.email+'</a></li>');

        if(!checkLi[memberData.id]){

            checkLi[memberData.id]=true;
            checkLi[memberData.id+'no']=1;

           

            $('#messageul').append(liHtml);
        }else{
            checkLi[memberData.id+'no'] +=1;
            
            $('.chat'+memberData.id).append('<span class="message-no">'+checkLi[memberData.id+'no']+'</span>');

        }



        var checkObj={};

        liHtml.find('a').click(function(e){

            if(!checkObj[memberData.id]){

                checkObj[memberData.id]=true;
                e.preventDefault();

                var chatHtml=$('.chat-panel').html();

                var newChatHtml=$('<div class="col-md-4 new-chat-panel" id="chat'+memberData.id+'">'+chatHtml+'</div>');

                $.ajax({
                    method:'POST',
                    url:chatHistoryUrl,
                    data:{memberId:memberData.id},
                    success:function(datas){
                        if(datas!='false'){
                            var datas=JSON.parse(datas);
                            for(var i=0; i<(datas.length-1); i++){

                                var receivedMessage=datas[i].message;
                                var sendmessage=datas[i].sendmessage;


                                newChatHtml.find('.panel-body').append('<span class="receive">'+receivedMessage+'</span>');

                                if(sendmessage!==null){
                                    newChatHtml.find('.panel-body').append('<span class="send">'+sendmessage+'</span>');


                                    scrollHeight=newChatHtml.find('.panel-body').find('span').outerHeight();

                                    totalSpan=newChatHtml.find('.panel-body').find('span').length;
                                    totalScroll=(parseInt(scrollHeight)+10)*totalSpan;
                                    newChatHtml.find('.panel-body').scrollTop(totalScroll);
                                }                

                            }   
                        }
                    }
                })


              



                newChatHtml.find('.panel-footer').find('form').attr('member_id',memberData.id);

                $('.chat-div').append(newChatHtml);
                newChatHtml.find('.panel-heading').append(memberData.email);

                newChatHtml.find('.remove-chat-box').click(function(e){
                   
                    e.preventDefault();

                    $(this).parent().parent().parent().hide();
                    checkObj={};
                });

                $('#chat'+memberData.id).find('button').click(function(e){
                    e.preventDefault();

                    var memberId=$(this).parent().attr('member_id'),
                    message=$(this).parent().find('input[type="text"]').val(),
                    sendUrl='<?php echo link_url."site/sendMessage"; ?>',
                    userId='<?php echo $_SESSION["user"]->id; ?>',
                    messageId=data[(data.length-2)].id;

                     newChatHtml.find('.panel-body').append('<span class="send">'+message+'</span>');
                     $(this).parent().find('input[type="text"]').val('');


                      scrollHeight=newChatHtml.find('.panel-body').find('span').outerHeight();

                    totalSpan=newChatHtml.find('.panel-body').find('span').length;
                    totalScroll=(parseInt(scrollHeight)+10)*totalSpan;
                    newChatHtml.find('.panel-body').scrollTop(totalScroll);




                    if(message!=''){

                        var messageData={user_id:userId,membermessage_id:messageId,membermessage_member_id:memberId,message:message};

                        $.ajax({
                            method:'POST',
                            url:sendUrl,
                            data:messageData,
                            success:function(data){
                                if(data=='true'){
                                    
                                }
                            
                            }
                        });


                    }
                   checkSingleMessage(memberData.id); 
                });
                
            } 


                                           

        });
    }



    // function for chatting

    function checkSingleMessage(memberId){

        var singleMessageUrl='<?php echo link_url."site/singleMessageCheck" ?>';
        setInterval(function(){
            $.ajax({
                method:'POST',
                url:singleMessageUrl,
                data:{memberId:memberId},
                success:function(data){
                   
                    if(data!='false'){

                        var data=JSON.parse(data);
                        
                        $('#chat'+memberId).find('.panel-body').append('<span class="receive">'+data.message+'</span>');

                        scrollHeight=$('#chat'+memberId).find('.panel-body').find('span').outerHeight();

                        totalSpan=$('#chat'+memberId).find('.panel-body').find('span').length;
                        totalScroll=(parseInt(scrollHeight)+10)*totalSpan;
                        $('#chat'+memberId).find('.panel-body').scrollTop(totalScroll);

                    }
                    

                }
            })
        },1000)

    }



    


</script>
