<?php
// import the config file
include_once "include/config.php";

// Define variables and initialize with null string
$username = $password = $confirm_password = $fname = $lname=$loc= $email ="";
$username_err = $password_err = $confirm_password_err = $fname_err = $lname_err=$loc_err= $email_err = ""; #CHANGE HERE


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate username
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter a username.";
    } else{
        // Prepare a select statement
        $sql = "SELECT Admin_ID FROM admin WHERE Admin_ID = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = trim($_POST["username"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                    $username_err = "This username is already taken.";
                } else{
                    $username = trim($_POST["username"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // first name
    if(empty(trim($_POST["fname"]))){
        $fname_err = "Please enter a First Name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT Fname FROM admin WHERE Fname = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_fname);

            // Set parameters
            $param_fname = trim($_POST["fname"]);//changged

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                   //changed
                } else{
                    $fname = trim($_POST["fname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    //last name
    if(empty(trim($_POST["lname"]))){
        $lname_err = "Please enter a Last Name.";
    } else{
        // Prepare a select statement
        $sql = "SELECT Lname FROM admin WHERE Lname = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_lname);

            // Set parameters
            $param_lname = trim($_POST["lname"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                   //changed
                } else{
                    $lname = trim($_POST["lname"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    //email
    if(empty(trim($_POST["email"]))){
        $loc_err = "Please enter a email.";
    } else{
        // Prepare a select statement
        $sql = "SELECT Email FROM admin WHERE Email = ?";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);

            // Set parameters
            $param_email = trim($_POST["email"]);

            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);

                if(mysqli_stmt_num_rows($stmt) == 1){
                   //changed
                } else{
                    $email = trim($_POST["email"]);
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Validate confirm password
  /*  if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }*/

    // Check input errors before inserting in database
    if(empty($username_err) && empty($password_err) && empty($confirm_password_err) && empty($fname_err) && empty($lname_err)){

        // Prepare an insert statement
        $sql = "INSERT INTO admin (Admin_ID, Fname, Lname, Password, Email) VALUES (?, ?, ?, ?,?)";

        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sssss", $param_username, $param_fname, $param_lname, $param_password, $param_email);

            // Set parameters
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_fname = $fname;
            $param_lname = $lname;
            $param_email=$email;

            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: AdminRegistration.php");
            } else{
                echo "Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Sign Up</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="CSS/Home.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
      crossorigin="anonymous"
    />



</head>
<body style="background-color: rgb(68, 182, 102);">

    <!-- Header part start -->

    <!--

      New Navbar starts here..

     -->

     <nav class="navbar navbar-expand-lg bg-primary text-white fixed-top">
      <div class="container-fluid">
        <a href="#" class="navbar-brand">
          <h3 class="text-white text-center mb-0 py-2">
            <img
              class="rounded float"
              src="img/medicine .png"
              alt="logo"
              style="width: 50px"
            />
            ProgMedix
          </h3>
        </a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 ms-auto mb-lg-0">
            <li class="nav-item mx-3" style="font-size: 20px">
              <a class="nav-link active" aria-current="page" href="Home.html"
                >Home</a
              >
            </li>
            <li class="nav-item mx-3" style="font-size: 20px">
              <a
                class="nav-link active"
                aria-current="page"
                href="adminPanel.php"
                >Admin Panel</a
              >
            </li>
            
            <li class="nav-item mx-3" style="font-size: 20px">
              <a
                class="nav-link active"
                aria-current="page"
                href="products.html"
                >Products</a
              >
            </li>

            <li class="nav-item mx-3" style="font-size: 20px">
              <a class="nav-link active" aria-current="page" href="user_login.php"
                >Login</a
              >
            </li>
            <li class="nav-item mx-3" style="font-size: 20px">
              <a class="nav-link active" aria-current="page" href="UserRegistration.html"
                >Sign Up</a
              >
            </li>
          </ul>
          <form class="d-flex" role="search">
            <input
              class="form-control me-2"
              type="search"
              placeholder="Search"
              aria-label="Search"
            />
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
          </form>
        </div>
      </div>
    </nav>

    <!-- New Navbar ends here -->


    <p style="margin: 130px;"></p>

  <div class="container">

    <h1 style="color: blue ; text-align: center; padding-bottom: 15px;">User Registration</h1>

     <form class="row g-3" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
       <!-- First Name -->
       <div class="col form-group <?php echo (!empty($fname_err)) ? 'has-error' : ''; ?>">
           <label for="First-Name" class="form-label">First Name</label>
           <input name="fname" type="text" class="form-control" placeholder="First name" aria-label="First name" value="<?php echo $fname; ?>">
         </div>
         <!--username -->
         <div class="col form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
           <label for="username" class="form-label">Username</label>
           <input name="username" type="text" class="form-control" placeholder="Username" aria-label="Username" value="<?php echo $username; ?>">
         </div>
         <p></p>
         <!-- Last name -->
         <div class="col form-group <?php echo (!empty($lname_err)) ? 'has-error' : ''; ?>">
           <label for="Last-Name" class="form-label">Last Name</label>
           <input name="lname" type="text" class="form-control" placeholder="Last name" aria-label="Last name" value="<?php echo $lname; ?>">
         </div>
         <p></p>
         <!-- Email -->
       <div class="col-md-6 form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
         <label for="inputEmail4" class="form-label">Email</label>
         <input name="email" type="email" class="form-control" id="inputEmail4" value="<?php echo $email; ?>">
       </div>
       <!-- password -->
       <div class="col-md-6 form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
         <label for="inputPassword4" class="form-label">Password</label>
         <input name="password" type="password" class="form-control" id="inputPassword4" value="<?php echo $password; ?>">
       </div>
      

       <div class="col-12">
         <div class="form-check">
           <input class="form-check-input" type="checkbox" id="gridCheck">
           <label class="form-check-label" for="gridCheck">
             Accept Terms & Conditions
           </label>
         </div>
       </div>
       <div class="col-12 ">
         <button type="submit" class="btn btn-primary text-center">Sign Up</button>
       </div>
     </form>

</div>

<script src="https://use.fontawesome.com/35ab16800c.js"></script>
<script
  src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
  crossorigin="anonymous"
></script>
</body>
</html>