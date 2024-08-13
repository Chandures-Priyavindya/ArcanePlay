<?php
session_start();

// Define the choices
$choices = ["rock", "paper", "scissors"];

// Initialize result message
$result = "";

// Check if the user has made a choice
if (isset($_POST['user_choice'])) {
    $user_choice = $_POST['user_choice'];
    $computer_choice = $choices[array_rand($choices)];

    // Determine the winner
    if ($user_choice == $computer_choice) {
        $result = "It's a tie! You both chose $user_choice.";
    } elseif (
        ($user_choice == "rock" && $computer_choice == "scissors") ||
        ($user_choice == "paper" && $computer_choice == "rock") ||
        ($user_choice == "scissors" && $computer_choice == "paper")
    ) {
        $result = "You win! $user_choice beats $computer_choice.";
    } else {
        $result = "You lose! $computer_choice beats $user_choice.";
    }
}
?>
<?php if ($result != ""): ?>
        <h2><?php echo $result; ?></h2>
        <a href="rock_paper_scissors.php" class="button">Play Again</a>
    <?php endif; ?>