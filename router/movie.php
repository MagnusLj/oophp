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

// $app->router->get("movie", function () use ($app) {
//     $data = [
//         "title" => "Movie database || oophp",
//     ];
//
//
//     $app->db->connect();
//
//     $sql = "SELECT * FROM movie;";
//     $resultset = $app->db->executeFetchAll($sql);
//
//     $data["resultset"] = $resultset;
//
//     $app->view->add("movie/index", $data);
//     $app->page->render($data);
// });
