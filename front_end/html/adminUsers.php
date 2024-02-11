<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div id="app">
    <header class="text-white p-3" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="container">
            <div class="row">
                <div class="col d-flex justify-content-end p-3">
                    <div v-if="!RL">  
                        <a href="#" @click="logout" class="btn btn-link text-white mx-3 text-decoration-none">Logout</a>
                    </div> 
                    <div>  
                        <a href="adminUsers.php"  class="btn btn-link text-white mx-3 text-decoration-none">Admin List</a>
                    </div> 
                </div>
                <div v-if="auth" class="col text-end">
                    <h1>{{ auth.fname }} {{ auth.lname }}</h1>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-3">
        <button type="button" class="btn btn-primary" @click="change">
            Change Credentials
        </button>

        <div v-if="auth" class="mt-3">
            <p>Account ID: {{ auth.username }}</p>
            <p>First Name: {{ auth.fname }}</p>
            <p>Last Name:  {{ auth.lname }}</p>
            <p>Password: XXXXX</p>
        </div>

        <div class="mt-3">
            <label for="search_name">Enter Guest:</label>
            <input type="text" v-model="search" class="form-control">
            <button @click="searchUsers" class="btn btn-primary mt-2">Search</button>
        </div>

        <table class="table mt-3">
            <h2>Guest</h2>
            <thead>
                <tr>
                    <th>Account ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Manage</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="user in users">
                    <td>{{ user.username }}</td>
                    <td>{{ user.fname }}</td>
                    <td>{{ user.lname }}</td>
                    <td>{{ user.role }}</td>
                    <td>{{ user.status }}</td>
                    <td> 
                        <button v-if="user.status == 'free'" @click="changeRole(user)" class="btn btn-secondary btn-sm">Admin</button>
                        <button v-if="user.status == 'free'" @click="changeStatus(user)" class="btn btn-danger btn-sm">Ban</button>
                        <button v-if="user.status == 'banned'" @click="changeStatus(user)" class="btn btn-success btn-sm">Unban</button>
                    </td>
                </tr>
            </tbody>
        </table>
        

      

<?php 
include_once('include/links.php');
?>

</body>
</html>
