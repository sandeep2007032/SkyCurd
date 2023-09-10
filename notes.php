<?php
require_once "connect.php"; // Include the database connection file

session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

// Retrieve the user's notes from the database
$userId = $_SESSION['user_id'];
$sql = "SELECT * FROM notes WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();

$notes = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $notes[] = $row;
    }
}

// Handle note creation
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_note'])) {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO notes (user_id, title, content) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $userId, $title, $content);

    if ($stmt->execute()) {
        header('Location: notes.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle note deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_note'])) {
    $noteId = $_POST['note_id'];

    $sql = "DELETE FROM notes WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $noteId, $userId);

    if ($stmt->execute()) {
        header('Location: notes.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Handle note update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_note'])) {
    $noteId = $_POST['note_id'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "UPDATE notes SET title = ?, content = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $title, $content, $noteId, $userId);

    if ($stmt->execute()) {
        header('Location: notes.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Notes</title>

    <style>
        /* CSS styles for the form container */
        .container {
            max-width: 800px; /* Adjust the width as needed */
            margin: 0 auto;
            padding: 20px;
        }

        /* CSS styles for the form inputs */
        .container input[type="text"],
        .container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* CSS styles for the form button */
        .container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        /* CSS styles for the form button on hover */
        .container button:hover {
            background-color: #45a049;
        }

        /* CSS styles for note items */
        .note-item {
            border: 1px solid #ccc;
            border-radius: 4px;
            margin: 10px 0;
            padding: 10px;
        }
    </style>
</head>

<body>
<h2>Welcome, <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Guest'; ?></h2>

<div class="container">
    <h3>Create Note</h3>
    <form action="notes.php" method="POST">
        <input type="hidden" name="note_id" value="">
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Content" required></textarea><br>
        <button type="submit" name="create_note">Create</button>
    </form>
</div>

<h3>My Notes</h3>
<?php if (count($notes) > 0) : ?>
    <ul>
        <?php foreach ($notes as $note) : ?>
            <li class="note-item">
                <form action="notes.php" method="POST">
                    <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                    <input type="text" name="title" value="<?php echo $note['title']; ?>">
                    <textarea name="content"><?php echo $note['content']; ?></textarea>
                    <button type="submit" name="update_note">Update</button>
                    <button type="submit" name="delete_note">Delete</button>
                </form>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else : ?>
    <p>No notes found.</p>
<?php endif; ?>

<a href="logout.php">Logout</a>
</body>
</html>
