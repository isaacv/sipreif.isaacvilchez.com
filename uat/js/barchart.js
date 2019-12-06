$(document).ready(function(){
  $.ajax({
    url: "http://sipreif.isaacvilchez.com/uat/api/barchart.php",
    method: "GET",
    success: function(data) {
      console.log(data);
      var sensorid = [];
      var temp = [];
      var hum = [];

      for(var i in data) {
        sensorid.push("Sensod ID: " + data[i].id);
        temp.push(data[i].temperature);
        hum.push(data[i].humidity);
      }

      var chartdata = {
        labels: sensorid,
        datasets : [
          {
            label: 'Temperature',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'rgba(200, 200, 200, 0.75)',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: temp
          },
          {
            label: 'Humidity',
            backgroundColor: 'rgba(200, 200, 200, 0.75)',
            borderColor: 'blue',
            hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
            hoverBorderColor: 'rgba(200, 200, 200, 1)',
            data: hum
          }
        ]
      };

      console.log(chartdata);

      var ctx = $("#mybarChart");

      var barGraph = new Chart(ctx, {
        type: 'bar',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
