<?php

//database info
$host = 'itp460.usc.edu';
$dbname = 'dvd';
$user = 'student';
$pw = 'ttrojan';

$pdo = new PDO("mysql:host=$host; dbname=$dbname", $user, $pw);

$dvd_title = $_GET['dvd_title'];

//get from database
$sql = "
SELECT title, rating_name, format_name, genre_name
FROM dvds
LEFT JOIN ratings
ON dvds.rating_id = ratings.id
LEFT JOIN genres
ON dvds.genre_id = genres.id
LEFT JOIN formats
ON dvds.format_id = formats.id
WHERE title LIKE ?
";

$statement = $pdo->prepare($sql);
$like = '%' . $dvd_title . '%';
$statement->bindParam(1, $like);
$statement->execute();

//make it an object
$movies = $statement->fetchAll(PDO::FETCH_OBJ);
?>

<?php foreach($movies as $movie) : ?>
  <h3>
    <?php echo $movie->title ?>
  </h3>

  <p>
    Genre: <?php echo $movie->genre_name ?>
  </p>
  <p>
    Rating: <?php echo $movie->rating_name ?>
  </p>
  <p>
    Formate: <?php echo $movie->format_name ?>
  </p>

<?php endforeach; ?>

}
