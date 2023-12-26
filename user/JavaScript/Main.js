$(document).ready(function () {
       $(document).on('click','.whishlist',function(){
        let id=$(this).attr('id');
        $(this).toggleClass('favadd');
        sessionStorage.setItem("wishlist",JSON.stringify([...JSON.parse(sessionStorage.getItem("wishlist")|| "[]"),id]));
       
       }); 
       let wshlist=JSON.parse(sessionStorage.getItem("wishlist"));
       if(wshlist.includes($('.wishlist').attr(id))){
        $(this).addClass('favadd');
       }
});
function userset(){
    var user=sessionStorage.getItem("User");
    if(user==null){
        $('.icons li:nth-last-child(1)').css("display", "none");
    }else{
        $('.icons li:nth-last-child(1)').css("display", "block");
        $('.userImage img').attr("src", JSON.parse(user).userimage);
        document.querySelector('.userImage span').innerText=JSON.parse(user).username;
        $('.icons li:nth-last-child(2)').css("display", "none");
    }
}
function clearuser(){
    sessionStorage.clear();
}