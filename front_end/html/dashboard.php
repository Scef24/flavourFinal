<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavour Dashboard</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>

<div id="app">
    <header class="text-black p-3" style="background-color: rgba(247, 251, 251);">
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

    <h1 class="ml-5">What's new</h1>
    <div class="mt-3">
            <button @click="toggleView" class="btn btn-primary">Discover</button>
        </div>
    <div v-if="selectedView ==='view1'">
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
         
                <img src="https://scontent.fceb2-1.fna.fbcdn.net/v/t39.30808-6/397989341_314946918195072_4984592624945300022_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=3635dc&_nc_eui2=AeEcB-mdcWgXZLzXXA0hI_aOvf1TbA5GSHC9_VNsDkZIcGXZ9AZdDY7nSNPJw7nX5T_Nah_1baj6Wfwsq628xrJd&_nc_ohc=q6oiJQs3sKIAX9Dd7_R&_nc_zt=23&_nc_ht=scontent.fceb2-1.fna&cb_e2o_trans=t&oh=00_AfB4IynguA3q90WVDdrQa0AFeMi9jsSqgm1pAbsSgepAYg&oe=65925DBE" alt="Image 1" class="img-thumbnail mb-3">
            </div>
            <div class="col-md-6">
     
                <img src="https://scontent.fceb2-2.fna.fbcdn.net/v/t39.30808-6/393274870_304398182583279_5427834776687487244_n.jpg?_nc_cat=100&ccb=1-7&_nc_sid=3635dc&_nc_eui2=AeFgbsd_Yb-vwOJzZUM7LKYcGIn0GXE-_HcYifQZcT78d6R_xN97RealuHW3snTlBbzZt77npNd9TsSgpnSe3ryG&_nc_ohc=fA-cepuOsYgAX8HH9CJ&_nc_zt=23&_nc_ht=scontent.fceb2-2.fna&cb_e2o_trans=t&oh=00_AfB0DrqDFY-ev1J0envST-D60kPk2SC4geNx26l9hyYksA&oe=65917328" alt="Image 2" class="img-thumbnail mb-3">
            </div>
        </div>
    </div>

</div>


<div v-if="selectedView ==='view2'">
<div class="row">
            <div class="col-md-6">
        
                <img src="https://scontent.fmnl25-5.fna.fbcdn.net/v/t39.30808-6/412437110_347989788224118_1481079643693466885_n.jpg?_nc_cat=108&ccb=1-7&_nc_sid=dd5e9f&_nc_eui2=AeGOpomqs6ZTpm9vxKD3sbdanQ5_3i-r-A-dDn_eL6v4D-4BZ4LTvalTtlTpaXQGOZZpSZZcYpQI13vWSAd6flle&_nc_ohc=07AmaS2RLPsAX-toBVD&_nc_zt=23&_nc_ht=scontent.fmnl25-5.fna&cb_e2o_trans=t&oh=00_AfCeqMpYqZyBlqHQAGTtuIgdKHjz1UurSGxFxbGMbDrEnQ&oe=6591C471" alt="Image 1" class="img-thumbnail mb-3">
            </div>
            <div class="col-md-6">

                <img src="https://scontent.fceb2-1.fna.fbcdn.net/v/t39.30808-6/380816579_286566894366408_7472934058055963314_n.jpg?_nc_cat=101&ccb=1-7&_nc_sid=3635dc&_nc_eui2=AeEJE_4kKHzfV2qg1t1Faytoznt8XP5Tc93Oe3xc_lNz3SXHt7Gb1yzbKiUa38OVbne1cXOXFGKE8FU_e79KCCe_&_nc_ohc=0yR6bd7fM8sAX8-U3Rm&_nc_zt=23&_nc_ht=scontent.fceb2-1.fna&cb_e2o_trans=t&oh=00_AfDTftiXUHectLkODfd58dI6MJIBNDConCftsWTkw742cA&oe=65919BF4" alt="Image 2" class="img-thumbnail mb-3">
            </div>
        </div>
</div>
<div v-if="selectedView ==='view3'">
<div class="row">
            <div class="col-md-6">
        
                <img src="https://scontent.fmnl25-1.fna.fbcdn.net/v/t39.30808-6/378511219_278353035187794_579260741048849670_n.png?_nc_cat=108&ccb=1-7&_nc_sid=783fdb&_nc_eui2=AeGnfgO4FC7aQhyWn657eMlqyKGum-Kz6I3Ioa6b4rPojffMwuMrUeL3ER5JzHc3OP2upvxq9tfZSQhawJ2QyIPG&_nc_ohc=NcXZSVpfJWoAX_-f_JE&_nc_zt=23&_nc_ht=scontent.fmnl25-1.fna&cb_e2o_trans=t&oh=00_AfAjY8-KYXyF4zqXr3pOp-yn06xx064ipju_w_7pCIJzSw&oe=6592D242" alt="Image 1" class="img-thumbnail mb-3">
            </div>
            <div class="col-md-6">
      
                <img src="https://scontent.fceb2-2.fna.fbcdn.net/v/t39.30808-6/370377966_270192526003845_7983256880972411017_n.jpg?_nc_cat=105&ccb=1-7&_nc_sid=3635dc&_nc_eui2=AeHkjXVy7KkcKZ8LjN1yKE3dOVg1kUaw9wU5WDWRRrD3BeT0p2-9wIrmMLZWfek7JU57e0ZfNPH4VAyetDMfDsuL&_nc_ohc=tHoNDUyty9wAX8mBsHH&_nc_zt=23&_nc_ht=scontent.fceb2-2.fna&cb_e2o_trans=t&oh=00_AfCC5GJylK6VedBlYl58bWpX7UxJ9RBUVBppPI64brjyug&oe=6592C3E9" alt="Image 2" class="img-thumbnail mb-3">
            </div>
        </div>
</div>

<footer class="text-center text-white p-3" style="background-color: #343a40;">
    <p>&copy; 2023 Flavour Coffee</p>
    <a href="https://web.facebook.com/flavour.coffeestation">Contact Us</a> 
</footer>
<?php include_once('include/links.php'); ?>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

</body>

</html>
