<?php
session_start();
$codeshop = $_SESSION['codeshop'];
include '../database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
  
  <title>Customer</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap.min.css">
  <script src="script.js"></script>
  <script src="script2.js"></script>
  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    .row.content {
      height: 1100px;
      width: 500px;
    }
    
    /* Set gray background color and 100% height */
    .sidenav {
      background-color: #f1f1f1;
      height: 100%;
      width: 300px;
    }
        
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 500px) {
      .sidenav {
        height: auto;
      }
      .row.content {height: auto;} 
    }
    .col-sm-3{
      background-color: black;
    }
    .nav{
      padding: 10px 10px;
    }
    .main-body{
      background-color: gray;
      position: absolute;
      left: 285px; top: 60px;
      height: 1100px;
      width: 1068px;
    }
    .col-sm-9{
      background-color: white;
      position: absolute;
      top: 15px;
      left: 15px;
      height: 100%;
      width: 97%;
    }
    @media print {
      a[href]:after {
        content: none !important;
      }
    }
  </style>
</head>

<body>

  <!--   header -->
  <div><?php  include('header.php'); ?></div>

  <div class="row content">
    <div class="col-sm-3 sidenav">
      <ul style="list-style: none;">
      </ul>
      
      <ul class="nav nav-pills nav-stacked">
        <li class="active"><a href="home.php">Dashboard</a></li>
        <li><a href="add_product_page.php">Add Products</a></li>
        <li><a href="shop_product.php">Shop Products</a></li>
        <li><a href="expense.php">Expenses</a></li>
        <li><a href="sale.php">Sales</a></li>
        <li><a href="statistics.php">Statistics</a></li>
        <li><a href="invoice.php">invoice Maker</a></li>
        <li><a href="product_category.php">Product Categories</a></li>
        <li><a href="product_unit.php">Product Units</a></li>
        <li><a href="add_customer.php">Add Customer</a></li>
        <li><a href="add_vendor.php">Add Vendor</a></li>
        <li><a href="proloss.php">Profit/Loss</a></li>

      </ul><br>
   
    </div>
    

    <div class="main-body">
     <div class="col-sm-9">
      <button style="position: absolute; left: 0;top: 0;background-color: white; border: 1px solid white;" onclick="printContent('print')">p</button>
        <script>
         function printContent(el) {
         var restorepage = document.body.innerHTML;
         var printcontent = document.getElementById(el).innerHTML;
         document.body.innerHTML = printcontent;
         window.print();
         document.body.innerHTML = restorepage;
         }
        </script>


       <div style="position: absolute; left: 10px; top: 10px; right: 10px; width: 98%; height: 98%;">
         <style>
            .box{
              width:1270px;
              padding:20px;
              background-color:#fff;
              border:1px solid #ccc;
              border-radius:5px;
              margin-top:25px;
              box-sizing:border-box;
              }
              #user_data {
                 font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                 border-collapse: collapse;
                 width: 100%;
               }
              #user_data td, #user_data th {
                 border: 1px solid #ddd;
               }
              #user_data tr:nth-child(even){background-color: #f2f2f2;}
              #user_data tr:hover {background-color: #ddd;}
         </style>

         <div class="container box" style="position: absolute; left: 10px; width: 98%; height: 900px;">
            
            <div align="right">
              <button type="button" name="add" id="add" class="btn btn-info">Add</button>
            </div>
            <br />
            <div id="alert_message"></div>
            <div id="print">
            <table id="user_data" class="table table-bordered table-striped">
              <thead>
                <h4 style="color: green; font-size: 17px;"><b>Customer</b></h4>
                <tr>
                  <th style="color: green; font-size: 17px;"><b>Name</b></th>
                  <th style="color: green; font-size: 17px;"><b>Address</b></th>
                  <th style="color: green; font-size: 17px;"><b>Number</b></th>
                  <th style="color: green; font-size: 17px;"><b>Group</b></th>
                  <th></th>
                </tr>
              </thead>

              <?php 
                 $query  = "SELECT * from customer WHERE shopcode='$codeshop'";   
                 $result = mysql_query($query) or die(mysql_error());
                 while ($row= mysql_fetch_array($result)) {
                  $name=$row['name'];
                  $address=$row['address'];
                  $mobile=$row['mobile'];
                  $group=$row['groupp'];
               ?>

              <tbody>
                <tr>
                  <th><?php echo $name; ?></th>
                  <th><?php echo $address; ?></th>
                  <th><?php echo $mobile; ?></th>
                  <th><?php echo $group; ?></th>
                  <th style="width: 10%; text-align: center;"><a href="delete_customer.php?id=<?=$row['sl_no']?>">Delete</a></th>
                </tr>
              </tbody>

              <?php  
                 }   
                 mysql_close();
              ?>

            </table>
         </div>
        </div>
       </div>
     </div>
    </div>

  </div>
</body>
</html>

<script type="text/javascript" language="javascript" >
  $(document).ready(function(){
    

    $('#add').click(function(){
      var html = '<tr>';
      html += '<td contenteditable id="data1"></td>';
      html += '<td contenteditable id="data2"></td>';
      html += '<td contenteditable id="data3"></td>';
      html += '<td contenteditable id="data4"></td>';
      html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs">Insert</button></td>';
      html += '</tr>';
      $('#user_data').prepend(html);
    });
    
    $(document).on('click', '#insert', function(){
      var customer_name = $('#data1').text();
      var customer_address = $('#data2').text();
      var customer_mobile = $('#data3').text();
      var customer_group = $('#data4').text();
      if(customer_name != '' && customer_address != '' && customer_mobile != '' && customer_group != '')
      {
        $.ajax({
          url:"insert_customer.php",
          method:"POST",
          data:{
            'customer_name':customer_name,
            'customer_address':customer_address,
            'customer_mobile':customer_mobile,
            'customer_group':customer_group
          },
          success:function(data)
          {
            console.log(data);
            $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
            $('#user_data').DataTable().destroy();
          }
        });
        setInterval(function(){
          $('#alert_message').html('');
        }, 5000);
      }
      else
      {
        alert("Both Fields is required");
      }
    });
    
  });
</script>