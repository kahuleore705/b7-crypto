<?php include('header.php'); ?>
<?php include('sidebar2.php'); ?>

<div id="back2" class="col-10">

  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#"><h1>Users Edit</h1></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor03" aria-controls="navbarColor03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>


  <div class="collapse navbar-collapse" id="navbarColor03">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="app.php"><h3>Home</h3><span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="app2.php" role="button" aria-haspopup="true" aria-expanded="false"><h3>users</h3></a>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter">+ Add a new person</a>
        </div>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search">
      <button class="btn btn-secondary my-2 my-sm-0 mr-sm-2" type="submit">Search</button>
    <a class="btn btn-primary" href="index.php">Logout</a>
    </form>
  </div>
</nav>

    <div class="col-12" id="A1">
      <div data-spy="scroll" data-target="#navbar-example3" data-offset="0" id="namelist" class="itemname">

      </div>
    </div>
</div>

  

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add a new person</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">



              Name: <br><input type="text" id="name"><br>
              <br><input id="image" type="file" accept="image/*" onchange="preview_image(event)">
               <br>password: <br><input type="text" id="password">
  


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" onclick="addName()">Add Preson</button>
      </div>
    </div>
  </div>
</div>



<div class="modal fade" id="C1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change an entry</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
               <input type="hidden" id="idUpdate"><br>
              Name: <br><input type="text" id="nameUpdate"><br>
              <br><input id="image" type="file" accept="images/*" onchange="preview_image(event)">
               <br>password: <br><input type="text" id="passwordup">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" onclick="changeName()">Change Preson</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="C2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Delete</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>if you remove this member,you cannot return!!</p>
  <input type="hidden" id="idDelete"><br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-primary" onclick="delName()">Delete</button>
      </div>
    </div>
  </div>
</div>


<script>

function list2(){

  
var xhttp4 = new XMLHttpRequest();
xhttp4.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
       var t = JSON.parse(xhttp4.responseText);
       var h = '';
       var x = 2;
       var name = [];
    //    for(var i=0; i<t.length; i++){
    //       name.push(t[i].name);
    // }
    //name = name.sort();
    for(var i=0; i<t.length; i++){
      //x = t[i].id+ 1;
          h += '<h4 id="item-'+t[i].id+'">ID:'+i+'</h4><p><div class="media"><img src="photos/'+t[i].photo+'" class="mr-3" id="pimg"><div class="media-body"><h5 class="mt-0">'+t[i].name+'</h5>comment</div><button type="button" class="btn btn-light text-dark" data-toggle="modal" data-target="#C1" onclick="ch('+t[i].id+',\''+t[i].name+'\',\''+t[i].password+'\')">Change</button><button type="button" class="btn btn-danger text-dark" data-toggle="modal" data-target="#C2" onclick="del('+t[i].id+')">Delete</button></div></p><hr id="White">';
    } 
    document.getElementById('namelist').innerHTML=h


    }
};
xhttp4.open("GET", "functions.php?f=list", true);
xhttp4.send();
}


 function addName(){
  if(document.getElementById('name').value!=''){


    var formData = new FormData();
    formData.append("fileToUpload",document.getElementById('image').files[0]);
    formData.append("name",document.getElementById('name').value);
    formData.append("password",document.getElementById('password').value);
    //console.log(formDate);



    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
         // Typical action to be performed when the document is ready:
         console.log('Added');
         document.getElementById('name').value='';
         document.getElementById('password').value='';
        list();
        list2();
    }
    };
      xhttp.open("POST", "functions.php?f=add", true); 
      xhttp.send(formData);
       $('#exampleModalCenter').modal('hide')

    } else {
      console.log('Add field is blank');
    }
}


function ch(id,name,password){
  document.getElementById('idUpdate').value = id;
  document.getElementById('nameUpdate').value = name;
  //document.getElementById('passwordup').value = password;
}
function del(id){
  document.getElementById('idDelete').value = id;
}


function changeName(){
  //if(document.getElementById('name').value!=''){
    var formData = new FormData();
    formData.append("fileToUpload",document.getElementById('image').files[0]);
    formData.append("name",document.getElementById('nameUpdate').value);
    formData.append("id",document.getElementById('idUpdate').value);
    formData.append("password",document.getElementById('passwordup').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           // Typical action to be performed when the document is ready:
           console.log('Changed: '+document.getElementById('idUpdate').value);
           document.getElementById('nameUpdate').value='';
           document.getElementById('idUpdate').value='';
           document.getElementById('passwordup').value='';
           list();
           list2();
      }
    };
      xhttp.open("POST", "functions.php?f=change", true); 
      xhttp.send(formData);
       $('#C1').modal('hide')

}

function delName(){
  //if(document.getElementById('name').value!=''){
    var formData = new FormData();
    formData.append("id",document.getElementById('idDelete').value);

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
           console.log('Deleted: '+document.getElementById('idDelete').value);
           document.getElementById('idDelete').value='';
           list();
           list2();

      }
    };
      xhttp.open("POST", "functions.php?f=remove", true); 
      xhttp.send(formData);
 $('#C2').modal('hide')
}
list2();
</script>

</div>

<?php include('footer.php'); ?>