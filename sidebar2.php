<div id="sidebar" class="col-2 backG">
	<div id="profile"></div>
		<div>
			<nav id="navbar-example3" class="navbar navbar-light bg-light">
			  <nav class="nav nav-pills flex-column">
			  	<div class="sidenav">
					<ul id="links2">

					</ul>
				</div>
			  </nav>
			</nav>
		</div>

</div>

<script>
function list(){

	var xhttp3 = new XMLHttpRequest();
	xhttp3.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	       // Typical action to be performed when the document is ready:
	       var t = JSON.parse(xhttp3.responseText);
	       var h = '';
	       var name = [];
	  //      for(var i=0; i<t.length; i++){
	  //      		name.push(t[i].name);
			// } 
			// name = name.sort();
			for(var i=0; i<t.length; i++){
	       		h += '<li><a class="nav-link" href="#item-'+t[i].id+'">'+t[i].name+'</a></li>';
			}
			document.getElementById('links2').innerHTML=h


	    }
	};
	xhttp3.open("GET", "functions.php?f=list", true);
	xhttp3.send();
}
list();
</script>


