<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Panel Administrasi</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        emerald: {
                            50: '#ecfdf5',
                            100: '#d1fae5',
                            500: '#10b981',
                            600: '#059669',
                            700: '#047857',
                            800: '#065f46',
                            900: '#064e3b',
                        }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-900 text-slate-100 min-h-screen flex items-center justify-center p-4">

    <div class="w-full max-w-md bg-slate-800 rounded-2xl shadow-2xl border border-slate-700/50 p-8 space-y-6">
        
        <!-- Header / Logo -->
        <div class="text-center space-y-2">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-2xl bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 mb-2">
                <i class="fa-solid fa-school text-3xl"></i>
            </div>
            <h2 class="text-2xl font-bold tracking-tight text-white">Panel Administrasi</h2>
            <p class="text-sm text-slate-400">Silakan masuk ke akun Anda</p>
        </div>

        <!-- Alert Error General -->
        @if(session('error'))
            <div class="p-4 bg-red-500/10 border border-red-500/30 text-red-400 text-sm rounded-xl flex items-center gap-3">
                <i class="fa-solid fa-circle-exclamation text-lg flex-shrink-0"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <form action="{{ route('proses.login') }}" method="POST" class="space-y-5">
            @csrf

            <!-- Form Group: Role -->
            <div>
                <label for="role" class="block text-sm font-medium text-slate-300 mb-1.5">Masuk Sebagai</label>
                <div class="relative">
                    <select id="role" name="role" required 
                        class="w-full bg-slate-900/80 border border-slate-700 text-white rounded-xl px-4 py-3 pl-11 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition appearance-none cursor-pointer">
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="operator" {{ old('role') == 'operator' ? 'selected' : '' }}>Operator</option>
                    </select>
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-user-shield"></i>
                    </div>
                    <div class="absolute inset-y-0 right-0 pr-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-chevron-down text-xs"></i>
                    </div>
                </div>
            </div>

            <!-- Form Group: Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-slate-300 mb-1.5">Alamat Email</label>
                <div class="relative">
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required placeholder="nama@sekolah.sch.id"
                        class="w-full bg-slate-900/80 border @error('email') border-red-500 @else border-slate-700 @enderror text-white rounded-xl px-4 py-3 pl-11 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition placeholder:text-slate-500">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-regular fa-envelope"></i>
                    </div>
                </div>
                @error('email')
                    <p class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Form Group: Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-slate-300 mb-1.5">Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required placeholder="••••••••"
                        class="w-full bg-slate-900/80 border @error('password') border-red-500 @else border-slate-700 @enderror text-white rounded-xl px-4 py-3 pl-11 focus:outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500 transition placeholder:text-slate-500">
                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                        <i class="fa-solid fa-lock"></i>
                    </div>
                </div>
                @error('password')
                    <p class="mt-1.5 text-xs text-red-400 flex items-center gap-1">
                        <i class="fa-solid fa-circle-exclamation"></i> {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Button Submit -->
            <button type="submit" 
                class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-semibold py-3 px-4 rounded-xl shadow-lg shadow-emerald-900/30 transition duration-200 flex items-center justify-center gap-2">
                <i class="fa-solid fa-right-to-bracket"></i>
                <span>Masuk Aplikasi</span>
            </button>
        </form>

        <!-- Footer Link -->
        <div class="text-center pt-2">
            <a href="/" class="text-sm text-slate-400 hover:text-emerald-400 transition inline-flex items-center gap-2">
                <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Beranda
            </a>
        </div>

    </div>

</body>
</html>