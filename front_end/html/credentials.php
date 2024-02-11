<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Include Bootstrap 5.3 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div id="app">
<header class="text-blac p-3" style="background-color: rgba(247, 251, 251);">
    <div class="container">
        <div class="row">
            <div class="col d-flex justify-content-end p-3">
                <h2 class="mr-3">Flavour Coffee</h2>
                <div v-if="auth" class="col text-end">
                    <h1>{{ auth.fname }} {{ auth.lname }}</h1>
                </div>
                <div v-if="!RL" class="col-auto">
                    <!-- Bootstrap 5.3 Dropdown Button -->
                    <div class="btn-group">
                        <button type="button" class="btn btn-link text-black dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" @click="logout">Logout</a>
                            <a class="dropdown-item" href="change_cred.php">Account Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <a v-if="auth?.role == 'guest'" href="dashboard.php" class="btn btn-primary">Back</a>
            <a v-if="auth?.role == 'admin'" href="admin.php" class="btn btn-primary">Back</a>

            <br><br>

            <div v-if="auth" class="mt-3">
                <p>Email: {{auth.username}}</p>
                <p>First Name: {{ auth.fname }}</p>
                <p>Last Name: {{ auth.lname }}</p>
            </div>


            <div class="mt-3">
            <button @click="toggleForm" class="btn btn-primary">Toggle Form</button>
        </div>

            <div class="box_form mt-3">

                <div v-if="selectedform ==='userform'">
                <label for="username">User Name</label>
                <br>
                <input type="email" v-model="account_id" class="form-control">
                <br>
                <button type="button" @click="changeAccId" class="btn btn-primary">Save Changes</button>
                <br><br>
                </div>

                <div v-if="selectedform ==='nameform'">
                <label for="fname">First Name:</label>
                <br>
                <input type="text" v-model="first_name" class="form-control">
                <br>
                <label for="lname">Last Name:</label>
                <br>
                <input type="text" v-model="last_name" class="form-control">
                <br>
                <button type="button" @click="changeName" class="btn btn-primary">Save Changes</button>
                <br><br>
                </div>


                <div v-if="selectedform ==='passform'">
                <label for="Cpassword">Current Password:</label>
                <br>
                <input type="password" v-model="Cpassword" class="form-control">
                <br>
                <label for="password">New Password:</label>
                <br>
                <input type="password" v-model="password" class="form-control">
                <br>
                <button type="button" @click="changePass" class="btn btn-primary">Save Changes</button>
                <br><br>

                </div>
            </div>

        </div>
    </div>
</div>

<footer class="text-center text-white p-3" style="background-color: #343a40;">
    <p>&copy; 2023 Flavour Coffee</p>
    <a href="https://web.facebook.com/flavour.coffeestation">Contact Us</a> 
</footer>

<?php 
include_once('include/links.php');
?>

</div>

<!-- Include Bootstrap 5.3 JS and Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>
</html>
s