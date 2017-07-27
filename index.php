<html lang = "en">
   <head>
      <title>Project</title>
      <link href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel = "stylesheet">
      <style>
         body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #FDF3E7;
         }

         .form-signin {
            max-width: 330px;
            padding: 15px;
            margin: 0 auto;
            color: #017572;
         }

         .form-signin .form-signin-heading,
         .form-signin .checkbox {
            margin-bottom: 10px;
         }

         .form-signin .checkbox {
            font-weight: normal;
         }

         .form-signin .form-control {
            position: relative;
            height: auto;
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            padding: 10px;
            font-size: 16px;
         }

         .form-signin .form-control:focus {
            z-index: 2;
         }



         h2{
            text-align: center;
            color: #017572;
         }
      </style>

   </head>

   <body>

      <h2>Enter your Basic Data</h2>
      <div class = "container form-signin">
         <?php

						 $GLOBALS['api_token']       = '2E761195BA601368D9EBD9A2F128224F';
						 $GLOBALS['api_url']         = 'https://redcapdemo.vanderbilt.edu/api/';

            $msg = '';
            if (isset($_POST['import']) && !empty($_POST['name'])
               && !empty($_POST['gender'])&& !empty($_POST['country'])&& !empty($_POST['phone_number'])) {

							 $record = array(
							 	'study_id' => substr(sha1(microtime()), 0, 16),
							 	'name' => $_POST['name'],
							 	'gender' => $_POST['gender'],
							 	'country' => $_POST['country'],
								'phone_number' => $_POST['phone_number'],
							   'basic_data_complete' => '2'
							 	);

							 $data = json_encode( array( $record ) );

							 $fields = array(
							 	'token'   => $GLOBALS['api_token'],
							 	'content' => 'record',
							 	'format'  => 'json',
							 	'type'    => 'flat',
							 	'data'    => $data,
							 );

							 $ch = curl_init();

							 curl_setopt($ch, CURLOPT_URL, $GLOBALS['api_url']);
							 curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields, '', '&'));
							 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
							 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); // Set to TRUE for production use
							 curl_setopt($ch, CURLOPT_VERBOSE, 0);
							 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
							 curl_setopt($ch, CURLOPT_AUTOREFERER, true);
							 curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
							 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
							 curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);
							 $output = curl_exec($ch);
							 $obj=json_decode($output,true);
							 if ($obj['count'] == 1){
								 $msg =" Records imported successfully";
							 }
							 else{
								 $msg = "not imported";
							 }
							 curl_close($ch);

            }

						?>
      </div> <!-- /container -->

      <div class = "container">

         <form class = "form-signin" role = "form"
            action = "" method = "post">
            <h4 class = "form-signin-heading"><?php echo $msg; ?></h4>
            <input type = "text" class = "form-control"
               name = "name" placeholder = "Full Name"
               required autofocus></br>
						<label class="radio-inline">
					 <input type = "radio" class = "form-control"
	                name = "gender" value='male'required>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  Male
						</label><label class="radio-inline">
						<input type = "radio" class = "form-control"
				          name = "gender" value='female'required> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female</br>
						</label></br></br>
						<input type = "text" class = "form-control"
			               name = "country" placeholder = "Country"
			               required ></br>
						<input type = "text" class = "form-control"
				                name = "phone_number" placeholder = "Phone Number"
				                required ></br>

            <button class = "btn btn-lg btn-primary btn-block" type = "submit"
               name = "import">Import</button>
						</form>
						<div class = "form-signin" role = "form">
						<button class = "btn btn-lg btn-primary btn-block" type = "submit"
	                name = "export" onClick="window.open('/project/export_records.php')">Export</button>
						</div>
      </div>

   </body>
</html>
