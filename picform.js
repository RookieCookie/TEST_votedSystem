var Name = new Array();
var Count=new Array();

    $.ajax({
        url:"data.php",
        type:"POST",
        dateType: "json",
        //data:({})
        success: function (a) {
            var array = eval("(" + a + ")");
            for (var p in array) {
                //alert(array[p]['name']);
                //alert(array[p]['counts']);
                Name.push(array[p]['name']);
                Count.push(array[p]['counts']);
            }
            var barChartData = {
                labels :Name/* ["马老大","小浣熊","大水牛","犀牛兄弟","猫叔","狐狸特工","青蛙军曹","草泥马大叔","狗司机","熊博士"]*/,   /*投票人*/
                datasets : [
                    {
                        fillColor : "rgba(220,220,220,0.5)",
                        strokeColor : "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(220,220,220,0.75)",
                        highlightStroke: "rgba(220,220,220,1)",
                        data : Count/*[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]*/  /*票数*/
                    }
                ]
            };
            window.onload = function(){
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myBar = new Chart(ctx).Bar(barChartData, {
                    responsive : true
                });
            };

        } /*success*/
    })

/*function dataget_re(){
    var array =dataget();
    var array_all = eval("(" + array + ")");
    for (var p in array_all) {
        //alert(array[p]['name']);
        //alert(array[p]['counts']);
        Name.push(array[p]['name']);
        Count.push(array[p]['counts']);
    }
}*/

/*window.onload = function(){
  var array_all = eval("(" + array + ")");
    for (var p in array_all) {
        //alert(array[p]['name']);
        //alert(array[p]['counts']);
        Name.push(array[p]['name']);
        Count.push(array[p]['counts']);
        alert(Name);
    }
}*/




/*var randomScalingFactor = function(){ return Math.round(Math.random()*100)};*/
var barChartData = {
    labels :[]/* ["马老大","小浣熊","大水牛","犀牛兄弟","猫叔","狐狸特工","青蛙军曹","草泥马大叔","狗司机","熊博士"]*/,   /*投票人*/
    datasets : [
        {
            fillColor : "rgba(220,220,220,0.5)",
            strokeColor : "rgba(220,220,220,0.8)",
            highlightFill: "rgba(220,220,220,0.75)",
            highlightStroke: "rgba(220,220,220,1)",
            data : []/*[randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor(),randomScalingFactor()]*/  /*票数*/
        }
    ]
};
window.onload = function(){
    var ctx = document.getElementById("canvas").getContext("2d");
    window.myBar = new Chart(ctx).Bar(barChartData, {
        responsive : true
    });
};