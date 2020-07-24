<!DOCTYPE html>
<html>
<head>
	<title>MENU</title>
	<link rel="stylesheet" href="css/style.css">
  <style type="text/css">
    #txt{
      color: white;
    }
    body{
      padding: 20px;
    }
  </style>
</head>
<body>

<script type="text/javascript">

function startTime() {
  var today = new Date();
  var h = today.getHours();
  var m = today.getMinutes();
  var s = today.getSeconds();
  m = checkTime(m);
  s = checkTime(s);
  document.getElementById('txt').innerHTML =
  h + ":" + m + ":" + s;
  var t = setTimeout(startTime, 500);
}
function checkTime(i) {
  if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
  return i;
}
</script>
</head>

<body onload="startTime()">

<div id="txt"></div>
<div id= "header">
  <br>
  <?php //require_once 'php/menu.php'; ?>
</body>
</link>
</html>