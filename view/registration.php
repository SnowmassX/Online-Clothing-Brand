<!DOCTYPE html>
<html>

<head>
    <title>Register</title>

    <link rel="stylesheet" href="../asset/css/registration.css">
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

        <div class="form-container" id="formContainer">

            <h2 id="title">
                Registration
            </h2>

            <form
                method="POST"
                action="../controller/registrationCheck.php"
                id="registrationForm"
                enctype="multipart/form-data">

                <input 
                    type="hidden" 
                    name="id"
                    id="id" 
                    value="">
                <input
                    type="text"
                    name="name"
                    id="name"
                    placeholder="Enter Name">

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

                <textarea
                    name="address"
                    id="address"
                    placeholder="Enter Address"></textarea>

                <input
                    type="text"
                    name="phone"
                    id="phone"
                    placeholder="Enter Phone">

                <select
                    name="role"
                    id="role">

                    <option value="">
                        Select Role
                    </option>

                    <option value="admin">
                        Admin
                    </option>

                    <option value="customer">
                        Customer
                    </option>

                </select>
                <input 
                    type="file"
                    name="image"
                    id="image"
                    alt="image">
                <input
                    type="submit"
                    name="submit"
                    id="submit"
                    value="Register"
                    onclick="validateForm()">

            </form>

        </div>

    </main>

    <footer id="footer">

        <p id="footerText">
            © 2026 Fashion Store. All Rights Reserved.
        </p>

    </footer>
    <script src="../asset/script/registration.js"></script>
</body>

</html>