$(document).ready(function(){
		allValidation(data,urls);//call the function to validate form
     // code for pagination start
      var paginationHtml=pagination(currentPage,totalPage);
      $('#pagination').html(paginationHtml);
        for(i=0;i<=totalPage;i++){
          var currentSpan=$('#pagination a:eq('+i+')');
          if(currentPage==(currentSpan.text())){
          currentSpan.addClass('activePage');
        }
      }
      //code to generate url automatically
      $('#beurl').blur(function(){
        var titleNames=$(this).val();
        titleNames=titleNames.trim();
        titleNames=titleNames.replace(/[&\/\\#,+()$~%.'":*?@<>{}]/g,'-');
        titleNames=titleNames.replace(/\s{1,}/g, '-');
        titleNames=titleNames.replace(/-{2,}/g, '-');
        titleNames=titleNames.toLowerCase();
        $('#puturl').val(titleNames);
      })     
      if(currentPage<=1){
        $('#left-link').addClass('disabled-link');
        $('#left-link').click(function(){
          event.preventDefault();
        })
      }else{
        $('#left-link').removeClass('disabled-link');
      }
      if(currentPage>=totalPage){
        $('#right-link').addClass('disabled-link');
        $('#right-link').click(function(){
          event.preventDefault();
        })
      }else{
         $('#right-link').removeClass('disabled-link');
      }
      //code for pagination end
       
    })
function pagination(currentPage,totalPage){
  var pageHtml='';
  pageHtml+='<a href="/electronics/admin/'+title+'/page/'+(currentPage-1)+'" class="pagination arrows" id="left-link"><</i></a>';
  for(i=1;i<=totalPage;i++){
    pageHtml+='<a href="/electronics/admin/'+title+'/page/'+i+'" class="pagination">'+i+'</a>';
  }
  pageHtml+='<a href="/electronics/admin/'+title+'/page/'+(currentPage+1)+'" class="pagination arrows" id="right-link">></a>';
  return pageHtml;


}
