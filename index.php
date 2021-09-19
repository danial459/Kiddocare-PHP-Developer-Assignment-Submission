<?php
session_start();

if($_SESSION["authenticated"] == 'true')
{
    include('dbconnect.php');
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    <title>Document</title>
</head>
<body>
    
<nav class="navbar navbar-expand-lg navbar-light bg-light border">
      <h3 class="py-2"><b>Sales Dashboard</b></h3>
      <ul class="navbar-nav form-inline ml-auto">
            <form action="logout.php" method="post">
                <input type="submit" value="log out">
            </form>
      </ul>
</nav>


<div class="col-lg-12 rounded bg-white js-active my-4">
<div class="form-row">
            <div class="form-group col-12 col-lg-6 ">
                  <h3>May 1995</h3>
            </div>
</div>

</div>

<div class="row ml-1 mb-5">
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total Sales</h5>
        <p class="card-text"><h2><?php echo "RM ".$total_sales ?></h2></p>
       
      </div>
    </div>
  </div>
  <div class="col-sm-3">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Total Orders</h5>
        <p class="card-text"><h2><?php echo $total_orders ?></h2></p>
        
      </div>
    </div>
  </div>
</div>





<div class="container-fluid">

  <div class="border py-4" style="margin-bottom: 50px;">
    <div id="chartContainer" style="height: 500px; width: 100%;">
    </div>
  </div>


<div class="border py-4" style="margin-bottom: 50px;">
  <div id="piechartContainer" style="height: 500px; width: 100%;">
  </div>
</div>

<div class="border py-4" style="margin-bottom: 50px;">
  <div id="horizontalchartContainer_1" style="height: 800px; width: 100%;">
  </div>
</div>


<div class="border py-4" style="margin-bottom: 50px;">
  <div id="horizontalchartContainer_2" style="height: 700px; width: 100%;">
  </div>
</div>

</div>




</body>
</html>

<script type="text/javascript">
  window.onload = function () {
    var bar_chart = new CanvasJS.Chart("chartContainer",
    {
      animationEnabled: true,
      title:{
        text: "Daily sales"    
      },
      dataPointMaxWidth: 50,
      axisY: {
        title: "Sales(RM)",
        interval:11000
      },
      axisX:{
        interval: 1
      },
      legend: {
        verticalAlign: "bottom",
        horizontalAlign: "center"
      },
      data: [

      {        
        color: "#6BB1DE",
        type: "column",  
        showInLegend: true, 
        legendMarkerType: "none",
        legendText: "Day",
        dataPoints: [   

       <?php 
        $i = 1;
        foreach($result_3 as $daily_sales) {
    
        echo "{ x: ".$i.", y: ".$daily_sales['sales'].",  label: '".substr($daily_sales['orderdate'],-11,2)."' },";
        $i++;
        }
        ?>
        ]
      }
      ]
    });

    bar_chart.render();




    var chart = new CanvasJS.Chart("piechartContainer",
	{
    animationEnabled: true,
		theme: "light2",
		title:{
			text: "Sales by Product Categories"
		},		
    axisY: {
        title: "Sales(RM)",
        interval:11000
      },
		data: [
		{       
			type: "pie",
			showInLegend: true,
			toolTipContent: "RM {y} - #percent %",

			legendText: "{indexLabel}",
			dataPoints: [

        <?php
        foreach($result_4 as $category_sales){
			  	echo "{  y: ".$category_sales['sales'].", indexLabel: '".$category_sales['categoryname']."' },";
        }
		    ?>
			]
		}
		]
	});
	chart.render();
  }




  var horizontalchart_1 = new CanvasJS.Chart("horizontalchartContainer_1",
    {
      animationEnabled: true,
      title:{
        text: "Sales(RM) by Customers"
      },
      
      axisX:{
		    interval: 1
	    },
      data: [
      {
        type: "bar",
        toolTipContent: "RM {y}",
        dataPoints: [

    <?php
    foreach($result_5 as $customers_sales)
        echo "{ y: ".$customers_sales['sales'].", label: '".$customers_sales['contactname']."'},";
    ?>
        ]
      },
      
      ]
    });

   horizontalchart_1.render();






   var horizontalchart_2 = new CanvasJS.Chart("horizontalchartContainer_2",
    {
      animationEnabled: true,
      title:{
        text: "Sales(RM) by Employees"
      },
      
      axisX:{
		    interval: 1
	    },
      data: [
      {
        type: "bar",
        toolTipContent: "RM {y}",
        dataPoints: [

    <?php
    foreach($result_6 as $employees_sales)
        echo "{ y: ".$employees_sales['sales'].", label: '".$employees_sales['fname']."'},";
    ?>
        ]
      },
      
      ]
    });

   horizontalchart_2.render();






  
	



</script>


<?php
}
else{

    header('Location: login.php');

}


?>





