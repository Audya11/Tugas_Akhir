<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Sekolah</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="row justify-content-center align-items-center" style="height: 100vh">
    
    <div class="card" style="display: flex; flex-direction: row; max-width: 900px; width: 100%; border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
        
        <!-- Bagian Gambar -->
        <img src="/img/kurikulum.png" alt="Login Image" style="width: 50%; object-fit: cover;">
        <!-- Bagian Form -->
        <div style="padding: 40px; width: 50%;">
            @if (session('loginError'))
            <div class="alert alert-danger" role="alert">
                {{ session('loginError') }}
            </div>
        @endif
            <h3 style="margin-bottom: 20px; font-size: 1.5rem; font-weight: 600; color: #333;">Login</h3>
            <form action="/school/login" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email" style="font-weight: 500; color: #555;">Email address</label>
                    <input type="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror"  id="email" name="email" >
                    @error('email')
                        <div class="invalid-feedback" >
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password" style="font-weight: 500; color: #555;">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block" style="background-color: #007bff; border-color: #007bff;">Login</button>
                {{-- <div class="forgot-password" style="margin-top: 10px; font-size: 0.875rem;">
                    <a href="{{ route('password.request') }}" style="color: #007bff; text-decoration: none;">Forgot your password?</a>
                </div> --}}
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
