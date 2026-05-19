<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <link rel="stylesheet" href="../asset/css/login.css">
</head>

<body>
    <header id="header">

        <div class="logo" id="logo">
            Online Clothing Brand
        </div>

        <nav id="navbar">
            <a href="home.php" id="homeLink">Home</a>
            <a href="login.php" id="loginLink">Login</a>
            <a href="registration.php" id="registerLink">Register</a>
            <a href="../controller/logout.php" id="logoutLink">Logout</a>
        </nav>

    </header>
    <h2 id="error">

    </h2>
    <main id="main">
        <div id="formContainer">
            <h2 id="title">Login</h2>

            <form action="../controller/loginCheck.php" method="post" id="registrationForm" onsubmit="return validateLogin()">
                <input
                    type="email"
                    name="email"
                    id="email"
                    placeholder="Enter Email">

                <input
                    type="password"
                    name="password"
                    id="password"
                    placeholder="Enter Password">

                <div class="remember-group">
                    <input type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <input
                    type="submit"
                    name="submit"
                    id="submit"
                    value="Login"
                    onclick="validateForm()">

                <p id="error" style="color: red; text-align: center; font-size: 14px; margin-top: 10px;"></p>
            </form>
        </div>
    </main>
    <footer id="footer">

        <p id="footerText">
            © 2026 Fashion Store. All Rights Reserved.
        </p>

    </footer>
    <script src="../asset/script/login.js"></script>
</body>

</html>