$(document).ready(function() {
    /**
    * call the lineTempF.php file to fetch the result from db table.
    */
    $.ajax({
        url : "http://sipreif.isaacvilchez.com/uat/api/linetemp.php",
        type : "GET",
        success : function(data){

          var chartd = {
            sensor111 : [],
            sensor211 : [],
            sensor311 : [],
            sensor112 : [],
            sensor212 : [],
            sensor312 : [],
          }

          var labeld = {
            sensor111 : [],
            sensor211 : [],
            sensor311 : [],
            sensor112 : [],
            sensor212 : [],
            sensor312 : [],
          }

          var read_sid = [];

          var len = data.length;
          console.log(len);
          for (var i = 0; i < len; i++) {
                if (data[i].id == "111") {
                  read_sid.push("Sensor ID: "+data[i].id);
                    chartd.sensor111.push(data[i].temperature);
                    labeld.sensor111.push("Timestamp: "+data[i].unix);
                }
                else if (data[i].id == "211") {
                  read_sid.push("Sensor ID: "+data[i].id);
                    chartd.sensor211.push(data[i].temperature);
                }
                else if (data[i].id == "311") {
                  read_sid.push("Sensor ID: "+data[i].id);
                    chartd.sensor311.push(data[i].temperature);
                }
                else if (data[i].id == "112") {
                  read_sid.push("Sensor ID: "+data[i].id);
                  labeld.sensor112.push("Timestamp: "+data[i].unix);
                    chartd.sensor112.push(data[i].temperature);
                }
                else if (data[i].id == "212") {
                  read_sid.push("Sensor ID: "+data[i].id);
                    chartd.sensor212.push(data[i].temperature);
                }
                else if (data[i].id == "312") {
                  read_sid.push("Sensor ID: "+data[i].id);
                    chartd.sensor312.push(data[i].temperature);
                }
            }
            console.log(chartd);

            //get canvas
            var chartdata = {
              labels : data.unix,
              datasets : [{
                label: labeld.sensor111,
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(59, 89, 152, 0.75)",
                borderColor: "rgba(59, 89, 152, 1)",
                pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                data: chartd.sensor111
              },
              {
                label: "Temp: ",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(59, 89, 152, 0.75)",
                borderColor: "rgba(59, 89, 152, 1)",
                pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                data: chartd.sensor211
              },
              {
                label: "Temp: ",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(59, 89, 152, 0.75)",
                borderColor: "rgba(59, 89, 152, 1)",
                pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                data: chartd.sensor311
              },
              {
                label: labeld.sensor112,
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(59, 89, 152, 0.75)",
                borderColor: "rgba(59, 89, 152, 1)",
                pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                data: chartd.sensor112
              },
              {
                label: "Temp: ",
                fill: false,
                lineTension: 0.1,
                backgroundColor: "rgba(59, 89, 152, 0.75)",
                borderColor: "rgba(59, 89, 152, 1)",
                pointHoverBackgroundColor: "rgba(59, 89, 152, 1)",
                pointHoverBorderColor: "rgba(59, 89, 152, 1)",
                data: chartd.sensor212
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

            //var ctx = document.getElementById('mylineChart').getContext('2d');
            var ctx = $("#mylineChart");
            var chart = new Chart( ctx, {
              type: 'line',
              data : chartdata
            });
        },
        error : function(data) {
            console.log(data);
        }
    });
});
