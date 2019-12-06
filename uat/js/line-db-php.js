$(document).ready(function() {
    /**
    * call the lineTempF.php file to fetch the result from db table.
    */
    $.ajax({
        url : "http://sipreif.isaacvilchez.com/uat/api/lineTempF.php",
        type : "GET",
        success : function(data){
            var sensor111 = [];
            var sensor211 = [];
            var sensor311 = [];
            var sensor112 = [];
            var sensor212 = [];
            var sensor312 = [];

            var read_sid = [];
            var read_time = [];

            var len = data.length;
            console.log(len);
            for (var i = 0; i < len; i++) {
                if (data[i].id == "111") {
                  read_sid.push("Sensor ID: "+data[i].id);
                  sensor111.push(data[i].temperature);
                  read_time.push("Timestamp "+data[i].unix);
                }
                else if (data[i].id == "211") {
                  read_sid.push("Sensor ID: "+data[i].id);
                  sensor211.push(data[i].temperature);
                }
                else if (data[i].id == "311") {
                  read_sid.push("Sensor ID: "+data[i].id);
                  sensor311.push(data[i].temperature);
                }
                else if (data[i].id == "112") {
                  read_sid.push("Sensor ID: "+data[i].id);
                  sensor112.push(data[i].temperature);
                }
                else if (data[i].id == "212") {
                  read_sid.push("Sensor ID: "+data[i].id);
                  sensor212.push(data[i].temperature);
                }
                else if (data[i].id == "312") {
                  read_sid.push("Sensor ID: "+data[i].id);
                  sensor312.push(data[i].temperature);
                }
            }
            console.log(read_time);

            //get canvas
            var data = {
              labels : read_time,
              datasets : [{
                    label : "Sensor111 temp",
                    data : sensor111,
                    backgroundColor : "blue",
                    borderColor : "lightblue",
                    fill : false,
                    lineTension : 0,
                    pointRadius : 5
                },
                {
                    label : "Sensor211 temp",
                    data : sensor211,
                    backgroundColor : "green",
                    borderColor : "lightgreen",
                    fill : false,
                    lineTension : 0,
                    pointRadius : 5
                },
                {
                    label : "Sensor311 temp",
                    data : sensor311,
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(59, 89, 152, 0.75)",
                    borderColor: "rgba(59, 89, 152, 1)",
                    pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                    pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                },
                {
                    label : "Sensor112 temp",
                    data : sensor112,
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(59, 89, 152, 0.75)",
                    borderColor: "rgba(59, 89, 30, 1)",
                    pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                    pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                },
                {
                    label : "Sensor212 temp",
                    data : sensor212,
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(59, 89, 152, 0.75)",
                    borderColor: "red",
                    pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                    pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                },
                {
                    label : "Sensor312 temp",
                    data : sensor312,
                    fill: false,
                    lineTension: 0.1,
                    backgroundColor: "rgba(59, 89, 152, 0.75)",
                    borderColor: "black",
                    pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                    pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                }]
            };
            var options = {
                title : {
                    display : true,
                    position : "top",
                    text : "Line Graph"
                },
                legend : {
                    display : true,
                    position : "bottom"
                }
            };

            //var ctx = document.getElementById('line-chartcanvas').getContext('2d');
            var ctx = $("#mylineChart");
            var chart = new Chart( ctx, {
              type: 'line',
              data : data
            });
        },
        error : function(data) {
            console.log(data);
        }
    });
});
