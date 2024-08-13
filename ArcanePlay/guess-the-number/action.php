<?php
session_start();

// Generate a random number if it doesn't exist
if (!isset($_SESSION['randomNumber'])) {
    $_SESSION['randomNumber'] = rand(1, 100);
    $_SESSION['attempts'] = 0; // Initialize attempt counter
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guess = intval($_POST['guess']);
    $randomNumber = $_SESSION['randomNumber'];
    $_SESSION['attempts']++; // Increment attempts on each submission

    if ($guess < $randomNumber) {
        $message = "Too low! Try again.";
    } elseif ($guess > $randomNumber) {
        $message = "Too high! Try again.";
    } else {
        $message = "Congratulations! You guessed the number $randomNumber in {$_SESSION['attempts']} attempts. <a href='?reset=1'>Play again</a>";
        unset($_SESSION['randomNumber']);
        unset($_SESSION['attempts']); // Reset attempts counter
    }
}

// Handle game reset
if (isset($_GET['reset'])) {
    unset($_SESSION['randomNumber']);
    unset($_SESSION['attempts']);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
?>
<?php if (isset($message)): ?>
        <p><?php echo $message; ?></p>
    <?php endif; ?>