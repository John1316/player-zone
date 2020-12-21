<?php
require_once('connection.php');
$output = '';
if(isset($_POST["query"]))
{
	$search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "SELECT * FROM playfields WHERE name LIKE '%".$search."%' ";
}
else
{
	$query = "SELECT * FROM playfields ORDER BY id";
}
$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{

	while($row = mysqli_fetch_array($result))
	{
        $output .= "

			    <div class='col-lg-4 col-md-6 col-sm-12 my-3'>
                    <div class='card'>
                        <img src='images/".$row["image"]."' class='card-img-top' alt='...'>
                        <div class='card-body text-center'>
                            <h5 class='card-title'>".$row['name']."</h5>
                            <p class='card-text'>".substr($row['des'],0,50) ."</p>
                            <a href='cart.php?id=".$row["id"]."' class='btn btn-main'>Details</a>
                        </div>
                    </div>
                </div>


                
		";
	}
	echo $output;
}
else
{
	echo '<h3 class="h3 m-auto">Data Not Found</h3>';
}
?>