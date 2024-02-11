<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <style>
        body {
            background-image: url('https://scontent-mnl1-2.xx.fbcdn.net/v/t39.30808-6/378511219_278353035187794_579260741048849670_n.png?_nc_cat=108&ccb=1-7&_nc_sid=783fdb&_nc_eui2=AeGnfgO4FC7aQhyWn657eMlqyKGum-Kz6I3Ioa6b4rPojffMwuMrUeL3ER5JzHc3OP2upvxq9tfZSQhawJ2QyIPG&_nc_ohc=NcXZSVpfJWoAX8DdxsZ&_nc_zt=23&_nc_ht=scontent-mnl1-2.xx&cb_e2o_trans=t&oh=00_AfCj4EaiJ4Eq_gyHafwjmIAXLQj-zHXq6tjW2y2-jaOM4g&oe=658EDDC2');
            background-size: cover;
            background-attachment: fixed;
        }

        .container {
            background-color: rgba(255, 255, 255, 0);
            padding: 40px; /* Increase padding for a larger form */
            border-radius: 10px;
            margin-top: 50px;
        }
        .form{
            height:45rem;
            width: 30rem;
        }
    </style>
</head>
<body>

<div id="app" class="container mt-5">
<div id="loading-spinner" class="position-fixed top-50 start-50 translate-middle" style="z-index: 12; display: none;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    </div>
    <div class="form card p-2">
        <h3 class="mb-3">REGISTER</h3>

        <div class="form-group">
            <label>Email:</label>
            <input type="email" v-model="username" class="form-control form-control-sm required" >
        </div>

        <div class="form-group">
            <label>First Name:</label>
            <input type="text" v-model="fname" class="form-control form-control-sm">
        </div>

        <div class="form-group">
            <label>Last Name:</label>
            <input type="text" v-model="lname" class="form-control form-control-sm">
        </div>

        <div class="form-group">
            <label>Password:</label>
            <input type="password" v-model="password" class="form-control form-control-sm">
        </div>

        <div class="form-group">
            <label>Confirm Password:</label>
            <input type="password" v-model="Cpassword" class="form-control form-control-sm">
        </div>

        <div class="form-group">
            <label>Security Question:</label>
            <select v-model="securityQuestion" class="form-control form-control-sm">
                <option v-for="option in securityQuestionOptions" :value="option.value">{{ option.text }}</option>
            </select>
        </div>

        <div class="form-group">
            <label>Answer to Security Question:</label>
            <input type="text" v-model="securityAnswer" class="form-control form-control-sm">
        </div>

        <button type="button" @click="save" class="btn btn-primary btn-sm">Register</button>
        <a href="login.php" class="btn btn-primary mt-1">Back to Login</a>
    </div>
</div>
<footer class="text-center text-white p-3" style="background-color: #343a40;">
    <p>&copy; 2023 Flavour Coffee</p>
    <a href="https://web.facebook.com/flavour.coffeestation">Contact Us</a> 
</footer>

<?php 
include_once('include/links.php');
?>
</body>
</html>
