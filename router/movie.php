<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Show all movies.
 */
$app->router->get("movie", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $resultset = $app->db->executeFetchAll($sql);

    $pigobj = new Malm18\Pig\Pig();

    $pigobj->gozer();

    $app->page->add("movie/header");

    $app->page->add("movie/index", [
        "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->get("search-title", function () use ($app) {
    $title = "Movie database | oophp";
    $searchTitle = "";


    if ($_SESSION["searchTitle"] ?? false) {
        $searchTitle = $_SESSION["searchTitle"];
    }

    $data = [];


    $data = [
        "searchTitle" => $searchTitle
    ];


    $app->page->add("movie/header");

    $app->page->add("movie/search-title", $data);

    if ($searchTitle) {
        $app->db->connect();
        $sql = "SELECT * FROM movie WHERE title LIKE ?;";
        $resultset = $app->db->executeFetchAll($sql, [$searchTitle]);
        $app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    }


    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->post("search-title", function () use ($app) {
    $title = "Movie database | oophp";



    if ($_POST["doSearch"] ?? false) {
        $_SESSION["searchTitle"] = $_POST["searchTitle"];
    }


    return $app->response->redirect("search-title");
});





$app->router->get("search-year", function () use ($app) {
    $title = "Movie database | oophp";


    $year1 = null;
    $year2 = null;

    if ($_SESSION["year1"] ?? false) {
        $year1 = $_SESSION["year1"];
    }

    if ($_SESSION["year2"] ?? false) {
        $year2 = $_SESSION["year2"];
    }

    $data = [];

    $data = [
        "year1" => $year1,
        "year2" => $year2
    ];


    $app->page->add("movie/header");

    $app->page->add("movie/search-year", $data);

    if ($year1 && $year2) {
        $app->db->connect();
        $sql = "SELECT * FROM movie WHERE year >= ? AND year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1, $year2]);
        $app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    } elseif ($year1) {
        $app->db->connect();
        $sql = "SELECT * FROM movie WHERE year >= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year1]);
        $app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    } elseif ($year2) {
        $app->db->connect();
        $sql = "SELECT * FROM movie WHERE year <= ?;";
        $resultset = $app->db->executeFetchAll($sql, [$year2]);
        $app->page->add("movie/index", [
            "resultset" => $resultset,
        ]);
    }

        return $app->page->render([
            "title" => $title,
        ]);
});





$app->router->post("search-year", function () use ($app) {
    $title = "Movie database | oophp";

    if ($_POST["doSearch"] ?? false) {
        $_SESSION["year1"] = $_POST["year1"];
        $_SESSION["year2"] = $_POST["year2"];
    }

    return $app->response->redirect("search-year");
});




$app->router->get("movie-select", function () use ($app) {
    $title = "Movie database | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM movie;";
    $movies = $app->db->executeFetchAll($sql);

    $app->page->add("movie/header");

    $app->page->add("movie/movie-select", [
        "movies" => $movies,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



$app->router->post("movie-select", function () use ($app) {
    $title = "Movie database | oophp";

    if ($_POST["doEdit"] ?? false && is_numeric($movieId)) {
        $_SESSION["movieId"] = $_POST["movieId"];
        return $app->response->redirect("movie-edit");
    } elseif ($_POST["doAdd"] ?? false) {
        $app->db->connect();
        $sql = "INSERT INTO movie (title, year, image) VALUES (?, ?, ?);";
        $app->db->execute($sql, ["A title", 2017, "img/noimage.png"]);
        $_SESSION["movieId"] = $app->db->lastInsertId();
        return $app->response->redirect("movie-edit");
    } elseif ($_POST["doDelete"] ?? false) {
        $movieId = $_POST["movieId"];
        $app->db->connect();
        $sql = "DELETE FROM movie WHERE id = ?;";
        $app->db->execute($sql, [$movieId]);
        return $app->response->redirect("movie");
    }
});



$app->router->get("movie-edit", function () use ($app) {
    $title = "Movie database | oophp";

    if ($_SESSION["movieId"] ?? false) {
        $movieId = $_SESSION["movieId"];
    }


    if ($movieId) {
        $app->db->connect();
        $sql = "SELECT * FROM movie WHERE id LIKE ?;";
        $movie = $app->db->executeFetchAll($sql, [$movieId]);
        print_r($movie[0]->title);
        $movie = $movie[0];
        // $app->page->add("movie/index", [
        //     "resultset" => $resultset,
        // ]);
    }

    $app->page->add("movie/header");

    $app->page->add("movie/movie-edit", [
        "movie" => $movie,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});



$app->router->post("movie-edit", function () use ($app) {
    $title = "Movie database | oophp";

    if ($_POST["doSave"] ?? false) {
        $movieTitle = $_POST["movieTitle"];
        $movieYear = $_POST["movieYear"];
        $movieImage = $_POST["movieImage"];
        $movieId = $_POST["movieId"];
        $app->db->connect();
        $sql = "UPDATE movie SET title = ?, year = ?, image = ? WHERE id = ?;";
        $app->db->execute($sql, [$movieTitle, $movieYear, $movieImage, $movieId]);
        return $app->response->redirect("movie");
    }
});
