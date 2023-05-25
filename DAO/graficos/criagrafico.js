google.charts.load('current', {
    'packages': ['line']
  });
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {

    var data = new google.visualization.DataTable();

    data.addColumn('string', 'nome');
    data.addColumn('number', 'asd of the Galaxy');
    data.addColumn('number', 'The Avengers');
    data.addColumn('number', 'Transformers: Age of Extinction');

    data.addRows([
      ['asd', 37.8, 80.8, 41.8],
      ['asddsa', 30.9, 69.5, 32.4],
      ['sadasg', 25.4, 57, 25.7]
    ]);

    var options = {
      chart: {
        title: 'teste',
        subtitle: 'subtitulo'
      },
      legend: { position: 'top'},
      width: 'auto',
      height: 500,
      axes: {
        x: {
          0: {
            side: 'top'
          }
        }
      }
    };

    var chart = new google.charts.Line(document.getElementById('line_top_x'));

    chart.draw(data, google.charts.Line.convertOptions(options));
  }