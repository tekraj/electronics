function searchData(){
          var searchButton=$('#searchButton'),
          tableHead=$('#myTable thead tr'),
          totalTitle=tableHead.find('th').length,
          tableBody=$('#myTable tbody'),
          tableRow=tableBody.find('tr').length,   
          totalData=[];
          for(var i=0;i<totalTitle-1;i++){
            var heading=tableHead.find('th:eq('+i+')').text();
            totalData.push([]);
          }
          for(var i=0;i<tableRow;i++){
            var rowData={},
            row=tableBody.find('tr:eq('+i+')'),
            cols=row.find('td').length;
            for(j=0;j<cols-1;j++){
              var colsText=row.find('td:eq('+j+')').text();
              var heading=tableHead.find('th:eq('+i+')').text();
              totalData[j].push(colsText);
              
            }

          }
          searchButton.click(function(e){
            e.preventDefault();
            var searchby=$('#searchby').val();
            var searchkey=$('#searchkey').val();
            var searchArray=totalData[searchby];
            // console.log(searchArray);
            var arrayLength=searchArray.length;
            tableBody.find('tr').hide();
            for(var i=0;i<arrayLength;i++){
              if(searchArray[i].match(searchkey)){
              tableBody.find('tr:eq('+i+')').show();
              }
            }

            
          });
}
	
	