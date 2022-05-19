<?php 

				
				// <th>City</th>
				// <th>State</th>
				// <th>Contact-1</th>
				// <th>Contact-2</th>
				// <th>View</th>
				// <th>Delete</th>
					
							$result=$con->query($sql);
							$n=0;
							if($result->num_rows>0)
							{
								while($row=$result->fetch_assoc())
								{   
									$n++;
									echo "<tr>";
									echo "<td>".$n."</td>";
									echo "<td>".$row['NAME']."</td>";
									echo "<td>".$row['GENDER']."</td>";
									echo "<td>".$row['BLOOD']."</td>";
									echo "<td>".$row['EMAIL']."</td>";

									
									echo "</tr>";
								}
							}
							// echo "<td>".$row['CITY']."</td>";
							// 		echo "<td>".$row['STATE']."</td>";
							// 		echo "<td>".$row['CONTACT_1']."</td>";
							// 		echo "<td>".$row['CONTACT_2']."</td>";
										
							// 		echo "<td><a href='admin_view_donor.php?id=".$row['DONOR_ID']."' class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> View</a></td>";
							// 		echo "<td><a href='admin_delete_donor.php?id=".$row['DONOR_ID']."' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a></td>";
			





?>
