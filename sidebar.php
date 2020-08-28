<div id="sidebar" class="col-2 backG">
	<div id="profile"></div>
	 <div>
		<ul class="nav nav-tabs">
		  <li class="nav-item">
		    <a class="nav-link active" href="app.php">Graph</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" href="app2.php">Users</a>
		  </li>		  
		 </ul>
		</div>
		<div class="sidenav">
			<ul id="links">

			</ul>
		</div>
</div>

<script>

	       var symArray = [];

var xhttp2 = new XMLHttpRequest();
xhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
       var t = JSON.parse(xhttp2.responseText);
       var h = '';
       for(var i=0; i<t.length; i++){
       		symArray.push(t[i].id);
		}
		symArray = symArray.sort();
		for(var i=0; i<symArray.length; i++){
       		h += '<li><a href="app.php?sym='+symArray[i]+'">'+symArray[i]+'</a></li>';
		}
		document.getElementById('links').innerHTML=h


    }
};
xhttp2.open("GET", "https://thingproxy.freeboard.io/fetch/https://api.exchange.bitcoin.com/api/2/public/currency", true);
xhttp2.send();

</script>
