<!DOCTYPE html>
<html lang="en">
<head>
    <title>Checkout Result</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .success {
            color: green;
        }

        .error {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Assuming the checkout is always successful -->
        <h2 class='success'>Checkout Successful!</h2>
        <p>Your order has been placed successfully!</p>
        <p><a href='index.html'>Return to Home</a></p>
    </div>
</body>
</html>
