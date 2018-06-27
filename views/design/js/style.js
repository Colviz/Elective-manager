//js used to prioritize electives
$(".go").change(function(){
    var selVal=[];
    $(".go").each(function(){
        selVal.push(this.value);
    });
   
    $(this).siblings(".go").find("option").removeAttr("disabled").filter(function(){
       var a=$(this).parent("select").val();
       return (($.inArray(this.value, selVal) > -1) && (this.value!=a))
    }).attr("disabled","disabled");
});

$(".go").eq(0).trigger('change');

//code to hide/unhide a div using a button
$(document).ready(function(){
    $("button").click(function(){
        $("#Hideit").toggle();
    });
});

//print allotment result
$(document).ready(function(){
    $("#thiss").click(function(){
        printData();
    });
});
