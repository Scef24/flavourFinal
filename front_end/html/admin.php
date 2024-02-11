<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
                   
                    <div class="btn-group">
                        <button type="button" class="btn btn-link text-black dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" href="#" @click="logout">Logout</a>
                            <a class="dropdown-item" href="credentials.php">Account Settings</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

   

     
        <div class="mt-3">
            <button @click="toggleTable" class="btn btn-primary">Toggle Tables</button>
        </div>

        <div v-if="selectedTable === 'guest'">
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
                        <button v-if="user.status == 'free'" @click="changeRole(user)" class="btn btn-secondary btn-sm me-2">Admin</button>
<button v-if="user.status == 'free'" @click="changeStatus(user)" class="btn btn-danger btn-sm me-2">Ban</button>
<button v-if="user.status == 'banned'" @click="changeStatus(user)" class="btn btn-success btn-sm">Unban</button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div v-if="selectedTable === 'admin'" class="mt-3">
            <label for="search_name">Enter Admin:</label>
            <input type="text" v-model="Asearch" class="form-control">
            <button @click="searchAdmins" class="btn btn-primary mt-2">Search</button>
        </div>

        <table v-if="selectedTable === 'admin'" class="table mt-3">
            <h2>Admin</h2>
            <thead>
                <tr>
                    <th>Account ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Role</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="admin in admins">
                    <td>{{ admin.username }}</td>
                    <td>{{ admin.fname }}</td>
                    <td>{{ admin.lname }}</td>
                    <td>{{ admin.role }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <footer class="text-center text-white p-3" style="background-color: #343a40;">
    <p>&copy; 2023 Flavour Coffee</p>
    <a href="https://web.facebook.com/flavour.coffeestation">Contact Us</a> 
</footer>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <?php 
    include_once('include/links.php');
    ?>

</div>
</body>
</html>
