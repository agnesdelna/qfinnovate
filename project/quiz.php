<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Application</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .centered {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .quiz-container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="centered">
        <div class="quiz-container">
            <div id="question-container">
                <div id="question">Question text</div>
                <div id="answer-buttons" class="btn-group">
                    <button class="btn">Answer 1</button>
                    <button class="btn">Answer 2</button>
                    <button class="btn">Answer 3</button>
                    <button class="btn">Answer 4</button>
                </div>
            </div>
            <button id="next-button" class="btn next-btn">Next</button>
        </div>
    </div>
    <script src="scripts.jsx"></script>
   
<?php
session_start();

// Questions array
$questions = [
    [
        "question" => "What is the capital of France?",
        "answers" => [
            ["text" => "Paris", "correct" => true],
            ["text" => "London", "correct" => false],
            ["text" => "Rome", "correct" => false],
            ["text" => "Madrid", "correct" => false]
        ]
    ],
    [
        "question" => "Who wrote 'To Kill a Mockingbird'?",
        "answers" => [
            ["text" => "Harper Lee", "correct" => true],
            ["text" => "J.K. Rowling", "correct" => false],
            ["text" => "Ernest Hemingway", "correct" => false],
            ["text" => "Mark Twain", "correct" => false]
        ]
    ],
    [
        "question" => "What is the chemical symbol for water?",
        "answers" => [
            ["text" => "H2O", "correct" => true],
            ["text" => "O2", "correct" => false],
            ["text" => "CO2", "correct" => false],
            ["text" => "H2O2", "correct" => false]
        ]
    ],
    [
        "question" => "Who painted the Mona Lisa?",
        "answers" => [
            ["text" => "Vincent van Gogh", "correct" => false],
            ["text" => "Pablo Picasso", "correct" => false],
            ["text" => "Leonardo da Vinci", "correct" => true],
            ["text" => "Michelangelo", "correct" => false]
        ]
    ],
    [
        "question" => "What is the largest planet in our solar system?",
        "answers" => [
            ["text" => "Earth", "correct" => false],
            ["text" => "Mars", "correct" => false],
            ["text" => "Jupiter", "correct" => true],
            ["text" => "Saturn", "correct" => false]
        ]
    ]
];

// Initialize quiz state
if (!isset($_SESSION['currentQuestionIndex'])) {
    $_SESSION['currentQuestionIndex'] = 0;
    $_SESSION['score'] = 0;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['answer'])) {
    $selectedAnswer = $_POST['answer'];
    $correctAnswer = $questions[$_SESSION['currentQuestionIndex']]['answers'][$selectedAnswer]['correct'];

    if ($correctAnswer) {
        $_SESSION['score']++;
    }

    $_SESSION['currentQuestionIndex']++;

    // Check if quiz is finished
    if ($_SESSION['currentQuestionIndex'] >= count($questions)) {
        $score = $_SESSION['score'];
        $totalQuestions = count($questions);

        // Reset session for new game
        session_destroy();
?>
        <div class='result'>Quiz Finished! Score: <?php echo $score; ?> / <?php echo $totalQuestions; ?></div>
        <form method='post'><button type='submit'>Restart Quiz</button></form>
<?php
        exit();
    }
}
?>
</body>
</html>
