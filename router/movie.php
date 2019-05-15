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
    // if (isset($_POST)) {
    //     print_r($_POST);
    // }

    // if ($_SESSION["doSearch"] ?? false) {
    //     $searchTitle = $_SESSION["searchTitle"];
    //     echo "Search titeeele";
    //     print_r($_SESSION);
    //     print_r($searchTitle);
    //     }

    if ($_SESSION["searchTitle"] ?? false) {
        $searchTitle = $_SESSION["searchTitle"];
        print_r($searchTitle);
}

    $data = [];

    // $app->db->connect();
    // $sql = "SELECT * FROM movie;";
    // $resultset = $app->db->executeFetchAll($sql);
    // $searchTitle = $_POST["searchTitle"] ?? null;

    $data = [
        "searchTitle" => $searchTitle
        // "result" => $result ?? null
    ];

    // print_r($_POST);
    // print_r($data);
    // print_r($_SESSION);
    // print_r($searchTitle);


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


// $app->db->connect();
// $sql = "SELECT * FROM movie;";
// $resultset = $app->db->executeFetchAll($sql);




    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->post("search-title", function () use ($app) {
    $title = "Movie database | oophp";


    // $app->db->connect();
    // $sql = "SELECT * FROM movie;";
    // $resultset = $app->db->executeFetchAll($sql);

    if ($_POST["doSearch"] ?? false) {
        $_SESSION["searchTitle"] = $_POST["searchTitle"];
        }

    // return $app->page->render([
    //     "title" => $title,
    // ]);

    return $app->response->redirect("search-title");
});





$app->router->get("search-year", function () use ($app) {
    $title = "Movie database | oophp";
    // $year1 = 1900;
    // $year2 = 2100;
    // if (isset($_POST)) {
    //     print_r($_POST);
    // }

    // if ($_SESSION["doSearch"] ?? false) {
    //     $searchTitle = $_SESSION["searchTitle"];
    //     echo "Search titeeele";
    //     print_r($_SESSION);
    //     print_r($searchTitle);
    //     }

    $year1 = null;
    $year2 = null;

    if ($_SESSION["year1"] ?? false) {
        $year1 = $_SESSION["year1"];
        // print_r(year1);
}

    if ($_SESSION["year2"] ?? false) {
        $year2 = $_SESSION["year2"];
        // print_r(year2);
    }

    $data = [];

    // $app->db->connect();
    // $sql = "SELECT * FROM movie;";
    // $resultset = $app->db->executeFetchAll($sql);
    // $searchTitle = $_POST["searchTitle"] ?? null;






    $data = [
        "year1" => $year1,
        "year2" => $year2
        // "result" => $result ?? null
    ];

    // print_r($_POST);
    // print_r($data);
    // print_r($_SESSION);
    // print_r($searchTitle);


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


    // $app->db->connect();
    // $sql = "SELECT * FROM movie;";
    // $resultset = $app->db->executeFetchAll($sql);

    if ($_POST["doSearch"] ?? false) {
        $_SESSION["year1"] = $_POST["year1"];
        $_SESSION["year2"] = $_POST["year2"];
        }

    // return $app->page->render([
    //     "title" => $title,
    // ]);

    return $app->response->redirect("search-year");
});
