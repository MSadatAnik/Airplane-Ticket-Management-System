<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <div>
        <h1>Login</h1>
    </div>
    <div>
        <form action="LoginProcess.php" method="post">
            <input type="text" name="email" placeholder="Email" required>
            <br>
            <input type="password" name="password" placeholder="Password" required>
            <br>
            <button class="Btn" type="submit" name="login">Login</button>
        </form>
        <br>
        <form action="SignUp.php" method="get">
            <button class="Btn" type="submit" name="signup">Sign Up</button>
        </form>
    </div>
</body>
</html>