
<?php
require('db.php');

$loggedin = false;

if(isset($_COOKIE['name'])) $loggedin = true;

if(isset($_POST['name'])&&isset($_POST['password'])){
  $sql = "SELECT * FROM `users` WHERE `name` = '".$_POST['name']."' AND `password` = '".md5($_POST['password'])."' LIMIT 1";
  $result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    $loggedin = true;
    $cookie_name = "name";
    $cookie_value = $row['name'];
    setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");
    $name = $row['name'];


  }
}
}



if(!$loggedin){
  header("Location: index.php?error=Wrong Password");
// } else {

// $sql = "SELECT * FROM `users` WHERE `name` = '".$_COOKIE['name']."' LIMIT 1";
// $result = $conn->query($sql);
// if ($result->num_rows > 0) {
//   while($row = $result->fetch_assoc()) {
//     $name = $row['name'];

//   }
// }
}

?>

<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<?php
$header = 'Homepage';
if(isset($_GET['sym'])){
	$header = strtoupper($_GET['sym']);
}

?>
<div id="back1" class="col-10">

	<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><h1><?php echo $header ?></h1></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="app.php"><h3>Home</h3><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="app2.php"><h3>users</h3></a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
	<div class="dropdown">
      <input type="text" class="form-control mr-sm-2 CrossSearch-input" id="autosuggest" onkeyup="showSuggestions()" onclick="showSuggestions()" autocomplete="off">
<style>

	#suggestions{
		display: none;
		overflow: auto;
		height: 300px;

	}
      #suggestions ul{
      	list-style: none;
      	padding: 0;
  }
  	#suggestions li{
  		color: #000000;
  		padding: 10px 20px;
  		text-align: center;
  	}
  	  	#suggestions li:hover{
  	  		background-color: #ffffff;
  	  		color: #000000;

  	  	}
.dropdown {
  position: relative;
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content ul li {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

.dropdown-content ul li:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #3e8e41;
}
</style>
      <div id="suggestions" class="dropdown-content">
	      	<ul>
	      	</ul>
      </div>
    </div>
      <button class="btn btn-secondary my-2 my-sm-0 mr-sm-2" onclick="go()">Search</button>
	  <a class="btn btn-primary" href="index.php">Logout</a>
    </form>
  </div>
</nav>
		<div class=" col-12" id="meinback">
			<canvas id="myChart" width="400" height="200"></canvas>
			<div id="out"></div>
		</div>
</div>

<?php 
 //if($header!='Homepage'){
?>
<script>


	 var symArray = [];

function showSuggestions(){
	document.querySelector('#suggestions').style.display='block';
		    //<li onclick="s(0)" id="s0">test1</li>
	var html = '';
	var s = document.querySelector('#autosuggest').value;

			 var array2 = [];
			for(var i=0; i<symArray.length; i++){
			var regex = new RegExp( s, "i");
			if(symArray[i].search(regex)>=0){
					array2.push('<li onclick="s('+i+')" id="s'+i+'">'+symArray[i]+'</li>');
			}
			}
			for(var i=0; i<array2.length; i++){
				html+=array2[i];
			}
	document.querySelector('#suggestions ul').innerHTML = html;


}

function s(n){
	document.querySelector('#autosuggest').value=document.querySelector('#s'+n).innerText;
	document.querySelector('#suggestions').style.display='none'
	window.location.href="http://localhost/crypto/app.php?sym="+document.querySelector('#s'+n).innerText
}

function go(){
	
	var s = document.querySelector('#autosuggest').value;
	window.location.href='app.php?sym='+s;

}


	
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
       var t = JSON.parse(xhttp.responseText);
       var h = '';
       var labelArray=[];
       var dataArray=[];
	   var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
       for(var i=0; i<t.<?php echo $header ?>USD.length; i++){
	       var price = t.<?php echo $header ?>USD[i].price;
	       var time =  new Date(t.<?php echo $header ?>USD[i].timestamp);
	       var time2 = months[time.getMonth()]+' '+time.getDate()+', '+time.getFullYear();
	       labelArray.push(time.getHours()+":"+time.getMinutes()+":"+time.getSeconds());
	       dataArray.push(t.<?php echo $header ?>USD[i].price);
	       h+='$ '+price+'<br>'+time2+'<br><br>';
   		}
	   //document.getElementById("output").innerHTML = h;
	   labelArray = labelArray.reverse();
	   dataArray = dataArray.reverse();
	   h='';
	   h+='<br>Maximum Value: '+Math.max(...dataArray);
	   h+='<br>Minimum Value: '+Math.min(...dataArray);
	   document.getElementById('out').innerHTML=h;
		var ctx = document.getElementById('myChart').getContext('2d');
		var myChart = new Chart(ctx, {
		    type: 'line',
		    data: {
		        labels: labelArray,
		        datasets: [{
		            label: '<?php echo $header ?> price',
		            data: dataArray,
		            backgroundColor: [
		                'rgba(102, 255, 255, 0.2)'
		            ],
		            borderColor: [
		                'rgba(102, 255, 255, 1)'
		            ],
		            borderWidth: 1
		        }]
		    },
		    options: {
		        scales: {
		            yAxes: [{
		                ticks: {
		                    beginAtZero: false
		                }
		            }]
		        }
		    }
		});

    }
};
xhttp.open("GET", "https://thingproxy.freeboard.io/fetch/https://api.exchange.bitcoin.com/api/2/public/trades/?limit=50&symbols=<?php echo strtolower($header) ?>usd", true);
xhttp.send();



</script>

<?php
//}
?>

</div>
<?php include('footer.php'); ?>
