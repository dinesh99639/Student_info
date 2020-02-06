<?php

    $mysqli = mysqli_connect("localhost", "root", "", "student_info");
	$qry = "SELECT rollno from details where rollno like '%71%'";
    
?>
<!DOCTYPE html>
<html>
    <head>
    	<title>Attendance</title>
        <style>
            table,td
            {
	            border: 1px solid black;
	            text-align:center;
	            font-family: arial, sans-serif;
	            margin-left:10%;
	            border-collapse: collapse;
            }
            input
            {
	            width: 90%;
	            border: none;
	            outline: none;
            }
            th
            {
            	border: 1px solid black;
            }
            tr
            {
            	height: auto;
            }
            .button
            {
	            text-align: center;
	            margin-bottom: 20px;
            }
            .btn
            {
	            border:1px solid black;
	            padding:6px 10px;
	            color: white;
	            text-decoration: none;
	            background-color: lightgreen;
	            border-radius: 30px;
	            outline: none;
            }
            .btn:hover
            {
            	background-color: grey;
            }
            @media print
            {
	            table
	            {
	            margin: 0;
	            }
            }
            textarea
            {  
	            width: 97%;
	            font-size: 14px;
	            border: none;
	            outline: none;
	            resize: none;
            }
            col
            {
                height:100px;
                width:100px;
            }
            input[type="date"]::-webkit-inner-spin-button,
            input[type="date"]::-webkit-clear-button
			/*input[type="date"]::-webkit-calendar-picker-indicator */
			{
				border: 0;
			    display: none;
			    -webkit-appearance: none;
			}
        </style>
        <script type="text/javascript" src="../js/jquery.min.js"></script>
        <!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
        <script type="text/javascript"></script>
    </head>
    <body>
        <h1 style="text-align:center;">ATTENDANCE</h1>
        <div class="button">
            <button onclick="appendColumn()" class='btn'>Add Date</button>
            <button onclick="deleteColumns()" class='btn'>Delete Date</button>
            <!-- <button onclick="copy()" class='btn'>Copy</button> -->
        </div>
        <table id="myTable" style="">
            <tr>
                <th style='width: 50px;height: 30px;'>Roll no</th>
            </tr>
            <?php
			if ($result = $mysqli->query($qry)) 
			{
	            while ($row = $result->fetch_assoc()) 
	            {
	            	$field1name = $row["rollno"];
	                    
	                echo "<tr> 
		                  	<td style='width: 150px;'>$field1name</td>  
		                  </tr>";
	            }
            }
            ?>
        </table>
    </body>
    <script>
    function createCell(cell, loop)
	{
		var div = document.createElement('div');
		div.setAttribute('style', 'width: 50px');

		cell.appendChild(div);
		cell.innerHTML = "<input style='text-align: center;width: 50px;font-size: 15px;padding: 0;margin: 0;' type='text'>";
		if (loop == 0) cell.innerHTML="<input type='date' style='text-align: center; width: 80px;font-size: 0.8rem;padding: 0;margin: 0;overflow: none;'>";

	}
	function appendColumn() 
	{
	    var tbl = document.getElementById('myTable'), i;

	    for (i = 0; i < tbl.rows.length+1; i++) 
	    {
	        createCell(tbl.rows[i].insertCell(tbl.rows[i].cells.length),i);
	        // console.log(tbl.rows[i].cells.length);
	    }
	    // tbl.rows[0].innerHTML="<input type='date' style='border: 1px solid; width: auto;'>";
    }
    function deleteColumns() 
    {
	    var tbl = document.getElementById('myTable'), i;
	    
	    if (tbl.rows[0].cells.length > 1)
	    for (i = 0; i < tbl.rows.length+1; i++) 
	    {
	        tbl.rows[i].deleteCell(-1);
	    }

	}  

	function copy()
    {
        var copy = $('#paper').html();
	}
  </script>
</html>