<?php
session_start();

// Protect page: redirect to login if not logged in
if (!isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

// Personal Info
$name = "Justine Lance M. Pabalan";
$title = "3rd Year Computer Science Student";
$email = "23-07377@g.batstate-u.edu.ph";
$phone = "+63 918 419 0484";

// Skills
$skills = ["PHP", "HTML", "CSS", "JavaScript", "PostgreSQL", "Python"];

// Experience (leave blank for now)
$experience = [];

// Education
$education = [
    "Elementary" => [
        "school" => "Calamba Christian Academy Inc.",
        "years" => "2011 - 2017"
    ],
    "Junior High" => [
        "school" => "Calamba Christian Academy Inc.",
        "years" => "2017 - 2021"
    ],
    "Senior High" => [
        "school" => "Calamba City Science Integrated School",
        "years" => "2021 - 2023"
    ],
    "College" => [
        "school" => "Batangas State University - Main II",
        "degree" => "B.S. Computer Science",
        "years" => "2023 - Present"
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Resume - <?= $name ?></title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="header">
      <h1><?= $name ?></h1>
      <h3><?= $title ?></h3>
      <p>Email: <?= $email ?> | Phone: <?= $phone ?></p>
    </div>

    <div class="section">
      <h2>Skills</h2>
      <div class="skills">
        <?php foreach ($skills as $skill): ?>
          <span class="skill-tag"><?= $skill ?></span>
        <?php endforeach; ?>
      </div>
    </div>

    <div class="section">
      <h2>Experience</h2>
      <?php if (empty($experience)): ?>
        <p><em>No work experience yet, but actively building projects!</em></p>
      <?php else: ?>
        <?php foreach ($experience as $job): ?>
          <div class="exp-item">
            <h3><?= $job["position"] ?> - <?= $job["company"] ?> <span>(<?= $job["years"] ?>)</span></h3>
            <p><?= $job["details"] ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
    </div>

    <div class="section">
      <h2>Education</h2>
      <div class="edu-item">
        <h3>Elementary: <?= $education["Elementary"]["school"] ?></h3>
        <span><?= $education["Elementary"]["years"] ?></span>
      </div>
      <div class="edu-item">
        <h3>Junior High: <?= $education["Junior High"]["school"] ?></h3>
        <span><?= $education["Junior High"]["years"] ?></span>
      </div>
      <div class="edu-item">
        <h3>Senior High: <?= $education["Senior High"]["school"] ?></h3>
        <span><?= $education["Senior High"]["years"] ?></span>
      </div>
      <div class="edu-item">
        <h3>College: <?= $education["College"]["degree"] ?> - <?= $education["College"]["school"] ?></h3>
        <span><?= $education["College"]["years"] ?></span>
      </div>
    </div>

    <a href="logout.php" class="logout">Logout</a>
  </div>
</body>
</html>
