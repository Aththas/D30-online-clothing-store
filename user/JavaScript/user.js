

function setuser(){
    var userres=sessionStorage.getItem("User");
    let user=JSON.parse(userres);
    $(".userdb img").attr('src', user.userimage );
    $('.userdb h3').append(user.username);
    $(".Userdetails ul li:nth-child(1) span").text(fullname(user.firstName,user.lastName));
    $(".Userdetails ul li:nth-child(2) span").text(user.email );
    $(".Userdetails ul li:nth-child(3) span").text( address(user.HomeNo,user.street,user.postalcode,user.country));
    $(".Userdetails ul li:nth-child(4) span").text(user.contact_number);
}
function fullname(firstname,lastname){
 return firstname+' '+lastname;
}
function address(homeno,street,city,postalcode,country){
   return "No."+homeno+","+street+","+postalcode+"."+country;
}