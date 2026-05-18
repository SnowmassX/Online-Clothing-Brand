<?php
session_start();

if(!isset($_SESSION['id'])){
    header("location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profile</title>
    <link rel="stylesheet" href="../asset/css/profile.css">
</head>
<body>

<div class="container">

    <h2>Profile Page</h2>

    <div id="message"></div>

    <div class="profile-card">

        <div class="image-section">
            <img id="preview" src="../asset/upload/user/placeholder.png" alt="Profile">
            <input type="file" id="profile_picture" accept="image/*">
        </div>

        <div class="form-section">
            <input type="text"  id="name"    placeholder="Name">
            <input type="email" id="email"   placeholder="Email">
            <input type="text"  id="phone"   placeholder="Phone">
            <textarea           id="address" placeholder="Address"></textarea>
            <button onclick="updateProfile()">Update Profile</button>
        </div>

    </div>

    <hr>

    <h3>Change Password</h3>

    <div class="password-section">
        <input type="password" id="current_password" placeholder="Current Password">
        <input type="password" id="new_password"     placeholder="New Password">
        <input type="password" id="confirm_password" placeholder="Confirm Password">
        <button onclick="changePassword()">Change Password</button>
    </div>

</div>

<script src="../asset/script/profile.js"></script>
</body>
</html>