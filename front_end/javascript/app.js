
  

  // Create the Vue instance
  const app = Vue.createApp({
    data() {
      return {
        username: '',
        fname: '',
        lname: '',
        password: '',
        Cpassword: '',
        securityQuestionOptions: [
            { value: 'q1', text: 'What is your favorite color?' },
            { value: 'q2', text: 'What is the name of your first pet?' },
            // Add more security questions as needed
        ],
        selectedView:'view1',
        selectedTable: 'guest',
        selectedform:'userform',
        securityQuestion: '',
        securityAnswer: '',
        newPassword: '', // Add these properties
        confirmNewPassword: '' ,
        search: '',
        Asearch: '',
        showData: true,
        admin_guest: true,
        RL: true,
        users: [],
        admins: [],
        auth: null,
      };
    },
    methods: {
        toggleTable() {
           
            this.selectedTable = this.selectedTable === 'guest' ? 'admin' : 'guest';
        },
        toggleForm() {
            this.selectedform = this.selectedform === 'userform' ? 'nameform' : (this.selectedform === 'nameform' ? 'passform' : 'userform');
        },
        toggleView() {
            this.selectedView = this.selectedView=== 'view1' ? 'view2' : (this.selectedView === 'view2' ? 'view3' : 'view1');
        },
        
        

        save(){

            const loadingSpinner = document.getElementById('loading-spinner');
            loadingSpinner.style.display = 'block';

            if (!this.username || !this.fname || !this.lname || !this.password || !this.Cpassword){
                alert("Please fill up everything.");
                loadingSpinner.style.display = 'none';
                return;
            }
            if (this.Cpassword != this.password) {
                alert("Password don't match.");
                loadingSpinner.style.display = 'none';
                return;
            }
            


           
            let data = new FormData();
            data.append('method', 'Save_User');
            data.append('username',this.username)
            data.append('fname',this.fname)
            data.append('lname',this.lname)
            data.append('securityQuestion',this.securityQuestion)
            data.append('securityAnswer',this.securityAnswer)
            data.append('password',this.password)

            fetch('../../back_end/handler/router.php',
            {
                method:'POST',
                body:data
            }
            )
            .then(res=>{
                return res.text();
            })
            .then(data=>{

                
                if (JSON.parse(data) == 1){ 
            
                window.location.href = "login.php"
                }else if (JSON.parse(data) == 0){
                alert( "Account Already Exist" );
                }        
                
            })
            .finally(() => {
                loadingSpinner.style.display = 'SUCCESS'; 
            });

         
        },
        resetPassword() {
            
            if (!this.username || !this.securityAnswer || !this.newPassword || !this.confirmNewPassword) {
                alert('Please fill in all fields.');
                return;
            }
        
        
            let data = new FormData();
            data.append('method', 'Reset_Password'); 
            data.append('username', this.username);
            data.append('securityQuestion', this.securityQuestion);
            data.append('securityAnswer', this.securityAnswer);
            data.append('newPassword', this.newPassword);
            data.append('confirmNewPassword', this.confirmNewPassword);
        
            fetch('../../back_end/handler/router.php', {
                method: 'POST',
                body: data
            })
            .then(res => res.json())
            .then(data => {
                try {
                    if (data.success) {
                        alert('Password reset successfully.');
                       
                        window.location.href = 'login.php';
                    } else {
                        let errorMessage = 'An unexpected error occurred.';
            
                        if (data.error) {
                            errorMessage = data.error;
                        }
            
                        // Log the error to the console
                        console.error('Failed to reset password:', errorMessage);
                        
                        // Alert the user with the error message
                        alert(errorMessage);
                    }
                } catch (error) {
                    // Handle unexpected errors during parsing
                    console.error('Error parsing JSON response:', error);
                    alert('Failed to reset password. Please try again later.');
                }
            })
            .catch(error => {
                // Handle network or other unexpected errors
                console.error('An unexpected error occurred:', error);
                alert('Failed to reset password. Please try again later.');
            });
        },            
        
        

        searchUsers(){           
            // debugger;  
            let data = new FormData();
            data.append('method','Search_Users');
            data.append('search',this.search)
            fetch('../../back_end/handler/router.php',
                {
                    method:'POST',
                    body:data
                }
            )
            .then(res=>{
                return res.text();
            })
            .then(data=>{

                this.users = JSON.parse(data);
                console.log( this.users);
                
            })

           
        },
    
        searchAdmins(){           
           
            let data = new FormData();
            data.append('method','Search_Admins');
            data.append('Asearch',this.Asearch)
            fetch('../../back_end/handler/router.php',
                {
                    method:'POST',
                    body:data
                }
            )
            .then(res=>{
                return res.text();
            })
            .then(data=>{

                this.admins = JSON.parse(data);
                console.log( this.admins);
                
            })

           
        },
        showAlert(message, alertClass) {
            const alertContainer = document.getElementById('alert-container');
            const alertElement = document.createElement('div');
            alertElement.classList.add('alert', alertClass);
            alertElement.textContent = message;
            alertContainer.appendChild(alertElement);
        },

        logIn(){
            

            const loadingSpinner = document.getElementById('loading-spinner');
            loadingSpinner.style.display = 'block';

            if (!this.username || !this.password) {
                alert("Please fill in both email and password.");
                loadingSpinner.style.display = 'none';
                return;
            }

            let data = new FormData();
            data.append('method', 'Log_In');
            data.append('username',this.username)
            data.append('password',this.password)

            fetch('../../back_end/handler/router.php',
                {
                    method: 'POST',
                    body:data,
                }
            )
            .then(res =>{

                return res.text();

            }) 
            .then(data => {
               
                this.formClear();
                this.auth = JSON.parse(data);
                console.log(this.auth);
                if (data == 0){
                    alert("You are Banned");
                    return;
                }else{
                   
                    
                    if(this.auth['role'] === 'guest'){
                    window.location.href = "dashboard.php";
                    }else if(this.auth['role'] === 'admin'){
                    window.location.href = "admin.php";
                    } 
                }

            })
            .catch(error => {
               
                this.formClear();
                alert("Login Failed.");
                console.error(error);
            })
            .finally(() => {
                loadingSpinner.style.display = 'none'; // Hide loading spinner
            });
            
        },

        
        logout(){
           console.log("HI")
            let data = new FormData();
            data.append('method','Logout');
            fetch('../../back_end/handler/router.php',
                {
                    method:'POST',
                    body: data
                }
            )
            .then(res=>{                   
                return res.text();
            })
            .then(data=>{
             
                console.log(data)
                this.auth = null
                window.location.href = "login.php";
            })

            

        },

         displayAuth(){
                // debugger;
                // Your code that might throw an error
                let data = new FormData();
                data.append('method','Display_Auth');
                fetch('../../back_end/handler/router.php',
                    {
                        method:'POST',
                        body: data
                    }
                )
                .then(res=>{                   
                    return res.text();
                })
                .then(data=>{
                    // this.auth = JSON.parse(data);
                    console.log(data)
                })          
        },



        change(){

            window.location.href = "change_cred.php";
            
        },

        changeAuth(){
            console.log(this.auth)
            let data = new FormData();
            data.append('method','Change_Auth');
            fetch('../../back_end/handler/router.php',
                {
                    method:'POST',
                    body: data
                }
            )
            .then(res=>{                   
                return res.text();
            })
            .then(data=>{
                // this.auth = JSON.parse(data);
                console.log(data)
            }) 
    },

        changeRole($user){
            
            let data = new FormData();
            data.append('method','Change_Role');
            data.append('user_id', $user['user_id']);
            fetch('../../back_end/handler/router.php',
                {
                    method:'POST',
                    body: data
                }
            )
            .then(res=>{                   
                return res.text();
            })
            .then(data=>{
                // this.auth = JSON.parse(data);
                data = data
            }) 

            location.reload()
            console.log($user["user_id"])



      },


      changeStatus($user){
        let data = new FormData();
        data.append('method','Change_Status');
        data.append('user_id', $user['user_id']);
        fetch('../../back_end/handler/router.php',
            {
                method:'POST',
                body: data
            }
        )
        .then(res=>{                   
            return res.text();
        })
        .then(data=>{
            // this.auth = JSON.parse(data);
            data = data
        }) 

        location.reload()
        console.log($user["user_id"])



  },


        changeAccId(){
            
            if (!this.account_id)  {
                alert("Fill up Account ID");
                return;
            }


            let data = new FormData();
            data.append('method','Change_Account_ID');
            data.append('username',this.username)
            fetch('../../back_end/handler/router.php',
            {
                method:'POST',
                body:data
            }
            )
            .then(res=>{
                return res.text();
            })
            .then(data=>{

                // console.log(JSON.parse(data));
                if (JSON.parse(data) == 1){ 
                alert( "Account ID Successfully Changed" );
                location.reload()
                }else if (JSON.parse(data) == 0){
                alert( "Account ID Already Exist" );
                }        
                
            })

        },

        changeName(){

            if(!this.fname || !this.lname){
                alert("Fill up Names")
                return
            }


               debugger;
            let data = new FormData();
            data.append('method','Change_Name');
            data.append('fname',this.fname);
            data.append('lname',this.lname);
            fetch('../../back_end/handler/router.php',
            {
                method:'POST',
                body:data
            }
            )
            .then(res=>{
                return res.text();
            })
            .then(data=>{

                // console.log(JSON.parse(data));
                if (JSON.parse(data) == 1){ 
                     
                alert( "Name Successfully Changed" );
                location.reload()
                
                }else if (JSON.parse(data) == 0){
                alert( "Name Already Exist" );
                }        
                
            })

        },


        changePass(){

            if (!this.password || !this.Cpassword)  {
                alert("Fill up Passwords");
                return;
            }

               
            let data = new FormData();
            data.append('method','Change_Password');
            data.append('password',this.password)
            data.append('Cpassword',this.Cpassword)
            fetch('../../back_end/handler/router.php',
            {
                method:'POST',
                body:data
            }
            )
            .then(res=>{
                return res.text();
            })
            .then(data=>{

                // console.log(JSON.parse(data));
                if (JSON.parse(data) == 1){  
                alert( "Password Successfully Changed" );
                location.reload()
                }else if (JSON.parse(data) == 0){
                alert( "New Password Is Identical To Current Password" );
                }else if (JSON.parse(data) == -1){
                alert( "Current Password Is Not Identical To Current Password" );
                }             
                
            })
            

        },


    
        formClear(){
            this.username = ""
            this.fname = ""
            this.lname = ""
            this.password = ""
        },


      
       

    }, 

    mounted(){
        
       
     
        let data = new FormData();
        data.append('method', 'Current_Auth');
        fetch('../../back_end/handler/router.php', {
                method: 'POST',
                body: data
            })
            .then(res => {
                return res.text();
            })
            .then(data => {
                this.auth = JSON.parse(data);
                console.log(this.auth);

                if ( Object.keys(this.auth).length === 0) {
                    this.RL = true
                    console.log(this.RL)
                   if(window.location.pathname === '/im_proj/front_end/html/dashboard.php' ||
                    window.location.pathname === '/im_proj/front_end/html/change_cred.php' || 
                    window.location.pathname === '/im_proj/front_end/html/admin.php' ){

                        window.location.href = "login.php";
                   }
                }
                if(Object.keys(this.auth).length !== 0){
                    this.RL = false
                    console.log(this.RL)
                    if(window.location.pathname === '/im_proj/front_end/html/login.php' ||
                    window.location.pathname === '/im_proj/front_end/html/register.php' ){
                        if(this.auth["role"] == "guest"){
                            window.location.href = "dashboard.php";
                        }else if(this.auth["role"] == "admin"){
                            window.location.href = "admin.php";
                        }
                   }

                   if(window.location.pathname === '/im_proj/front_end/html/dashboard.php' ){
                        if(this.auth["role"] == "admin"){
                            window.location.href = "admin.php";
                        }
                   }

                   if(window.location.pathname === '/im_proj/front_end/html/admin.php' ){
                        if(this.auth["role"] == "guest"){
                        window.location.href = "dashboard.php";
                        }
                     }

                }



            });
    
               
         if (window.location.pathname === '/im_proj/front_end/html/admin.php') {
           
           
                let data = new FormData();
                data.append('method','getAllUsers');
               
                fetch('../../back_end/handler/router.php',
                    {
                        method:'POST',
                        body:data
                    }
                )
                .then(res=>{
                    return res.text();
                })
                .then(data=>{
                    this.users = JSON.parse(data);
                    console.log( this.users);
                    
                })
          
        }

        if (window.location.pathname === '/im_proj/front_end/html/admin.php') {
         
           
                let data = new FormData();
                data.append('method','Get_All_Admins');
                
                fetch('../../back_end/handler/router.php',
                    {
                        method:'POST',
                        body:data
                    }
                )
                .then(res=>{
                    return res.text();
                })
                .then(data=>{
                    this.admins = JSON.parse(data);
                    console.log( this.admins);
                    
                })
          
        }

    

     


    }  
})


app.mount('#app')


