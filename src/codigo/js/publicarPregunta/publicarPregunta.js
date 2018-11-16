$(document).ready(function (){
    var tiempo = setInterval(
        function(){
            if($("#comando").val() == ("ok")){
                location.href="/index.php";
            }else{
                clearInterval(tiempo);
            }

        }, 10000);
});