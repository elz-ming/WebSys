<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Page Logo -->
    <link rel="icon" type="image/png" href="/asset/image/favicon.png">

    <title>Login/Register</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="asset/css/login.css">
</head>

<body>
    <div class="container" id="container">
        <button id="toggleForms" class="toggle-forms-btn">To Sign-Up</button>
        <div class="form-container sign-up">
            <form action="/asset/php/register.process.php" method="post">
                <a href="index.php" style="text-decoration: none; color: inherit;">
                    <h1>
                        <span>C</span><span>r</span><span>e</span><span>a</span><span>t</span><span>e</span>
                        <span> </span>
                        <span>A</span><span>c</span><span>c</span><span>o</span><span>u</span><span>n</span><span>t</span>
                    </h1>
                </a>
                <div class="mb-3">
                    <label for="first_name" class="form-label"></label>
                    <input required maxlength="45" type="text" id="first_name" name="first_name" class="form-control"
                        placeholder="Enter first name">
                </div>
                <div class="mb-3">
                    <label for="last_name" class="form-label"></label>
                    <input required maxlength="45" type="text" id="last_name" name="last_name" class="form-control"
                        placeholder="Enter last name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label"></label>
                    <input required type="email" id="user_email" name="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label"></label>
                    <input required maxlength="30" minlength="8" type="password" id="pwd" name="pwd"
                        class="form-control" placeholder="Enter password">
                </div>
                <div class="mb-3">
                    <label for="pwd_confirm" class="form-label"></label>
                    <input required maxlength="30" minlength="8" type="password" id="pwd_confirm" name="pwd_confirm"
                        class="form-control" placeholder="Confirm password">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="/asset/php/login.process.php" method="post" class="login-form">
                <a href="index.php" style="text-decoration: none; color: inherit;">
                    <h1>
                        <span>W</span><span>e</span><span>l</span><span>c</span><span>o</span><span>m</span><span>e</span>
                        <span> </span>
                        <span>B</span><span>a</span><span>c</span><span>k</span>
                    </h1>
                </a>
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
                <div class="mb-3">
                    <label for="email" class="form-label"></label>
                    <input required type="email" id="email" name="email" class="form-control" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label for="pwd" class="form-label"></label>
                    <input required maxlength="30" minlength="8" type="password" id="pwd" name="pwd"
                        class="form-control" placeholder="Password">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>

            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Welcome Back!</h1>
                    <p>Enter your personal details to use all of site features</p>
                    <button class="hidden" id="login">Sign In</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Hello, Traveller!</h1>
                    <p>Not Registered? Register Now with your personal details to use all of site features</p>
                    <button class="hidden" id="register">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script src="asset/js/LoginScript.js"></script>
</body>

</html>
