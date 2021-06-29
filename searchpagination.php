<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- CSS only -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
<!-- Icon -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!--Cdn for Jquery Validation-->
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.js"></script>

<title>Register Here</title>
</head>
<body>

  

<div class="container">
<form method="POST" id="form" action="">
 <div class="form-group">
    <div class="input-group">
 <div style="margin-bottom:30px;"><input type="text" class="form-control" id="search_param" placeholder="Search"/></div>
    </div>
   </div>
<h1 style="text-align:center">ADD USER</h1>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
  Add applicant
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="registrationsucessfull"></div><br>
<lable for="name">Name:<input type="text" class="form-control" name="name" required>
<lable for="name">Phone no:<input type="text" class="form-control" name="phonenumber" required><br>
<lable for="name">E-mail:<input type="text" class="form-control" name="email" required><br>
<input type="submit" id="save" class="btn btn-primary">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>
</div>
</form>
</div>
<div class="container" style="margin-top:20px">
<table class="table table-hover table-bordered">
<thead>
 <tr>
      <th scope="col">ID</th>
      <th scope="col">NAME</th>
      <th scope="col">PHONE NUMBER</th>
      <th scope="col">E-MAIL</th>
    </tr>
<thead>
<tbody id="viewtable" table class="table table-striped table-dark">
<tbody>
</table>
<nav aria-label="Page navigation example">
<ul class="pagination">



</ul>
</nav>
</div>
<div ></div>
<table class="table table-hover">
                 <tbody id="tbl_body">
                       
                        </tbody>
                    </table>
<script>
$(document).ready(function()
{//This is where the form Is Inserted
$('#form').on('submit',function(e)
{
var formdata = new FormData(this);
e.preventDefault();
$.ajax({
url:'logicpagination.php',
data:formdata,
method:'POST',
processData:false,
contentType:false,
success:function(data)
{
$('#registrationsucessfull').html(data);
view();
}
});
});
//This is where the Data is shown

view();
});

function view(page1='')
{
$.ajax({
url:'showdatas.php',
data: {pageno:page1},
method:'POST',
dataType:'json',
success:function(data)
{

var table ='';
$.each(data.data,function(key,value)
{
table +=`<tr><td>${value.id}
</td><td>${value.name}
</td><td>${value.phno}
</td>
<td>${value.email}
</td>
<tr>`;
});
$('#viewtable').html(table);
var pagi = '';
for(var i=1; i<=data.pagecount;i++){
pagi += `<li class="page-item" onclick="view(${i})"><a class="page-link"  href="#">${i}</a></li>`;
}

$('.pagination').html(pagi);
}
});
$(document).on("keyup", "#search_param", function (load_data) {
                var search_param = $("#search_param").val();
                $.ajax({
                    url: 'fetch.php',
                    type: 'POST',
                    data: {search_param: search_param},
                     dataType: "json",
                    success: function (data) {
                      
if(data.status == "success" ){
                  var tabl ='';
$.each(data['data'],function(key,val)
{
tabl +=`<tr><td>${val.id}
</td><td>${val.name}
</td><td>${val.phone}
</td>
<td>${val.email}
</td>
<tr>`;
});

                      $("#tbl_body").html(tabl);
                      
                    }
                  }

                });
            });
 
}


</script>
</body>
</html>