$(document).ready(function (){
    var tiempo = setInterval(
        function(){
            if($("#comando").val() == ("ok")){
                location.href="/";
            }else{
                clearInterval(tiempo);
            }

        }, 2000);
});