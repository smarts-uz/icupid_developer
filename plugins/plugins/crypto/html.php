<!DOCTYPE html>
<html>
<head>
	<title>Detail page</title>
	 <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css">
	 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
</head>
<body>
<?php
error_reporting(0);
if (isset($_GET["data"])) {
 $addata =  $_GET["data"];
 $amt =  $_GET["eth"];
}

header("Access-Control-Allow-Origin: *");


?>



<div class="col-sm-6 col-sm-offset-3" style="margin-top: 4%;">
<form action="" method="post">

      <div id="name-group" class="form-group" >

	    <label for="from">Amount</label>
        <input type="text" class="form-control"  value="<?=$amt?>" readonly >

       </div>

	 <div id="name-group" class="form-group">

	    <label for="from">From</label>
        <input type="text" class="form-control"  value="<?=$addata?>" readonly >

       </div>

       <div id="name-group" class="form-group">

	    <label for="from">TO</label>
        <input type="text" class="form-control"  value="0x6b4270591996129a4c3Ffb237e7287dA0E2d854f" readonly >

       </div>


      



  


</form>
  <button  class="btn btn-success" id="submit" onclick="UserAction();" >Send <span class="fa fa-arrow-right"></span></button>

   <script type="text/javascript">
       function UserAction() {



// console.log(xmlhttp.status);
// console.log(xmlhttp.statusText);

var xmlhttp = new XMLHttpRequest(),
  method = 'POST',
  url = 'http://vpeeps.com:3000/titletransfers/create';

xmlhttp.open(method, url, true);


if(xmlhttp.status=="200"){
window.location.href = "thankyou.php";
}else if(xmlhttp.status == "0"){
window.location.href = "failed.php";

}

xmlhttp.onerror = function () {
  console.log("** An error occurred during the transaction");
  window.location.href = "failed.php";
};

xmlhttp.send();



 }




    </script>


</div>

</body>
</html>