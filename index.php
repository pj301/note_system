<?php
include 'includes/db_conn.php';
// include 'includes/login.php';

session_start(); // Start the session
$error = array(); // Initialize error array

if (isset($_POST['submit'])) {


    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $pass = md5($_POST['password']);

    $select = "SELECT * FROM user_form WHERE name = '$name' AND password ='$pass'";
    $result = mysqli_query($conn, $select);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);

        if (!empty($row['name'])) { 
            $_SESSION['user_name'] = $row['name'];
            header('location: dashboardpage.php');
            exit();
        }
    } else {
        $error[] = 'Incorrect username or password!';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EasyNote</title>
    <link rel="stylesheet" href="styless/landing.css">
    <link rel="stylesheet" href="fonts-awesome/css/all.css">
    <style>
        /* Style for success message */
.success-msg {
    color: #4CAF50; /* Green color */
    font-size: 16px;
    margin-top: 10px; /* Add some space between message and form elements */
}

/* Style for error message */
.error-msg {
    color: #F44336; /* Red color */
    font-size: 16px;
    margin-top: 10px; /* Add some space between message and form elements */
}

/* Style for form container */
.form-container {
    max-width: 400px; /* Adjust as needed */
    margin: 0 auto; /* Center the form horizontally */
    padding: 20px;
}

/* Style for close button (optional) */
.close {
    color: #aaa;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: black;
    text-decoration: none;
    cursor: pointer;
}

    </style>

</head>
<body>
<!-- /* ________________________________________________________________________________*/   -->

<div class="nav-container">
        <nav class="navbar">     
            <div class="left-section">
                <div class="logo-name">Easy<span class="color-alter">Note</span></div>
                <ul class="left-menu">
                <li><a href="index.php" class="home-btn active">Home</a></li>
                <li><a href="index.php" class="home-btn active">Services</a></li>
                <li><a href="index.php" class="home-btn active">Contact</a></li>
                </ul>
            </div>
            <div class="right-section">
                <ul class="right-menu">
                    <li>
                        <input type="checkbox" id="switch-button">
                        <label for="switch-button">
                            <i class="fas fa-sun"></i>
                            <i class="fas fa-moon"></i>
                        </label>
                    </li>
                    <li><button class="signin-btn" onclick="openModal()"><span>Log in</span></button></li>
                    <li><button class="register-btn" onclick="openRegisterModal()"><span>Sign up</span></button></li>

                </ul>
            </div>
        </nav>

    </div> 

 <!-- /* ________________________________________________________________________________*/   -->
 
<!-- The Modal -->
<div id="myModal" class="modal">
    <!-- Modal content -->
    <div class="form-container">    
        <!-- Your form content goes here -->
        <form id="loginForm">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3>LOGIN NOW</h3>
            <div id="loginErrorContainer"></div>
            <div id="loginSuccessContainer"></div>
            <input type="text" name="name" id="username" required placeholder="Enter your username"> 
            <input type="password" name="password" id="password" required placeholder="Enter your password">
            <input type="button" onclick="submitLogin()" value="Login Now" class="form-btn">
            <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
        </form>
    </div>
</div>
 <!-- /* ________________________________________________________________________________*/   -->
  <!-- The Modal -->
  <div id="registerModal"  class="modal">
    <!-- Modal content -->
    <div class="form-container">    
        <!-- Your form content goes here -->
        <form action="" method="post" id="registerForm">
        <span class="close" onclick="closeRegisterModal()">&times;</span>
            <h3>SIGN UP NOW</h3>
            <div id="errorContainer"></div>
            <div id="successContainer"></div>
        
            <input type="text" name="name" required placeholder="enter your username">
            <input type="email" name="email" required placeholder="enter your email">
            <input type="password" name="password" required placeholder="enter your password">
            <input type="password" name="cpassword" required placeholder="confirm your password">
        

            <input type="button" onclick="submitForm()" value="Register Now" class="form-btn">       
            <p>already have an account? <a href="login.php">Login now</a></p>
        </form>
        </div>
</div>
 <!-- /* ________________________________________________________________________________*/   -->


    <div class="main-container">
     
        <div class="container">
            
                <div class="main-container-left">
                    <div class="card">
                        <h2 id="typewriter">Unlock Your Creativity <br> With <span id="easyNote"></span> Today!</h2>
                        <p>
                        EasyNote revolutionizes the way you capture and manage your thoughts. EasyNote empowers you to effortlessly jot down ideas, organize your notes, and unleash your creativity without any hassle. Whether you're a writer, student, or professional, our user-friendly platform provides a seamless experience, allowing you to focus on what truly matters-bringing your ideas to life. 
                        </p>
                        <div class="button-group">
                        <button type="button" class="button-signin">Demo</button>
                        </div>
                    </div>
                </div>
              
              <div class="main-container-right">
                <img src="images/note-image.png" alt="main image">
              
              </div>
        </div>
    </div>
<!-- /* ________________________________________________________________________________*/   -->
<div class="main-feature-container">
    <div  class="feature-heading">
        <h1>Amazing <span class="feature-alter"> Features </span>For You</h1>
        <img src="images/heading-line-dec.png" alt="">
    </div> 
    <div class="features-container">
        <div class="feature-card">
            <h3>Create Notes</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula metus ut leo fringilla ultrices.</p>
        </div>
        <div class="feature-card">
            <h3>Favorites</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula metus ut leo fringilla ultrices.</p>
        </div>
        <div class="feature-card">
            <h3>Archived</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla vehicula metus ut leo fringilla ultrices.</p>
        </div>
    </div>
</div>
  <!-- /* ________________________________________________________________________________*/   -->
  
    <footer>
       <!-- Social media icons with default (white) icons -->
        <div class="social-media-icons">
            <a href="https://www.facebook.com/" class="facebook"><img src="images/facebook-color.png" alt="Facebook"></a>
            <a href="https://www.instagram.com/" class="snapchat"><img src="images/snapchat-color.png" alt="Snapchat"></a>
            <a href="https://www.snapchat.com/" class="instagram"><img src="images/instagram-color.png" alt="Instagram"></a>
            <a href="https://www.whatsapp.com/" class="whatsapp"><img src="images/whatsapp-color.png" alt="Whatsapp"></a>
            <!-- Add more social media icons as needed -->
        </div>

    </footer>
    
<!-- /* ________________________________________________________________________________*/   -->

    <script>
// Get all navbar list items
const navbarItems = document.querySelectorAll('.navbar .navbar-menu ul li a');

// Add event listener to each navbar list item
navbarItems.forEach(item => {
    item.addEventListener('click', function() {
        // Remove active class from all items
        navbarItems.forEach(item => {
            item.classList.remove('active');
        });

        // Add active class to the clicked item
        this.classList.add('active');
    });
});


   document.addEventListener('DOMContentLoaded', function() {
    window.addEventListener('scroll', function() {
        var navbar = document.querySelector('.nav-container');
        var isDarkMode = document.body.classList.contains('dark-mode');
        var scrollTop = window.scrollY;

        // Check if the page is in dark mode
        if (isDarkMode) {
            // Handle background color for dark mode
            if (scrollTop > 0) {
                navbar.classList.add('colored');
                navbar.classList.remove('transparent');
            } else {
                navbar.classList.remove('colored');
                navbar.classList.add('transparent');
            }
            navbar.classList.remove('white-bg'); // Remove white background class
        } else {
            // Handle background color for light mode
            if (scrollTop > 0) {
                navbar.classList.add('colored');
                navbar.classList.remove('transparent');
            } else {
                navbar.classList.remove('colored');
                navbar.classList.add('transparent');
            }
            if (scrollTop > 0) {
                navbar.classList.add('white-bg'); // Add white background class when scrolled down
            } else {
                navbar.classList.remove('white-bg'); // Remove white background class when at the top
            }
        }
    });
});

 /* ________________________________________________________________________________*/

        // Function to simulate typewriter effect
function typeWriter(text, i, id) {
    if (i < text.length) {
        document.getElementById(id).innerHTML += text.charAt(i);
        i++;
        setTimeout(function() { typeWriter(text, i, id); }, 500); // Adjust typing speed here
    } else if (id === 'easyNote') {
        document.getElementById(id).style.opacity = 1; // Fade in EasyNote after typing is complete
         // Clear the text after typing is complete
         setTimeout(function() {
            document.getElementById(id).innerHTML = '';
            typeWriter(text, 0, id); // Restart typewriter for the same text
        }, 300); // Adjust delay before starting the next iteration
    }
}

// Call typewriter function for the word "EasyNote"
window.onload = function() {
    var text = "EasyNote";
    typeWriter(text, 0, 'easyNote');
};

 /* ________________________________________________________________________________*/

// Dark mode toggle functionality
document.getElementById('switch-button').addEventListener('click', function() {
    document.body.classList.toggle('dark-mode');
    
});

// Get the modal
var modal = document.getElementById("myModal");
var registerModal = document.getElementById("registerModal");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
function openModal() {
    modal.style.display = "block";
    formContainer.classList.add('active');
}

// When the user clicks on <span> (x), close the modal
function closeModal() {
    modal.style.display = "none";
    formContainer.classList.remove('active');
}
function openRegisterModal(){
    registerModal.style.display = "block";
    formContainer.classList.add('active');
}
function closeRegisterModal() {
    registerModal.style.display = "none";
    formContainer.classList.remove('active');
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}


document.addEventListener('DOMContentLoaded', function() {
  var mainContainer = document.querySelector('.main-container');
  mainContainer.classList.add('active'); // Add 'active' class to trigger transition
  document.querySelector('.feature-heading').classList.add('active');
document.querySelector('.features-container').classList.add('active');
document.querySelector('footer').classList.add('active');
document.querySelector('.navbar').classList.add('active');



});

function submitLogin() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var formData = new FormData();
        formData.append("name", username);
        formData.append("password", password);

        var xhr = new XMLHttpRequest();

        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        
                        swal("", "Successfully Logged In!", "success").then(function() {
                        window.location.href = 'dashboardpage.php';
                    });
                    } else {
                        document.getElementById("loginErrorContainer").innerHTML = "<span class='error-msg'>" + response.message + "</span>";
                        setTimeout(function() {
                            document.getElementById("loginErrorContainer").innerHTML = ""; 
                        }, 3000);
                    }
                } else {
                    console.error('Server error: ' + xhr.status);
                }
            }
        };

        xhr.open("POST", "login.php", true);
        xhr.send(formData);
    }
function submitForm() {
    var form = document.getElementById("registerForm");
    var formData = new FormData(form);
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                if (response.success) {
                    document.getElementById("successContainer").innerHTML = "<span class='success-msg'>" + response.message + "</span>";
                    setTimeout(function() {
                        document.getElementById("successContainer").innerHTML = ""; // Clear success message after 5 seconds
                    }, 5000);
                    // Redirect to index.php
                    window.location.href = "index.php";
                    // You can also delay the redirection to give user a chance to read the success message
                    setTimeout(function() {
                        window.location.href = "index.php";
                    }, 3000); // Redirect after 3 seconds
                } else {
                  // Display error message with a time limit
                    document.getElementById("errorContainer").innerHTML = "<span class='error-msg'>" + response.message + "</span>";
                    setTimeout(function() {
                        document.getElementById("errorContainer").innerHTML = ""; // Clear error message after 5 seconds
                    }, 3000); 
                }
            } else {
                // Handle server errors
                console.error('Server error: ' + xhr.status);
            }
        }
    };

    xhr.open("POST", "register_form.php", true);
    xhr.send(formData);
}


 
    </script>
    <script src="js/sweetalert.js"></script>
<script>window.history.forward();</script>
</body>
</html>