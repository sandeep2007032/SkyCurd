<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Note Web App</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* Base styles */
    body {
      font-family: Arial, sans-serif;
      background-color: #f0f0f0;
      margin: 0;
      padding: 0;
    }

    header {
      background-color: #333;
      color: #fff;
      padding: 10px 0;
      text-align: center;
      position: relative;
    }

    header nav ul {
      list-style: none;
      padding: 0;
      text-align: left; /* Align navigation buttons to the left */
    }

    header nav ul li {
      display: inline;
      margin-right: 20px;
    }

    header nav ul li a {
      text-decoration: none;
      color: #fff;
    }

    /* Add hover effect to navigation buttons */
    header nav ul li a:hover {
      background-color: #007bff;
      border-radius: 5px;
      transition: background-color 0.3s ease;
    }

    /* Card styles */
    .card-container {
      display: flex;
      justify-content: center;
      align-items: flex-start; /* Vertically align cards to the top */
      flex-wrap: wrap; /* Allow cards to wrap to the next line on small screens */
    }

    .card {
      background-color: #007bff;
      color: #fff;
      padding: 20px;
      border-radius: 10px;
      margin: 20px;
      width: calc(33.33% - 40px); /* 33.33% width for each card with spacing */
      box-sizing: border-box; /* Include padding and border in card width */
      transform: scale(1); /* Initial scale */
      transition: transform 0.5s, box-shadow 0.5s; /* Add transition for scale and box-shadow */
    }

    .card:hover {
      transform: scale(1.05); /* Enlarge the card on hover */
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.2); /* Add a subtle shadow on hover */
    }

    .card img {
      max-width: 100%; /* Ensure images don't overflow the card */
      height: auto; /* Maintain aspect ratio of images */
      display: block; /* Remove extra spacing below images */
    }

    /* Welcome section styles */
    #welcome-section {
      text-align: center;
      padding: 100px 0;
      background-color: #fff;
      color: #333;
      position: relative;
    }

    /* Add hover effect to the welcome section */
    #welcome-section:hover {
      transform: scale(1.05); /* Enlarge the section on hover */
    }

    #welcome-text {
      font-size: 36px;
      transition: transform 0.3s ease-in-out;
    }

    #welcome-section:hover #welcome-text {
      transform: translateX(10px);
    }

    /* About section styles */
    #about {
      background-color: #f0f0f0;
      padding: 100px 0;
      transition: background-color 0.5s ease; /* Add a transition effect for background color */
    }

    /* Add hover effect to the about section */
    #about:hover {
      background-color: #007bff; /* Change background color on hover */
    }

    #about h2 {
      text-align: center;
      font-size: 24px;
      color: #fff; /* Change text color when background color changes */
      margin-bottom: 20px;
    }

    #about p {
      text-align: center;
      font-size: 16px;
      color: #ccc; /* Change text color when background color changes */
    }

    /* Contact section styles */
    #contact {
      background-color: #f0f0f0;
      padding: 100px 0;
      transition: background-color 0.5s ease; /* Add a transition effect for background color */
    }

    /* Add hover effect to the contact section */
    #contact:hover {
      background-color: #007bff; /* Change background color on hover */
    }

    #contact h2 {
      text-align: center;
      font-size: 24px;
      color: #fff; /* Change text color when background color changes */
      margin-bottom: 20px;
    }

    #contact p {
      text-align: center;
      font-size: 16px;
      color: #ccc; /* Change text color when background color changes */
    }

    /* Add more CSS styles for other sections as needed */

    /* You can define additional CSS styles in your external style.css file */
  </style>
</head>
<body>
  <header>
    <nav>
      <ul>
        <li><a href="#home">Home</a></li>
        <li><a href="#about">About</a></li>
        <li><a href="#contact">Contact</a></li>
        <li id="login-button"><a href="login.php">Login</a></li>
      </ul>
    </nav>
  </header>

  <section id="welcome-section">
    <h1 id="welcome-text">Welcome to Your Note Web App</h1>
  </section>

  <section id="home">
    <div class="card-container">
      <div class="card">
        <img src="https://source.unsplash.com/300x200/?web,notes" alt="Card Image" class="card-image" id="cardImage1">
        <p>This is card 1 content.</p>
      </div>
      <div class="card">
        <img src="https://source.unsplash.com/300x200/?web,notes&${index}" alt="Card Image" class="card-image" id="cardImage2">
        <p>This is card 2 content.</p>
      </div>
      <div class="card">
        <img src="https://source.unsplash.com/300x200/?web,notes&${index}" alt="Card Image" class="card-image" id="cardImage3">
        <p>This is card 3 content.</p>
      </div>
    </div>
  </section>

  <section id="about">
    <div class="container">
      <h2>About Your Note Web App</h2>
      <p>In our fast-paced world, effective note-taking is a skill that can make a world of difference in personal and professional life.</p>
    </div>
  </section>

  <section id="contact">
    <div class="container">
      <h2>Contact Us</h2>
      <form action="https://formspree.io/f/xbjvrgwo" method="POST">
        <input type="text" name="Name" placeholder="Full Name" required>
        <input type="email" name="Email" placeholder="Email" required>
        <select name="container">
          <option>login</option>
          <option>signup</option>
          <option>password</option>
          <option>delete_account</option>
        </select>
        <textarea name="Message" placeholder="Message" required></textarea>
        <button type="submit">Send</button>
      </form>
    </div>
  </section>

  <footer>
    <p>&copy; 2023 Your Name. All rights reserved.</p>
  </footer>
</body>
</html>
