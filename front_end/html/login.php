
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <style>
        body {
            background-image: url('https://scontent-mnl1-2.xx.fbcdn.net/v/t39.30808-6/378511219_278353035187794_579260741048849670_n.png?_nc_cat=108&ccb=1-7&_nc_sid=783fdb&_nc_eui2=AeGnfgO4FC7aQhyWn657eMlqyKGum-Kz6I3Ioa6b4rPojffMwuMrUeL3ER5JzHc3OP2upvxq9tfZSQhawJ2QyIPG&_nc_ohc=NcXZSVpfJWoAX8DdxsZ&_nc_zt=23&_nc_ht=scontent-mnl1-2.xx&cb_e2o_trans=t&oh=00_AfCj4EaiJ4Eq_gyHafwjmIAXLQj-zHXq6tjW2y2-jaOM4g&oe=658EDDC2');
            background-size: cover;
            background-repeat: no-repeat; 
            background-position: center center;
            background-attachment: fixed;
            background-color: #f8f9fa; 
        }

      

        /* Add additional styling for other elements as needed */
        .container {
            margin-top: 50px;
           
        }
        .input{
            
            height: 27rem;
            width: 20rem;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            background-color: #F4F4F8 ;
            box-shadow: 7px 4px 155px -24px rgba(217,204,204,0.75);
        }
    </style>

</head>
<body>
        <div id="app">

        <div id="loading-spinner" class="position-fixed top-50 start-50 translate-middle" style="z-index: 12; display: none;">
    <div class="spinner-border text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
</div>

<div class="text-center">
  <h1 class="mt-3">Login</h1>
</div>
        <div class="input mb-3">
    <form class="d-flex flex-column align-items-center">
        <div class="mb-3 form-group"> <!-- Apply the form-group class to the form groups -->
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" v-model="username">
        </div>

        <div class="mb-3 form-group">
            <label for="password" class="form-label">Password:</label>
            <input type="password" class="form-control" id="password" v-model="password">
        </div>

        <button type="button" class="btn btn-primary mt-3" @click="logIn">Login</button>

        <a href="forgotpass.php" class="btn btn-outline-info mt-3">Forgot Password</a>
        <p class="mt-5">Not a User?</p>
        <a href="register.php" class="btn btn-outline-success mt-1">Register</a>
    </form>

  
 
    <?php include_once('include/links.php'); ?>
</div>
</div>
</div>
<footer class="text-center text-white p-3" style="background-color: #343a40;">
    <p>&copy; 2023 Flavour Coffee</p>
    <a href="https://web.facebook.com/flavour.coffeestation">Contact Us</a> 
</footer>
</body>
</html>
