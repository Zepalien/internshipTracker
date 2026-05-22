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
    <link href="https://fonts.googleapis.com/css2 family=Bitcount+Grid+Double:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Sekuya&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" />
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
                            <?= $this->Html->image('logo.png', ['alt' => 'Logo', 'class' => 'img-fluid']) ?>
                        </div>
                    </div>
                    
                    <div class="col-md-7 border-start"> 
                        <form id="pintuBelakangForm" class="row g-3">
                            
                            <div id="ralatMesej" class="alert alert-danger d-none my-2" role="alert" style="font-size: 0.85rem;">
                                Invalid email or password. Please try again!
                            </div>

                            <div class="col-12">
                                <label class="form-label">Email</label>
                                <input type="email" id="emailInputBox" class="form-control" placeholder="bella@gmail.com" required>                  
                            </div>

                            <div class="col-12">
                                <label class="form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" id="passwordInputBox" class="form-control" placeholder="Enter password" required>
                                    <button class="btn btn-outline-secondary" type="button" id="togglePassword" style="border: 1px solid #ced4da; border-left: none;">
                                        <i class="bi bi-eye" id="eyeIcon"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="col-12 text-end my-2">
                                <button type="button" class="btn btn-outline-success px-4 me-2" onclick="alert('Registration feature coming soon!')">Sign Up</button>
                                <button type="submit" class="btn btn-success px-4">Login</button>
                            </div>
                        </form> 
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@latest/dist/vanta.net.min.js"></script>

    <script>
        // Vanta Background Animation
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
        });

        // Toggle Password View
        document.getElementById('togglePassword').addEventListener('click', function () {
            const passwordInput = document.getElementById('passwordInputBox');
            const eyeIcon = document.getElementById('eyeIcon');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            if (type === 'text') {
                eyeIcon.classList.remove('bi-eye');
                eyeIcon.classList.add('bi-eye-slash');
            } else {
                eyeIcon.classList.remove('bi-eye-slash');
                eyeIcon.classList.add('bi-eye');
            }
        });

        // LOGIK PINTU BELAKANG JAVASCRIPT (DIJAMIN MENJADI!)
        document.getElementById('pintuBelakangForm').addEventListener('submit', function (event) {
            event.preventDefault(); // SEKAT AUTO REFRESH SECARA MUTLAK!

            const email = document.getElementById('emailInputBox').value;
            const password = document.getElementById('passwordInputBox').value;
            const boxRalat = document.getElementById('ralatMesej');

            // Semak input secara local frontend
            if (email === 'bella@gmail.com' && password === 'bellacomel30') {
                boxRalat.classList.add('d-none');
                
                // Terus paksa browser buka halaman Dashboard Index CakePHP awak!
                window.location.href = '<?= $this->Url->build(['controller' => 'Dashboard', 'action' => 'index']) ?>';
            } else {
                // Tunjuk ralat tanpa sebarang refresh
                boxRalat.classList.remove('d-none');
            }
        });
    </script>
</body>
</html>
