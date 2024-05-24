<!DOCTYPE html>
<html>
<head>
	<title> SignUp </title>
	 
</head>
<body>
	<div class="header">
		<h1> SignUp </h1>
		<p>Create a new Profile</p>
		
	</div> 


	<?php
	    if(@$_GET['Empty']==true){
	 ?>
	    <div class="alert-light text-danger"><?php echo $_GET['Empty']?></div>
	<?php
	    }
	?>
	<?php
	    if(@$_GET['UsernameExists']==true){
	 ?>
	    <div class="alert-light text-danger"><?php echo $_GET['UsernameExists']?></div>
	<?php
	    }
	?>
	
	<form action="AccountCreate.php" method="POST">
		<div class="formGroup">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="formGroup">
                <label for="email">Email</label>
                <input type="text" id="email" name="email" required>
            </div>
            <div class="formGroup">
                <label for="passportNo">Passport no</label>
                <input type="text" id="passportNo" name="passportNo" required>
            </div>
        
            <div class="formGroup">
                <label for="mobileNo">Mobile no</label>
                <input type="int" id="mobileNo" name="mobileNo" required>
            </div>
            <div class="formGroup">
                <label for="gender">Gender</label>
                <input type="char" id="gender" name="gender" required>
            </div>
            <div class="formGroup">
                <label for="age">Age</label>
                <input type="int" id="age" name="age" required>
            </div>
            
            <div class="formGroup">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" required>
            </div>
            <div class="formGroup">
                <label for="nationality">Nationality</label>
                <input type="text" id="nationality" name="nationality" required>
            </div>
            <div class="formGroup">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="submitBtn">Register</button>
	</form>

</body>
</html>