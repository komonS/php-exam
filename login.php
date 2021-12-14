<?php
session_start();
require_once("conn.php");
$db = new DB();
if(isset($_POST['loginSumit'])){
  if($_POST['username'] == ''){
    echo "<script type='text/javascript'>
        alert('please enter username');
        document.location='index.php';
      </script>";
  }else if($_POST['password'] == ''){
    echo "<script type='text/javascript'>
        alert('please enter password');
        document.location='index.php';
      </script>";
  }else{
    //$u = $_POST['username'];
    //$p = $_POST['password'];
    $u = addslashes($_POST['username']);
    $p = addslashes($_POST['password']);
    $txtSQL = "SELECT * FROM user WHERE username = '$u' AND password = '$p'";
    $db->Query($txtSQL);
    while($row=$db->Read()){
      $userID = $row['id'];
      $name = $row['name'];
    }
    if($userID != ''){
      $_SESSION['userID'] = $userID;
      echo "<script type='text/javascript'>
          alert('wellcome $name $apStat');
          document.location='index.php';
        </script>";
      
      
    }else{
      echo "<script type='text/javascript'>
          alert('user or password are not valid');
          document.location='index.php';
        </script>";
        exit();
    }

  }
}
?>
<!-- Modal -->
<div id="modalLogin" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Login</h4>
      </div>
      <div class="modal-body">
        <form action="login.php" method="POST" role="form">
          <div class="form-group">
            <label for="">Username : </label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
          </div>
          <div class="form-group">
            <label for="">Password : </label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
          </div>
          <div class="form-group">
            <button type="submit" name="loginSumit" class="btn btn-primary">Login</button>
          </div>        
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>