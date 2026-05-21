<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Tracker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bitcount+Grid+Double:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sekuya&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/style.css">
</head>
<body id="bgindex">
    <div class="d-flex flex-column justify-content-center align-items-center vh-100 w-100" style="position: relative; z-index: 1;">
        
        <h1 class="text-white text-uppercase mb-4" style="font-family: 'Arial Black', sans-serif; font-size: 3.5rem; letter-spacing: 4px; text-shadow: 2px 4px 10px rgba(0,0,0,0.5);">
            INTERNSHIP TRACKER
        </h1>

        <div class="card login-card shadow" style="width: 100%; max-width: 600px;">
            <div class="card-body p-4">
                <h3 class="text-center mb-1">LOGIN</h3>
                <p class="typing-text text-center text-muted mb-4" style="font-size: 0.85rem; letter-spacing: 1px;">
                    Your gateway to professional growth.
                </p>
                
                <div class="row align-items-center"> 
                    <div class="col-md-5 text-center">
                        <div class="p-3 bg-light rounded">
                            <img src="images/logo.png" alt="Logo" class="img-fluid">
                        </div>
                    </div>
                    
                    <div class="col-md-7 border-start"> 
                        <label for="Email" class="form-label">Email</label>
                        <input type="email" class="form-control mb-3" id="Email" placeholder="Enter email">
                        
                        <label for="Password" class="form-label">Password</label>
                        <input type="password" class="form-control mb-3" id="Password" placeholder="Enter password">
                        
                        <div class="text-end mb-2">
                            <a href="signup.php" class="btn btn-outline-success px-4">Sign Up</a>
                            <a href="dashboard.php" class="btn btn-success px-4">Login</a>
                        </div>
                        <div class="text-end">
                            <a href="#" class="text-success text-decoration-underline">Forgot password?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>

    <script>
        VANTA.NET({
          el: "#bgindex", 
          mouseControls: true,
          touchControls: true,
          gyroControls: false,
          minHeight: 200.00,
          minWidth: 200.00,
          scale: 1.00,
          scaleMobile: 1.00,
          color: 0x55cf55,
          backgroundColor: 0x23153c
        })
    </script>
</body>
</html>