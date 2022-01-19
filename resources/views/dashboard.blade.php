<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Dashboard</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="{{ url('assets/css/dashboard.css') }}" rel="stylesheet">	

	<style>
 /* The sidebar menu */
.sidebar {
  height: 100%; /* 100% Full-height */
  width: 0; /* 0 width - change this with JavaScript */
  position: fixed; /* Stay in place */
  z-index: 1; /* Stay on top */
  top: 0;
  left: 0;
  background-color: #111; /* Black*/
  overflow-x: hidden; /* Disable horizontal scroll */
  padding-top: 60px; /* Place content 60px from the top */
  transition: 0.5s; /* 0.5 second transition effect to slide in the sidebar */
}

/* The sidebar links */
.sidebar a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  /*font-size: 25px;*/
  font-size: 12px;  
  /*color: #818181;*/
  color: white;
  display: block;
  transition: 0.3s;
}

/* When you mouse over the navigation links, change their color */
.sidebar a:hover {
  /*color: #f1f1f1;*/
  color: #000;
}

/* Position and style the close button (top right corner) */
.sidebar .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  /*font-size: 36px;*/
  font-size: 12px;
  margin-left: 50px;
}

/* The button used to open the sidebar */
.openbtn {
  font-size: 20px;
  cursor: pointer;
  background-color: #111;
  color: white;
  padding: 10px 15px;
  border: none;
}

.openbtn:hover {
  background-color: #444;
}

/* Style page content - use this if you want to push the page content to the right when you open the side navigation */
#main {
  transition: margin-left .5s; /* If you want a transition effect */
  padding: 20px;
}

/* On smaller screens, where height is less than 450px, change the style of the sidenav (less padding and a smaller font size) */
/*@media screen and (max-height: 450px) {
  .sidebar {padding-top: 15px;}
  .sidebar a {font-size: 18px;}
} 	
*/
	</style>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
			<li><a href="#">{{ $user_name }}</a></li>
            <li><a href="{{ url('/logout') }}">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>

    <div class="container-fluid">
		<center class="jumbotron"><?php echo $userdetail ?></center>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- include libraries(jQuery, bootstrap) -->
    <script src="{{ url('assets/js/jquery-3.3.1.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap.min.js') }}"></script>

    <!-- include summernote css/js -->
    <link href="{{ url('assets/css/summernote.css') }}" rel="stylesheet">
    <script src="{{ url('assets/js/summernote.js') }}"></script>    
  </body>
</html>

<script>
$(document).ready(function() {
  $('#textbox').summernote({
    height: 300
  });
});
</script>

<script>
function saveHtml(){
  var w = '<?php //echo $iWorkspaceid ?>';
  var a = $("#tTableid").text();
  var b = $("#tRowid").text();
  var c = $("#tColumnid").text();
  var columnhtml = $('#textbox').summernote('code');
  $.ajax({
    url: "{{ url('/saveColumnHtmlData') }}",
    type: 'post',
    data: {
	  workspaceid: w,
      tableid: a,
      rowid: b,
      columnid: c,
      columnhtml: columnhtml,
      context: 'savehtml',
	  _token: '{{ csrf_token() }}'

    },
    success: function(res){

    }
  });
}
</script>

<script>
function getHtml(a,b,c){
  $("#tTableid").text(a);
  $("#tRowid").text(b);
  $("#tColumnid").text(c);  
  $.ajax({
    url: "{{ url('/getColumnHtmlData') }}",
    type: 'post',
    data: {
      tableid: a,
      rowid: b,
      columnid: c,
      context: 'html',
	  _token: '{{ csrf_token() }}'

    },
    success: function(res){
      $('#textbox').summernote('code', res);
    }
  });
}
</script>

<!-- Trigger the modal with a button -->
<button id="createTableButton" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#createTableModal" style="display:none;">Open Modal</button>

<!-- Modal -->
<div id="createTableModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Row Detail</h4>
      </div>
      <div class="modal-body">
        <table style="border-collapse:collapse;">
          <tbody>
            <tr>
              <td style="width:60px;">Columns</td>
              <td><input id="colCount" type="text" style="border:1px solid #ccc; height: 20px; width: 100px;"><button onClick="createTableRequest();">Add</button></td>
            </tr>
            <tr>
              <td colspan="2"><div id="structHtml"></div></td>
            </tr>            
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$("#updateProfile").click(function(){
	window.location.href = '{{ url("/updateprofile") }}';
});
$("#updatePassword").click(function(){
	window.location.href = '{{ url("/updatepassword") }}';
});
</script>

<script>
  function createTableRequest(){
	var count = $("#colCount").val();	
	if(count > 0 && count <= 5){
		$.ajax({
		  url: "{{ url('/createTableRequest') }}",
		  type: 'post',
		  data: {
			table: count,
			context: 'createtable',
			_token: '{{ csrf_token() }}'
		  },
		  success: function(res){
			var createTable = JSON.parse(res);
			if(createTable.status == "true"){
				alert("Table created.");
				location.reload();
			} else {

			}
		  }
		});
	} else {
		alert('Please insert column value between 1 and 5');
	}
  }
</script>