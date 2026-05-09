<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pendaftaran Mahasiswa Baru</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            overflow: hidden;
            height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .emoji-header {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 3vh 0;
            background: linear-gradient(135deg, #1a1a1a 0%, #333 100%);
            cursor: pointer;
            flex-shrink: 0;
        }

        .face {
            position: relative;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: #ffcd00;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 20px 40px rgba(0,0,0,0.3);
        }

        @media (min-height: 700px) {
            .face { width: 300px; height: 300px; }
        }

        .face::before {
            content: '';
            position: absolute;
            top: 60%;
            width: 150px;
            height: 70px;
            background: #b57700;
            border-bottom-left-radius: 70px;
            border-bottom-right-radius: 70px;
            transition: 0.5s;
        }

        .face:hover::before {
            top: 70%;
            width: 150px;
            height: 20px;
            border-bottom-left-radius: 0px;
            border-bottom-right-radius: 0px;
        }

        .eyes {
            position: relative;
            top: -40px;
            display: flex;
        }

        .eyes .eye {
            position: relative;
            width: 70px;
            height: 70px;
            display: block;
            background: #fff;
            margin: 0 15px;
            border-radius: 50%;
            overflow: hidden;
        }

        .eyes .eye::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 25px;
            transform: translate(-50%, -50%);
            width: 35px;
            height: 35px;
            background: #333;
            border-radius: 50%;
        }

        .responsive-title {
            font-size: clamp(1.2rem, 5vh, 3.5rem);
            line-height: 1.1;
        }

        .responsive-subtitle {
            font-size: clamp(0.8rem, 2vh, 1.1rem);
        }

        /* Custom Transition Speed */
        .animate__animated.animate__bounceIn {
            --animate-duration: 1.2s;
        }
    </style>
</head>

<body>

    <div class="emoji-header">
        <div class="face animate__animated animate__bounceInDown">
            <div class="eyes">
                <div class="eye"></div>
                <div class="eye"></div>
            </div>
        </div>
    </div>

    <main class="flex-grow p-4 flex flex-col items-center justify-between bg-white text-center overflow-hidden">
        <div class="mt-2"></div>

        <div class="animate__animated animate__fadeInUp px-4">
            <h2 class="responsive-title font-extrabold text-gray-900 mb-2 uppercase tracking-tighter">
                SISTEM REKAP MAHASISWA BARU TA 2025/2026
            </h2>
            <p class="responsive-subtitle text-gray-500 max-w-lg mx-auto">
                Sistem Rekap Data Mahasiswa Baru Memudahkan Anda Dalam merekap data
            </p>
            <p class="responsive-subtitle text-gray-500 max-w-lg mx-auto">
                Rekap cepat data tepat, hati senang fikiran tenang
            </p>
        </div>

        <!-- Tombol dengan Animasi Masuk dan Keluar -->
        <div class="mb-12 md:mb-16"> 
    <button id="btnStart" class="animate__animated animate__bounceIn bg-yellow-500 hover:bg-yellow-600 text-black font-bold py-4 px-12 rounded-full shadow-lg transform transition hover:scale-110 active:scale-95">
        MULAI SEKARANG
    </button>
</div>
    </main>

    <script>
        // Animasi Mata Mengikuti Mouse
        document.addEventListener('mousemove', (event) => {
            const eyes = document.querySelectorAll('.eye');
            eyes.forEach(eye => {
                const rect = eye.getBoundingClientRect();
                const x = rect.left + rect.width / 2;
                const y = rect.top + rect.height / 2;
                
                const rad = Math.atan2(event.pageX - x, event.pageY - y);
                const rot = (rad * (180 / Math.PI) * -1) + 270;
                
                eye.style.transform = `rotate(${rot}deg)`;
            });
        });

        // Logika Animasi Keluar Tombol dan Navigasi
        const btn = document.getElementById('btnStart');
        
        btn.addEventListener('click', function() {
            // 1. Tambahkan animasi keluar
            this.classList.remove('animate__bounceIn');
            this.classList.add('animate__backOutDown'); // Efek keluar ke bawah yang halus

            // 2. Tunggu animasi selesai (sekitar 500-700ms) sebelum pindah halaman
            setTimeout(() => {
                // Mengarahkan ke rute Laravel 'pendaftaran.index'
                // Jika file ini adalah file .blade.php, gunakan:
                window.location.href = "{{ route('pendaftaran.index') }}";
                
                // Jika ini file HTML murni atau tidak di dalam Laravel, gunakan path manual:
                // window.location.href = "/pendaftaran";
            }, 600);
        });
    </script>
</body>
</html>