var all = document.getElementsByTagName("*");
var myVar = setInterval(function(){ set_ele(all[0]) }, 10);

document.onreadystatechange = function(e)
{
  if(document.readyState=="interactive")
  {
    $("#bar1, #percent1").show();
  }else if (document.readyState == "complete") {
      clearInterval(myVar);


      var myVar2 = setInterval(function(){
        var getVal = $("#percent1 span").text();
        var newVal = parseInt(getVal) + 3;

        if(newVal > 97){
          clearInterval(myVar2);
          $("#bar1").css({"width":"100%"});
          $("#percent1 span").text(100);
          $(".progress").fadeOut();
        }else{
          $("#percent1 span").text(newVal);
        }
      },10);

      // $("#bar1").animate({width:"100%"},0,function(){
      //   $(".progress").fadeOut("slow");    
      // });
  }
}

function check_element(ele)
{
  var all = document.getElementsByTagName("*");
  var totalele=all.length;
  var per_inc=100/all.length;

  if($(ele).on())
  {

    var prog_width=per_inc+Number(document.getElementById("progress_width").value);
    document.getElementById("progress_width").value=prog_width;
    $("#bar1").animate({width:prog_width+"%"},0.5,function(){
      if(document.getElementById("bar1").style.width=="100%")
      {
        $(".progress").fadeOut("slow");
      }     
    });
    setTimeout(function(){
      var bar = $("#bar1");
      var f = bar.width() / bar.parent().width() * 100;
      var countCurrent = Number(parseFloat(f).toFixed(0));
      $("#percent1 span").text(countCurrent);
    },250);
  }

  else  
  {
    set_ele(ele);
  }
}

function set_ele(set_element)
{
  check_element(set_element);
}