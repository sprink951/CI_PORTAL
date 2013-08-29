<?php
				$con = mysql_connect("localhost","root","");
				if (!$con)
				  {
				  die('Could not connect: ' . mysql_error());
				  }
				
				mysql_select_db("test", $con);
				
				$result = mysql_query("SELECT * FROM portalinfo");
				
				echo "<div class='control-group info'>
				<h4 class='control-label' for='inputInfo'>
					Portal
				</h4> 
				</div>";
				echo "<table class='table table-striped table-bordered'>
				<thead >
				<th rowspan='2'>”√ªß/password</th>
				<th rowspan='2'>Policy</th>
				<th rowspan='2'>State</th>
				<th rowspan='2'>LastLoginTime</th>
				<th colspan ='2'>Statistics</th>
				<tr>
					<th >OnlineTime</th>
					<th >UsedTraffic</th>
				</tr>
				</th>
				</thead>";
				
				while($row = mysql_fetch_array($result))
				  {
				  echo "<tr>";
				  echo "<td>" . $row['User'] . "</td>";
				  echo "<td>" . $row['Policy'] . "</td>";
				  echo "<td>" . $row['State'] . "</td>";
				  echo "<td>" . $row['LastLoginTime'] . "</td>";
				  echo "<td>" . $row['OnlineTime'] . "</td>";
				  echo "<td>" . $row['UsedTraffic'] . "</td>";
				  echo "</tr>";
				  }
				echo "</table>";
				
				mysql_close($con);
?>