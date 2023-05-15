<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Freelancing Training</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- Option 1: Include in HTML -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body>
<?php
// $version = phpversion();
// print $version; // need >8.0.0
require 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

// Updated file
$spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load('app.xls');
$cells = $spreadsheet->getActiveSheet()->toArray(null,true,true,true);
// var_dump($cells);
?>
<div class="container-fluid pt-4">
  <?php
  echo "<h4 class='text-center'>ফ্রিল্যান্সিং ট্রেনিং - মেহেরপুর সদর</h4>";
  echo "<h6>কম্পিউটার/ল্যাপটপ আছে কেমন প্রশিক্ষণার্থীর তালিকা</h6>";
  echo '<div class="table-responsive"><table class="table table-hover table-bordered">';
  foreach ($cells as $key => $cell) {
    if($key !==1){ // regular data block <td>
      $class = ($cell['F']=="Confirmed")?"text-success":"text-danger";
      if($cell['D']=="না") continue;
      echo '
      <tr>
        <td scope="col">'.$key. '. '. $cell['A'] .'</td>
        <td scope="col">
        <a id="ok'. $key .'" href="tel:'. $cell['B'] .'">'. $cell['B'] .'</a>
        <button class="btn btn-outline-primary copyClick copyClick'.$cell['B'].' btn-sm btnClipboard"  data-clipboard-target="#ok'. $key .'" data-userid="'. $cell['B'] .'">
        <i class="bi bi-clipboard"></i>
        </button>
        <button class="btn btn-outline-success btn-sm mx-1 my-1" onclick="confirmed('.$key.')">Confirmed</button>
        <button class="btn btn-outline-danger btn-sm" onclick="notReceived('.$key.')">Not Received</button>
        
        </td>
        <td scope="col"><b class="status'.$key.' '.$class.' ">'. $cell['F'] .'</b></td>
      </tr>
      ';

    } else { // heading block <th>
      echo '
      <tr>
        <th scope="col">'.$key. '. '. $cell['A'] .'</th>
        <th scope="col">'. $cell['B'] .'</th>
        <th scope="col">Status</th>
      </tr>
      ';
    }
  }
  echo"</tbody></table></div>"; 

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.11/dist/clipboard.min.js"></script>
<script>
  new ClipboardJS(".btnClipboard");

  function confirmed(userId) {
    var url = "process.php?confirmedId=F" + userId;
    $.get( url, function( data ) {
      $( ".status" + userId ).text( 'Confirmed' );
      $( ".status" + userId ).removeClass("text-danger").addClass("text-success");
    });
  }  

  function notReceived(userId) {
    var url = "process.php?notReceivedId=F" + userId;
    $.get( url, function( data ) {
      $( ".status" + userId ).text( 'Not Received' ).addClass("text-danger");
    });
  }

  $(".copyClick").click(function(){
    var text = $(this).data('userid');
    let className = ".copyClick" + text;
    $(className).replaceWith('<button class="btn btn-outline-primary btn-sm '+ className +'"><i class="bi bi-clipboard-check"></i></button>');
  });

</script>
</body>
</html>





