let Thisrow=null;
var requirmentitems=[]
let NowItem,Itemimg;
$(document).ready(function () {
    
    var productindex=window.location.href.substring(window.location.href.indexOf('?')+1);
  
    $.getJSON("https://localhost//user/user/Costomisable.json", function (obj) {
            $.each(obj, function () { 
                 if(this['Cid']==productindex){
                    NowItem=this['Product'];
                    Itemimg=this['Sample'];
                    $('.CostomizableSample h1').append(NowItem);
                    $('.CostomizableSample img').attr("src",Itemimg );
                    $.each(this['Required_parts'], function (indexInArray, valueOfElement) { 
                         requirmentitems.push(valueOfElement);
                    }); 
                    requirmentitems.forEach(element => {
                              $('#Components').append(`<option value=${element}></option>`); 
                         });
                    
                 }
            });
        });
       
     let screenwidth=$(window).width();
     var headrowsm=`<tr>
               <th>Icon</th>
               <th>components</th>
               <th>Opertion</th>
          </tr>`;
     var headrow=`<tr>
          <th>Icon</th>
          <th>components</th>
          <th>Brand</th>
          <th>Size</th>
          <th>Number</th>
          <th>Opertion</th>
     </tr>`;
     var row=` <tr>
          <td><img></div></td>
          <td><input type="text" name="Component[]" id="Component" class="form-control" required list="Components" autocomplete="off"></td>
          <td><input type="text" name="Brand[]" id="Brand" class="form-control"  required list="Brands" autocomplete="off"></td>
          <td><input type="text" name="=Size[]" id="Size" class="form-control" list="Sizes" autocomplete="off"></td>
          <td><input type="number" name="items[]" id="items" class="form-control"  min="0" value="0" autocomplete="off"></td>`;
     var rowsm=`<tr>
     <td><img></td>
     <td><input type="text" name="Component[]" id="Component" class="form-control" required list="Components" autocomplete="off" >
     <input type="text" name="Brand[]" id="Brand" class="form-control" required list="Brands" autocomplete="off">
     <input type="text" name="Size[]" id="Size" class="form-control" list="Sizes" autocomplete="off">
     <input type="number" name="items[]" id="items" class="form-control"  min="0" value="0" autocomplete="off" ></td>`;

     var addbtn=`<td><button class="btn btn-success" id="add_btn">Add +</button></td>`;
     var removebtn=`<td><button class="btn btn-danger" id="remove_btn">Remove</button></td>`;
     if(screenwidth<=400){
          $('#AddItemstable').prepend(`<thead>${headrowsm}</tr></thead><tbody>${rowsm}${addbtn}</tr></tbody>`);
     }
     else{
          $('#AddItemstable').prepend(`<thead>${headrow}</tr></thead><tbody>${row}${addbtn}</tr></tbody>`);
     }
     $('#add_btn').click(function (e) { 
          e.preventDefault();
          if(screenwidth<=400){
               $('#AddItemstable tbody').append(`${rowsm}${removebtn}</tr>`);
          }
          else{
               $('#AddItemstable tbody').append(`${row}${removebtn}</tr>`);
          }

     });
     
     $(document).on('keyup','#Component',function(){
        let Component=$(this).val();
        $('#SuggestPrducts').empty();
          $(`#Components option[value='${Component}']`).remove();
          if(Component!=""){
               $.ajax({
                    type: "POST",
                    url: "https://localhost//user/user/Subphp/searching.php",
                    data:{Component:Component,action:"Componentsearch"},
                    success: function (Brand) {
                         $('#Brands').append(Brand.split("_")[0]);
                         $('#Sizes').append(Brand.split("_")[1]);
                    }
               });
          }
     });
     $(document).on('keyup','#Brand',function(){
          
            $(`#Brands option`).remove();
       });
       $(document).on('keyup','#Size',function(){
          $(`#Sizes option`).remove();
          Thisrow=$(this).closest("tr");
          let Component=$(Thisrow).find("#Component").val();
          let Brand=$(Thisrow).find("#Brand").val();
          $.ajax({
               type: "POST",
               url: "https://localhost//user/user/Subphp/searching.php",
               data:{Component:Component,Brand:Brand,action:"ProductSearch"},
               success: function (response) {
                   $('#SuggestPrducts').append(response);
               }
          });
     });
    $(document).on('click','#alertyes',function (e) { 
     e.preventDefault();
          $("#AddItemstable tbody").empty();
          if(screenwidth<=400){
               $('#AddItemstable tbody').prepend(`${rowsm}${addbtn}</tr>`);
          }
          else{
               $('#AddItemstable tbody').prepend(`${row}${addbtn}</tr>`);
          }
          $('#alert').removeClass('AlertActive');
          $(this).removeAttr('id');
    });
    $(document).on('click','#alerterryes',function (e) { 
     e.preventDefault();
          $('#alert').removeClass('AlertActive');
          document.querySelector("#alert h3").innerText="Do You Clear your Bulid?";
          $(this).removeAttr('id');
          $("#alertno").show();
          $(Element).removeClass('errbk');
          document.querySelector('.yesbtn').innerText="Yes";
    });
   
});
$(document).on('click','#remove_btn',function (e) {
     e.preventDefault();
     let removeitem=$(this).parent().parent();
     $(removeitem).remove();
});
function show(clickid){
    let thisobj=JSON.parse(clickid);
    $(Thisrow).attr('id', clickid);
    $(Thisrow).find("td img").attr("src",thisobj['product_image']);
}
$("#addbtn").click(function(e){
     const costomisableitems=[];
    document.querySelectorAll("#AddItemstable tbody tr").forEach((Element)=>{
     let imagesrc,count,Component,costoobj;
     imagesrc=$(Element).find('img').attr('src');
     count=$(Element).find('#items').val();
     Component=$(Element).attr('id');
     if(imagesrc===undefined || count==0 || imagesrc==""){
          $(Element).addClass('errbk');
          $(Element).find('#Component').val("");
          $(Element).find('#items').val(0);
          document.querySelector("#alert h3").innerText="Fileds are Empty";
          $('#alert').addClass('AlertActive');
          $("#alertno").hide();
          document.querySelector('.yesbtn').innerText="OK";
          $('#alert').find('.yesbtn').attr('id','alerterryes');
          for(let a=0;a<costomisableitems.length;a++){
               costomisableitems.pop();
          }
          return false;


     }
     else{
          $(Element).removeClass('errbk');
          costoobj=JSON.parse(Component);
          costoobj['noofitem']=count;
          costomisableitems.push(costoobj);
          localStorage.setItem("costomisableitems",JSON.stringify(costomisableitems));
window.location.href=`CostomizableingProduct.php?item=${NowItem},pic=${Itemimg}`;

     }
});

    
});
$('#clearbtn').click(function (e) { 
     e.preventDefault();
     $('#alert').addClass('AlertActive');
     $('#alert').find('.yesbtn').attr('id','alertyes');
});
$('#alertno').click(function (e) { 
     e.preventDefault();
     $('#alert').removeClass('AlertActive');
});