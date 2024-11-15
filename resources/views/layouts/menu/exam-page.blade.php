<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ujian Pilihan Ganda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .question-card {
            margin: 10px 0;
        }
        .question-number {
            font-weight: bold;
        }
        .option-label {
            width: 100%;
            cursor: pointer;
        }
        .btn-nav {
            width: 48%;
        }
        @media (max-width: 576px) {
            .btn-nav {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="container my-4">
        <h2 class="text-center">Ujian Pilihan Ganda</h2>
        <div id="questionContainer" class="question-card bg-light p-3 rounded shadow-sm">
            <!-- Pertanyaan akan ditampilkan di sini -->
        </div>
        <div class="d-flex justify-content-between mt-3">
            <button class="btn btn-secondary btn-nav" id="prevBtn" onclick="navigateQuestion(-1)">Soal Sebelumnya</button>
            <button class="btn btn-primary btn-nav" id="nextBtn" onclick="navigateQuestion(1)">Soal Berikutnya</button>
        </div>
        <div class="text-center mt-3">
            <button class="btn btn-success" onclick="submitExam()">Kumpulkan OpsiJawaban</button>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        // Soal ujian (bisa disesuaikan)
        const questions = [
            {
                question: "Apa ibu kota Indonesia?",
                options: ["Jakarta", "Bandung", "Surabaya", "Medan"],
                correctAnswer: 0
            },
            {
                question: "Siapa penemu lampu pijar?",
                options: ["Nikola Tesla", "Thomas Edison", "Alexander Graham Bell", "Albert Einstein"],
                correctAnswer: 1
            },
            {
                question: "Hewan apa yang tercepat di darat?",
                options: ["Gajah", "Kuda", "Cheetah", "Singa"],
                correctAnswer: 2
            },
        ];

        let currentQuestionIndex = 0;
        let userAnswers = Array(questions.length).fill(null); // Array untuk menyimpan jawaban pengguna

        // Fungsi untuk menampilkan soal
        function displayQuestion(index) {
            const questionContainer = document.getElementById("questionContainer");
            const question = questions[index];
            questionContainer.innerHTML = `
                <p class="question-number">Soal ${index + 1}/${questions.length}</p>
                <p>${question.question}</p>
                ${question.options.map((option, i) => `
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="answer" id="option${i}" value="${i}" 
                            ${userAnswers[index] === i ? "checked" : ""}>
                        <label class="form-check-label option-label" for="option${i}">${option}</label>
                    </div>
                `).join("")}
            `;
        }

        // Fungsi navigasi soal berikutnya dan sebelumnya
        function navigateQuestion(step) {
            saveAnswer(); // Simpan jawaban sebelum pindah soal
            currentQuestionIndex += step;
            if (currentQuestionIndex < 0) currentQuestionIndex = 0;
            if (currentQuestionIndex >= questions.length) currentQuestionIndex = questions.length - 1;
            displayQuestion(currentQuestionIndex);
            toggleButtons();
        }

        // Fungsi untuk menyimpan jawaban pengguna
        function saveAnswer() {
            const answer = document.querySelector("input[name='answer']:checked");
            if (answer) userAnswers[currentQuestionIndex] = parseInt(answer.value);
        }

        // Tampilkan/hide tombol "Soal Sebelumnya" dan "Soal Berikutnya"
        function toggleButtons() {
            document.getElementById("prevBtn").style.display = currentQuestionIndex === 0 ? "none" : "inline-block";
            document.getElementById("nextBtn").style.display = currentQuestionIndex === questions.length - 1 ? "none" : "inline-block";
        }

        // Fungsi untuk mengirimkan jawaban
        function submitExam() {
            saveAnswer(); // Simpan jawaban terakhir
            let score = 0;
            userAnswers.forEach((answer, i) => {
                if (answer === questions[i].correctAnswer) score++;
            });
            alert(`Ujian selesai! Skor Anda: ${score} dari ${questions.length}`);
        }

        // Inisialisasi tampilan soal pertama
        displayQuestion(currentQuestionIndex);
        toggleButtons();
    </script>
</body>
</html>
