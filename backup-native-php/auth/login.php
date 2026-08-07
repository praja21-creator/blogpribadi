<?php

require '../config/database.php';
require '../layouts/header.php';

?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header text-center py-4">
                    <h2 class="mb-0"><i class="fas fa-sign-in-alt"></i> Login ke Akun Anda</h2>
                </div>
                <div class="card-body p-4">
                    
                    <?php if(isset($_GET['error'])): ?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <i class="fas fa-exclamation-circle"></i> <?= $_GET['error']; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form action="process.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-envelope"></i> akun
                            </label>
                            <input type="name" class="form-control" id="name" name="name" placeholder="Masukkan nama Anda" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="password" class="form-label">
                                <i class="fas fa-lock"></i> Password
                            </label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password Anda" required>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="remember" name="remember">
                            <label class="form-check-label" for="remember">
                                Ingat saya
                            </label>
                        </div>
                        
                        <button type="submit" class="btn btn-primary w-100 py-2">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </form>

                    <hr class="my-4">
                    <p class="text-center text-muted">
                        Belum punya akun? <a href="#" class="text-primary">Daftar di sini</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../layouts/footer.php'; ?>
