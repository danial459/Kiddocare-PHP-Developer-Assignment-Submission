<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "northwind";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql_1 = "SELECT round(sum((1-o.discount)*(o.quantity*o.unitprice)),2)
          FROM orders a 
          JOIN order_details o ON (a.orderid = o.orderid)
          WHERE a.orderdate BETWEEN '1995-5-1' AND '1995-5-31';
         ;
        ";
$result_1= $conn->query($sql_1);
$total_sales = $result_1->fetch_array()[0] ?? '';



$sql_2 = "SELECT COUNT(o.orderid)
          FROM orders a 
          JOIN order_details o ON (a.orderid = o.orderid)
          WHERE a.orderdate BETWEEN '1995-5-1' AND '1995-5-31';
        ";
$result_2= $conn->query($sql_2);
$total_orders = $result_2->fetch_array()[0] ?? '';



$sql_3 = "SELECT a.orderdate,round(SUM((1-o.discount)*(o.quantity*o.unitprice)),2) as sales
          FROM orders a JOIN order_details o ON (a.orderid = o.orderid)
          WHERE a.orderdate BETWEEN '1995-5-1' AND '1995-5-31'
          GROUP BY a.orderdate;
        ";
$result_3= $conn->query($sql_3);



$sql_4 = "SELECT c.categoryname,round(SUM((1-o.discount)*(o.quantity*o.unitprice)),2) AS sales
          FROM orders a 
          JOIN order_details o ON (a.orderid = o.orderid)
          JOIN products p ON (o.productid = p.productid)
          JOIN categories c ON (p.categoryid = c.categoryid)
          WHERE a.orderdate BETWEEN '1995-5-1' AND '1995-5-31'
          GROUP BY c.categoryname;
        ";
$result_4= $conn->query($sql_4);




$sql_5 = "SELECT c.contactname,round(SUM((1-o.discount)*(o.quantity*o.unitprice))) AS sales
          FROM orders a 
          JOIN customers c ON (c.customerid = a.customerid)
          JOIN order_details o ON (o.orderid = a.orderid)
          WHERE a.orderdate BETWEEN '1995-5-1' AND '1995-5-31'
          GROUP BY c.contactname
          ORDER BY sales ASC;
        ";
$result_5= $conn->query($sql_5);




$sql_6 = "SELECT concat(e.firstname,' ',e.lastname) AS fname,round(SUM((1-o.discount)*(o.quantity*o.unitprice))) AS sales
          FROM orders a 
          JOIN order_details o ON (o.orderid = a.orderid)
          JOIN employees e ON (e.employeeid = a.employeeid)
          WHERE a.orderdate BETWEEN '1995-5-1' AND '1995-5-31'
          GROUP BY fname
          ORDER BY sales ASC;
        ";
$result_6= $conn->query($sql_6);























?>