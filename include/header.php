<?php 
    // All header file and navabr to opening content div tag
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title><?php echo $pageTitle; ?></title>
    <link rel="stylesheet" href="css/style.css" />
  </head>
  <body>
    <div class="header">
      <div class="wrapper">
        <h1 class="branding-title">
          <a href="./">Personal Media Library</a>
        </h1>
        <ul class="nav">
          <li class="books<?php if($section == "books"){echo " on";} ?>">
            <a href="catalog.php?cat=books">Books</a>
          </li>
          <li class="movies<?php if($section == "movies"){echo " on";} ?>">
            <a href="catalog.php?cat=movies">Movies</a>
          </li>
          <li class="music<?php if($section == "music"){echo " on";} ?>">
            <a href="catalog.php?cat=music">music</a>
          </li>
          <li class="suggest<?php if($section == "suggest"){echo " on";} ?>">
            <a href="suggest.php">Suggest</a>
          </li>
        </ul>
      </div>
    </div>

    <div id="content">