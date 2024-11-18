<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $quiz->judul }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .container {
            max-width: 800px;
        }

        .exam-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 2rem 1rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .exam-title {
            margin: 0;
            font-size: 2rem;
            font-weight: 600;
        }

        #timer {
            background-color: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 5px;
            margin-top: 1rem;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .question-card {
            background: white;
            border-radius: 10px;
            padding: 2rem;
            margin: 1.5rem 0;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            border: 1px solid rgba(0, 0, 0, 0.08);
        }

        .question-number {
            color: #6c757d;
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 1rem;
        }

        .question-text {
            font-size: 1.2rem;
            color: #2d3436;
            margin-bottom: 1.5rem;
            font-weight: 500;
        }

        .form-check {
            margin: 1rem 0;
            padding: 0.8rem 1.8rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .form-check:hover {
            background-color: #f8f9fa;
            transform: translateX(5px);
        }

        .essay-answer {
            margin-top: 1rem;
        }

        .essay-answer textarea {
            width: 100%;
            min-height: 150px;
            padding: 1rem;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            resize: vertical;
        }

        .navigation-buttons {
            display: flex;
            gap: 1rem;
            margin: 2rem 0;
        }

        .btn-nav {
            flex: 1;
            padding: 0.8rem 1.5rem;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }

        .btn-nav:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-submit {
            background: linear-gradient(135deg, #84fab0 0%, #8fd3f4 100%);
            border: none;
            padding: 1rem 2rem;
            font-weight: 600;
            letter-spacing: 1px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .question-navigation {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin: 1rem 0;
            justify-content: center;
        }

        .question-nav-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: #e9ecef;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .question-nav-btn.answered {
            background: #28a745;
            color: white;
        }

        .question-nav-btn.current {
            background: #007bff;
            color: white;
        }

        @media (max-width: 576px) {
            .navigation-buttons {
                flex-direction: column;
            }

            .btn-nav {
                width: 100%;
            }

            .exam-header {
                padding: 1.5rem 1rem;
            }

            .question-card {
                padding: 1.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="container my-4">
        <div class="exam-header text-center">
            <h2 class="exam-title">{{ $quiz->judul }}</h2>
            <div id="timer"></div>
        </div>

        <div class="question-navigation" id="questionNavigation">
            @foreach($quiz->soal as $index => $question)
            <button class="question-nav-btn" onclick="jumpToQuestion({{ $index }})" id="navBtn{{ $index }}">
                {{ $index + 1 }}
            </button>
            @endforeach
        </div>

        <div id="questionContainer" class="question-card">
            <!-- Question content will be dynamically inserted here -->
        </div>

        <div class="navigation-buttons">
            <button class="btn btn-secondary btn-nav" id="prevBtn" onclick="navigateQuestion(-1)"
                style="display: none;">
                Soal Sebelumnya
            </button>
            <button class="btn btn-primary btn-nav" id="nextBtn" onclick="navigateQuestion(1)" style="display: none;">
                Soal Berikutnya
            </button>
        </div>

        <div class="text-center">
            <button class="btn btn-submit" id="submitBtn" onclick="submitExam()" style="display: none;">Kumpulkan
                Jawaban</button>
        </div>
    </div>

    <script>
        const quiz = @json($quiz);
        let currentQuestionIndex = 0;
        let userAnswers = Array(quiz.soal.length).fill(null);
        let timer;
        let timeRemaining = {{ \Carbon\Carbon::parse($quiz->tanggal_selesai)->diffInSeconds(now()) }};

        function displayQuestion(index) {
            const questionContainer = document.getElementById("questionContainer");
            const question = quiz.soal[index];

            let questionHTML = `
                <div class="question-number">Soal ${index + 1} dari ${quiz.soal.length}</div>
                <div class="question-text">${question.pertanyaan}</div>
            `;

            if (question.kategori_soal === "single_choice" || question.kategori_soal === "multiple_choice") {
                questionHTML += question.jawaban.map((option, i) => `
                    <div class="form-check">
                        <input class="form-check-input" type="${question.kategori_soal === 'single_choice' ? 'radio' : 'checkbox'}"
                            name="answer" id="option${i}" value="${i}" ${userAnswers[index] && userAnswers[index].includes(i) ? "checked" : ""}>
                        <label class="form-check-label" for="option${i}">${option.jawaban}</label>
                    </div>
                `).join("");
            } else if (question.kategori_soal === "essay") {
                questionHTML += `
                    <div class="essay-answer">
                        <textarea class="form-control" placeholder="Tulis jawaban Anda di sini...">${userAnswers[index] || ''}</textarea>
                    </div>
                `;
            }

            questionContainer.innerHTML = questionHTML;
            updateNavigationButtons();
        }


        function updateNavigationButtons() {
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submitBtn');

            // Show/hide previous button
            if (currentQuestionIndex > 0) {
                prevBtn.style.display = 'inline-block';
            } else {
                prevBtn.style.display = 'none';
            }

            // Show/hide next button and submit button
            if (currentQuestionIndex < quiz.soal.length - 1) {
                nextBtn.style.display = 'inline-block';
                submitBtn.style.display = 'none';
            } else {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-block';
            }

            // Update navigation buttons
            quiz.soal.forEach((_, index) => {
                const btn = document.getElementById(`navBtn${index}`);
                btn.classList.remove('current', 'answered');
                if (index === currentQuestionIndex) {
                    btn.classList.add('current');
                }
                if (userAnswers[index] !== null) {
                    btn.classList.add('answered');
                }
            });
        }

        function jumpToQuestion(index) {
            saveAnswer();
            currentQuestionIndex = index;
            displayQuestion(currentQuestionIndex);
        }

        function navigateQuestion(step) {
            saveAnswer();
            currentQuestionIndex += step;
            if (currentQuestionIndex < 0) currentQuestionIndex = 0; 
            if (currentQuestionIndex >= quiz.soal.length) currentQuestionIndex = quiz.soal.length - 1;
            displayQuestion(currentQuestionIndex);
        }

        function saveAnswer() {
            const question = quiz.soal[currentQuestionIndex];
            if (question.kategori_soal === "single_choice") {
                const answer = document.querySelector("input[name='answer']:checked");
                if (answer) {
                    userAnswers[currentQuestionIndex] = [parseInt(answer.value)];
                } else {
                    userAnswers[currentQuestionIndex] = null;
                }
            } else if (question.kategori_soal === "multiple_choice") {
                const answers = document.querySelectorAll("input[name='answer']:checked");
                const selectedAnswers = Array.from(answers).map(answer => parseInt(answer.value));
                userAnswers[currentQuestionIndex] = selectedAnswers;
            } else if (question.kategori_soal === "essay") {
                const answer = document.querySelector("textarea");
                if (answer) {
                    userAnswers[currentQuestionIndex] = answer.value;
                } else {
                    userAnswers[currentQuestionIndex] = null;
                }
            }
        }


        function submitExam() {
            saveAnswer();

            const unansweredQuestions = userAnswers.filter(answer => answer === null || (Array.isArray(answer) && answer.length === 0)).length;
            
            if (unansweredQuestions > 0) {
                if (!confirm(`Anda masih memiliki ${unansweredQuestions} soal yang belum dijawab. Yakin ingin mengumpulkan?`)) {
                    return;
                }
            }
            
            // Prepare the data to be sent to the server
            const submissionData = {
                answers: quiz.soal.map((question, index) => ({
                    soal_id: question.id,
                    jawaban: userAnswers[index]
                }))
            };
            
            // Send the data to the server
            fetch(`/kuis/{{$quizAttemptId}}/submit`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify(submissionData)
            })
            .then(response => response.json())
            .then(data => {
                alert("Ujian telah berhasil dikumpulkan!");
                window.location.href = '{{ route('exam.page', $quiz->id) }}';
            })
            .catch(error => {
                console.error('Error:', error);
                alert("Terjadi kesalahan saat mengumpulkan ujian. Silakan coba lagi.");
            });
        }




        function updateTimer() {
            timeRemaining--;
            const hours = Math.floor(timeRemaining / 3600);
            const minutes = Math.floor((timeRemaining % 3600) / 60);
            const seconds = timeRemaining % 60;
            const timerElement = document.getElementById("timer");
            timerElement.textContent = `Waktu tersisa: ${hours.toString().padStart(2, '0')} jam ${minutes.toString().padStart(2, '0')} menit ${seconds.toString().padStart(2, '0')} detik`;

            if (timeRemaining === 0) {
                submitExam();
                clearInterval(timer);
            }
        }

        function startTimer() {
            timer = setInterval(updateTimer, 1000);
        }

        // Initialize
        displayQuestion(currentQuestionIndex);
        startTimer();
    </script>
</body>

</html>