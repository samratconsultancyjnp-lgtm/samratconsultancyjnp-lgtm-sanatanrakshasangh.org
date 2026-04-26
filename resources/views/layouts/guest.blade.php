<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script src="https://unpkg.com/alpinejs" defer></script>
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-6" style="background: linear-gradient(135deg, #ff9933 0%, #2d1b00 100%); background-attachment: fixed;">
            <div class="w-full sm:max-w-4xl bg-white shadow-2xl overflow-hidden sm:rounded-3xl flex flex-col md:flex-row min-h-[600px] border border-white/20">
                <!-- Left Side: Branding & Info -->
                <div class="md:w-1/2 relative hidden md:block" style="background: linear-gradient(rgba(45, 27, 0, 0.6), rgba(45, 27, 0, 0.6)), url('https://images.unsplash.com/photo-1544006659-f0b21f04cb1d?auto=format&fit=crop&w=800&q=80'); background-size: cover; background-position: center;">
                    <div class="absolute inset-0 flex flex-col justify-center items-center text-white p-12 text-center">
                        <div style="background: white; padding: 20px; border-radius: 50%; margin-bottom: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.3);">
                            <i class="fas fa-om" style="font-size: 4rem; color: #ff9933;"></i>
                        </div>
                        <h1 class="text-4xl font-extrabold uppercase tracking-widest mb-4">Sanatan Raksha Sangh</h1>
                        <div class="w-20 h-1 bg-[#ff9933] mb-6"></div>
                        <p class="text-lg opacity-90 font-medium leading-relaxed">
                            Dedicated to the preservation of our heritage and the upliftment of society through unity and selfless service.
                        </p>
                    </div>
                </div>

                <!-- Right Side: Login Form -->
                <div class="w-full md:w-1/2 p-10 md:p-16 bg-white flex flex-col justify-center">
                    <div class="md:hidden flex flex-col items-center mb-8">
                        <div style="background: #ff9933; padding: 12px; border-radius: 50%;">
                            <i class="fas fa-om text-white text-2xl"></i>
                        </div>
                        <h2 class="text-xl font-bold mt-2 text-[#2d1b00]">Sanatan Raksha Sangh</h2>
                    </div>
                    
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
                    {{ $slot }}
                </div>
            </div>
            
            <div class="mt-8 text-white/60 text-sm">
                &copy; {{ date('Y') }} Sanatan Raksha Sangh. All rights reserved.
            </div>
        </div>
            
            <div class="mt-8 text-white/60 text-sm">
                &copy; {{ date('Y') }} Sanatan Raksha Sangh. All rights reserved.
            </div>
        </div>
    </body>
</html>
