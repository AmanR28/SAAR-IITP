<?php
    session_start();
    if(isset($_POST['rollno'])){
        $_SESSION['cid'] = $_POST['rollno'];
    }
    if(isset($_SESSION['cid'])){
	$url = 'https://saar-server.000webhostapp.com/functions/resendOTP.php';
      $ch = curl_init($url);
      $data = array(
       'rollno' => $_SESSION['cid']
      );
       $payload = http_build_query($data);
	 curl_setopt($ch, CURLOPT_POST, true);
	 curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
	 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	 $result = curl_exec($ch);
	 curl_close($ch);
      echo $result;
      $response = json_decode($result,true);
      if($response['status'] == 401 || $response['status'] == 201){
      	$_SESSION['msg'] = $response['messages'][0];
      header("location: enterotp.php");
      }
      
      }else{
        header("location:enterroll.php");
      }

?>