
<a href="http://bl.ocks.org/mbostock/3884955"> D3 multi line chart</a>

<div>

<!-- load the d3.js library -->     
<script src="https://d3js.org/d3.v4.min.js"></script>
<script>

// set the dimensions and margins of the graph
var margin = {top: 60, right: 60, bottom: 60, left: 50},
    width = 960 - margin.left - margin.right,
    height = 500 - margin.top - margin.bottom;

// parse the date / time
//var parseTime = d3.timeParse("%_d-%b-%y");
var parseTime = d3.timeParse("%Y-%m-%d");

// set the ranges
var x = d3.scaleTime()
  .range([0, width])
  //.tickFormat("%Y-%m-%d");
var y = d3.scaleLinear().range([height, 0]);

// define the 1st line
var valueline = d3.line()
    .x(function(d) { return x(d.date); })
    .y(function(d) { return y(d.cbr_rate); });

// define the 2nd line
var valueline2 = d3.line()
    .x(function(d) { return x(d.date); })
    .y(function(d) { return y(d.ecb_rate); });

// append the svg obgect to the body of the page
// appends a 'group' element to 'svg'
// moves the 'group' element to the top left margin
var svg = d3.select("body").append("svg")
    .attr("width", width + margin.left + margin.right)
    .attr("height", height + margin.top + margin.bottom)
  .append("g")
    .attr("transform",
          "translate(" + margin.left + "," + margin.top + ")");

// Get the data
//d3.json doesn't work with php echo <\?=...?>, only
d3.json("php/d3_data_json.php", function(error, data) {
  if (error) throw error;

  // format the data
  data.forEach(function(d) {
      d.date = parseTime(d.date);
      d.cbr_rate = +d.cbr_rate;
      d.ecb_rate = +d.ecb_rate;
  });

  // Scale the range of the data
  //x.domain([new Date(2016, 07, 20), new Date(2016, 08, 5)]);
  x.domain(d3.extent(data, function(d) { return d.date; }));

  //.ticks(20);
  // x.ticks(20);
  // x.tickFormat("%Y-%m-%d");
  
 
  y.domain([
    d3.min(data, function(d) {
    return Math.min(d.cbr_rate, d.ecb_rate); }), 
    d3.max(data, function(d) {
    return Math.max(d.cbr_rate, d.ecb_rate); })]);

  // Add the valueline path.
  svg.append("path")
      .data([data])
      .attr("class", "d3_line")
      .style("fill", "none")
      .style("stroke", "red")
      .style("stroke-width", "4px")
      .attr("d", valueline);

  // Add the valueline2 path.
  svg.append("path")
      .data([data])
      .attr("class", "d3_line")
      .style("fill", "none")
      .style("stroke", "steelblue")
      .style("stroke-width", "4px")
      .attr("d", valueline2);

  // Add the X Axis
  svg.append("g")
      .attr("transform", "translate(0," + height + ")")
      .call(d3.axisBottom(x).tickFormat(d3.timeFormat("%Y-%m-%d")))
      .selectAll("text")  
            .style("text-anchor", "end")
            .attr("dx", "-.8em")
            .attr("dy", ".15em")
            .attr("transform", "rotate(-65)" );

  // Add the Y Axis
  svg.append("g")
      .call(d3.axisLeft(y));

  svg.append("text")
      .attr("class", "axis axis--y")
      //a.call(d3.axisLeft(y).ticks(10, "s"))
      .attr("x", 20)
      .attr("y", -10)
      //.attr("y", y(y.ticks(10).pop()))
      .attr("dy", "0.35em")
      .attr("text-anchor", "start")
      .attr("fill", "steelblue")
      .text("Курс Евро Европейский ЦБ");

  svg.append("text")
      .attr("class", "axis axis--y")
      //a.call(d3.axisLeft(y).ticks(10, "s"))
      .attr("x", 20)
      .attr("y", -30)
      //.attr("y", y(y.ticks(10).pop()))
      .attr("dy", "0.35em")
      .attr("text-anchor", "start")
      .attr("fill", "red")
      .text("Курс Евро ЦБ РФ");

});
</script>
</div>