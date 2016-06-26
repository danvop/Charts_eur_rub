<html>
<head>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);


      var chart_data = ([
        ['2016-06-19',  37.8],
        ['2016-06-20',  30.9],
        ['2016-06-21',  25.4],
        ['2016-06-22',  1],
        ['2016-06-23',  11.9],
        ['2016-06-24',   8.8],
        ['2016-06-25',   7.6],
        ['2016-06-26',  1],
        ['2016-06-19',  37.8],
        ['2016-06-20',  30.9],
        ['2016-06-21',  25.4],
        ['2016-06-22',  1],
        ['2016-06-23',  11.9],
        ['2016-06-24',   8.8],
        ['2016-06-25',   7.6],
        ['2016-06-26',  1]
      ]);

      /*var chart_data = ([
        [2016-06-19,  37.8],
        [2016-06-20,  30.9],
        [2016-06-21,  25.4],
        [2016-06-22,  1],
        [2016-06-23,  11.9],
        [2016-06-24,   8.8],
        [2016-06-25,   7.6],
        [2016-06-26,  1]
      ]);*/

      // var chart_data = ([
      //   [1,  37.8, 80.8, 41.8],
      //   [2,  30.9, 69.5, 32.4],
      //   [3,  25.4,   57, 25.7],
      //   [4,  1, 1, 1],
      //   [5,  11.9, 2, 2],
      //   [6,   8.8, 3,  3],
      //   [7,   7.6, 12.3,  9.6],
      //   [8,  1, 29.2,1],
      //   [9,  16.9, 42.9, 14.8],
      //   [10, 12.8, 30.9, 11.6],
      //   [11,  5.3,  7.9,  4.7],
      //   [12,  6.6,  8.4,  5.2],
      //   [13,  4.8,  6.3,  3.6],
      //   [14,  4.2,  6.2,  3.4]
      // ]);
    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Day');
      data.addColumn('number', 'Guardians of the Galaxy');
      // data.addColumn('number', 'The Avengers');
      // data.addColumn('number', 'Transformers: Age of Extinction');

      data.addRows(chart_data);

      var options = {
        chart: {
          title: 'Box Office Earnings in First Two Weeks of Opening',
          subtitle: 'in millions of dollars (USD)'
        },
        width: 900,
        height: 500,
        
        
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, options);
    }
  </script>
</head>
<body>
  <div id="line_top_x"></div>
</body>
</html>
