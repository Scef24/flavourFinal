<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-image: url('https://scontent-mnl1-2.xx.fbcdn.net/v/t39.30808-6/378511219_278353035187794_579260741048849670_n.png?_nc_cat=108&ccb=1-7&_nc_sid=783fdb&_nc_eui2=AeGnfgO4FC7aQhyWn657eMlqyKGum-Kz6I3Ioa6b4rPojffMwuMrUeL3ER5JzHc3OP2upvxq9tfZSQhawJ2QyIPG&_nc_ohc=NcXZSVpfJWoAX8DdxsZ&_nc_zt=23&_nc_ht=scontent-mnl1-2.xx&cb_e2o_trans=t&oh=00_AfCj4EaiJ4Eq_gyHafwjmIAXLQj-zHXq6tjW2y2-jaOM4g&oe=658EDDC2');
            background-size: cover;
            background-attachment: fixed;
        }

        .container {
            background-color: rgba(255, 255, 255, 0.8);
            padding: 40px; /* Increase padding for a larger form */
            border-radius: 10px;
            margin-top: 50px;
        }
    </style>
</head>
<body class="container mt-5">

<div id="app" class="card p-3">
    <h2 class="mb-4">Password Reset</h2>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" v-model="username" class="form-control" required>
    </div>

    <!-- Display the security question based on the server response -->
    <div class="form-group">
        <label for="securityQuestion">Security Question:</label>
        <select v-model="securityQuestion" class="form-control">
            <option v-for="option in securityQuestionOptions" :key="option.value" :value="option.value">
                {{ option.text }}
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="securityAnswer">Answer to Security Question:</label>
        <input type="text" v-model="securityAnswer" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="newPassword">New Password:</label>
        <input type="password" v-model="newPassword" class="form-control" required>
    </div>

    <div class="form-group">
        <label for="confirmNewPassword">Confirm New Password:</label>
        <input type="password" v-model="confirmNewPassword" class="form-control" required>
    </div>

    <button @click="resetPassword" :disabled="loading" class="btn btn-primary">Reset Password</button>
    <span v-if="loading" class="ml-2">Resetting...</span>
    <span v-if="success" class="ml-2 text-success">Password reset successfully!</span>
    <span v-if="error" class="ml-2 text-danger">{{ errorMessage }}</span>
</div>

<a href="login.php" class="btn btn-primary">Back to Login</a>

<footer class="text-center text-white p-3" style="background-color: #343a40;">
    <p>&copy; 2023 Flavour Coffee</p>
    <a href="https://web.facebook.com/flavour.coffeestation">Contact Us</a> 
</footer>

<!-- Include Bootstrap JS and Popper.js -->
<?php 
include_once('include/links.php');
?>
</body>
</html>
