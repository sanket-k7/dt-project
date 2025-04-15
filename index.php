<?php
// Handle form submission before HTML output
$mailSent = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $to = "your-email@example.com"; // <-- 🔁 Replace this with your actual email address

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $category = htmlspecialchars($_POST['category']);
    $message = htmlspecialchars($_POST['message']);

    $subject = "New Complaint - Smart Bus Stand";
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    $body = "You received a new complaint:\n\n";
    $body .= "Name: $name\n";
    $body .= "Email: $email\n";
    $body .= "Category: $category\n\n";
    $body .= "Message:\n$message\n";

    $mailSent = mail($to, $subject, $body, $headers);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Smart Bus Stand - Complaint Form</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0faff;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 500px;
      background: white;
      margin: 50px auto;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    h2 {
      text-align: center;
      color: #0077cc;
    }
    label {
      display: block;
      margin-top: 15px;
      font-weight: bold;
    }
    input, select, textarea {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    button {
      margin-top: 20px;
      width: 100%;
      padding: 12px;
      background: #0077cc;
      color: white;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    button:hover {
      background: #005fa3;
    }
    .message {
      text-align: center;
      font-weight: bold;
      margin-top: 20px;
    }
    .success {
      color: green;
    }
    .error {
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Smart Bus Stand - Complaint Form</h2>

    <?php if ($mailSent !== null): ?>
      <div class="message <?php echo $mailSent ? 'success' : 'error'; ?>">
        <?php echo $mailSent ? '✅ Complaint submitted successfully. Thank you!' : '❌ Error sending complaint. Please try again later.'; ?>
      </div>
    <?php endif; ?>

    <form method="POST" action="">
      <label for="name">Name</label>
      <input type="text" name="name" required>

      <label for="email">Email</label>
      <input type="email" name="email" required>

      <label for="category">Complaint Category</label>
      <select name="category" required>
        <option value="">-- Select --</option>
        <option value="Cleanliness">Cleanliness</option>
        <option value="Lighting">Lighting</option>
        <option value="Display Issue">Display Issue</option>
        <option value="Seating">Seating</option>
        <option value="Others">Others</option>
      </select>

      <label for="message">Complaint Message</label>
      <textarea name="message" rows="5" required></textarea>

      <button type="submit">Submit Complaint</button>
    </form>
  </div>
</body>
</html>
