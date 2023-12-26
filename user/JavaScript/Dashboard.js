$(document).ready(function () {
    $('.build_btn').click(function (e) { 
        e.preventDefault();
        var costomisableid=$(this).data('id');
        window.location.href=`Costomizable.php?${costomisableid}`;
    });
});
let img;
let item;
let tot=0;
var CostomisableItemsMy;
function costomisalload(){
    let prodetdetails=window.location.href.substring(window.location.href.indexOf('?')+1);
    let proitem=prodetdetails.split(',')[0];
    let imgsrc=prodetdetails.split(',')[1];
     img=imgsrc.substring(imgsrc.indexOf("=")+1);
    item=proitem.substring(proitem.indexOf("=")+1);
   
     CostomisableItemsMy=localStorage.getItem("costomisableitems");
        
   $.each(JSON.parse(CostomisableItemsMy), function (indexInArray, valueOfElement) { 
         tot+=(valueOfElement.noofitem*valueOfElement.product_price);
          var rows=`<tr id='${valueOfElement.product_id
}'>
                    <td>${valueOfElement.product_name}</td>
                    <td><img class="productpicture"src='${valueOfElement.product_image}'></td>
                    <td>${valueOfElement.category}</td>
                    <td>${valueOfElement.brand}</td>
                    <td>${valueOfElement.product_price}</td>
                    <td>${valueOfElement.noofitem}</td>
                    <td>${valueOfElement.noofitem*valueOfElement.product_price}</td>
                    <td>${valueOfElement.scale}</td>
            </tr>`;
            $('#SeeCostomisableitems tbody').append(rows);

   });
   $("#SeeCostomisableitems tfoot").append(`<tr><td colspan='8'>Total=${tot}</td></tr><tr><td colspan='4'><button id="Confirm"class="btn btn-primary btn-lg" type="button">ok</button><td/><td colspan='4'>
   <button class="btn btn-info btn-lg" id="print_btn" type="button">Print</button></td><tr>`);

    $("#productpic").attr('src',img);
    $('#costomisablproductlist h1').append(item); 

}
$(document).on('click','#print_btn',function(){
    imprimir();
});
function imprimir() {
    var divToPrint=document.getElementById("costomisablereport");
    newWin= window.open("");
    newWin.document.write(divToPrint.outerHTML);
    newWin.print();
    newWin.close();
}
$(document).on('click','#Confirm',function(){
    $.ajax({
        type: "POST",
        url: "Subphp/searching.php",
        data: {products:CostomisableItemsMy,Total:tot,action:"costomisalorder"},
        success: function (response) {
            if(response=="ok"){
                
                alert('buildScuss');
            localStorage.removeItem('costomisableitems');
            window.location.href='index.php';
            }
            else{
                alert('building fail try agin');
                window.location.href="DashBoard.php";
            }
            
        }
    });
    
});