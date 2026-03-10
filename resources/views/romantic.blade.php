<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untuk Kamu ❤️</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@700&family=Quicksand:wght@400;600&display=swap"
        rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #ff9a9e 0%, #fad0c4 99%, #fad0c4 100%);
            font-family: 'Quicksand', sans-serif;
            overflow: hidden;
            position: relative;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.8);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            z-index: 10;
            max-width: 90%;
            width: 400px;
            backdrop-filter: blur(5px);
        }

        h1 {
            font-family: 'Dancing Script', cursive;
            color: #d63384;
            font-size: 3.5rem;
            margin-bottom: 10px;
            margin-top: 0;
        }

        p {
            color: #555;
            font-size: 1.1rem;
            line-height: 1.6;
            margin-bottom: 30px;
            min-height: 60px;
            /* Menjaga tinggi agar tidak lompat saat mengetik */
        }

        .heart-btn {
            background-color: #ff4757;
            color: white;
            border: none;
            padding: 15px 30px;
            font-size: 1.2rem;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            font-family: 'Quicksand', sans-serif;
            font-weight: 600;
        }

        .heart-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.4);
        }

        /* Animasi Hati Background */
        .bg-heart {
            position: absolute;
            top: -10vh;
            background: rgba(255, 255, 255, 0.3);
            width: 20px;
            height: 20px;
            transform: rotate(45deg);
            animation: fall linear infinite;
            z-index: 1;
        }

        .bg-heart::before,
        .bg-heart::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            background: inherit;
            border-radius: 50%;
        }

        .bg-heart::before {
            top: -10px;
            left: 0;
        }

        .bg-heart::after {
            top: 0;
            left: -10px;
        }

        @keyframes fall {
            0% {
                transform: translateY(-10vh) rotate(45deg) scale(0.5);
                opacity: 1;
            }

            100% {
                transform: translateY(110vh) rotate(45deg) scale(1);
                opacity: 0;
            }
        }

        /* Hidden Message */
        .hidden-msg {
            display: none;
            margin-top: 20px;
            color: #d63384;
            font-weight: bold;
            animation: fadeIn 1s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Animasi Bunga */
        .flower {
            position: absolute;
            bottom: -10vh;
            font-size: 2rem;
            animation: floatUp linear forwards;
            z-index: 5;
        }

        @keyframes floatUp {
            0% {
                transform: translateY(0) rotate(0deg) scale(0.5);
                opacity: 1;
            }

            100% {
                transform: translateY(-110vh) rotate(360deg) scale(1.5);
                opacity: 0;
            }
        }

        /* Special Page Styles */
        .special-container {
            display: none;
            text-align: center;
            z-index: 20;
        }

        .big-flower {
            font-size: 10rem;
            animation: bloomEffect 3s ease-out forwards;
        }

        .name-text {
            font-family: 'Dancing Script', cursive;
            font-size: 4rem;
            color: #d63384;
            animation: fadeIn 4s;
        }

        @keyframes bloomEffect {
            0% {
                transform: scale(0);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Hai Sayang...</h1>
        <p id="typing-text"></p>
        <button class="heart-btn" onclick="showLove()">Klik Aku ❤️</button>
        <div class="hidden-msg" id="secret-msg">
            Aku cuma mau bilang, aku beruntung banget punya kamu. <br> I Love You! 🌹
        </div>
    </div>

    <div class="special-container" id="special-page">
        <div class="big-flower">🌹</div>
        <div class="name-text">Deviranti Aku Sayang Kamu❤️</div>
    </div>

    <script>
        // Efek Mengetik
        const text = "Ada sesuatu yang ingin aku sampaikan kepadamu hari ini...";
        const typingElement = document.getElementById('typing-text');
        let index = 0;

        function typeWriter() {
            if (index < text.length) {
                typingElement.innerHTML += text.charAt(index);
                index++;
                setTimeout(typeWriter, 50);
            }
        }

        // Jalankan efek mengetik saat halaman dimuat
        window.onload = typeWriter;

        // Fungsi Tombol
        function showLove() {
            document.querySelector('.container').style.display = 'none';
            document.getElementById('special-page').style.display = 'block';
            createBurstHearts();
            createBurstFlowers();
        }

        // Membuat Hati Berjatuhan di Background
        function createHeart() {
            const heart = document.createElement('div');
            heart.classList.add('bg-heart');
            heart.style.left = Math.random() * 100 + 'vw';
            heart.style.animationDuration = Math.random() * 3 + 2 + 's';
            heart.style.width = Math.random() * 20 + 10 + 'px';
            heart.style.height = heart.style.width;

            // Update pseudo elements size via cssText or simple logic (simplified here relies on inherit)

            document.body.appendChild(heart);

            setTimeout(() => {
                heart.remove();
            }, 5000);
        }

        setInterval(createHeart, 300);

        // Efek ledakan hati saat tombol diklik
        function createBurstHearts() {
            for (let i = 0; i < 30; i++) {
                setTimeout(createHeart, i * 50);
            }
        }

        // Fungsi Bunga
        function createFlower() {
            const flowers = ['🌹', '🌸', '🌺', '🌻', '🌷', '💐'];
            const flower = document.createElement('div');
            flower.classList.add('flower');
            flower.innerText = flowers[Math.floor(Math.random() * flowers.length)];
            flower.style.left = Math.random() * 100 + 'vw';
            flower.style.animationDuration = Math.random() * 3 + 2 + 's';
            document.body.appendChild(flower);

            setTimeout(() => {
                flower.remove();
            }, 5000);
        }

        function createBurstFlowers() {
            for (let i = 0; i < 40; i++) {
                setTimeout(createFlower, i * 100);
            }
        }
    </script>
</body>

</html>
