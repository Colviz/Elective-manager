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