<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));



/**
 * Show all movies.
 */
// $app->router->get("movie", function () use ($app) {
//     $title = "Movie database | oophp";
//
//     $app->db->connect();
//     $sql = "SELECT * FROM movie;";
//     $res = $app->db->executeFetchAll($sql);
//
//     $app->page->add("movie/index", [
//         "res" => $res,
//     ]);
//
//     return $app->page->render([
//         "title" => $title,
//     ]);
// });

// $app->router->get("movie", function () use ($app) {
//     $data = [
//         "title" => "Movie database || oophp",
//     ];
//
//
//     $app->db->connect();
//
//     $sql = "SELECT * FROM movie;"
//     $res = $app->db->executeFetchAll($sql);
//
//     $data["resultset"] = $res;
//
//     $app->view->add("movie/index", $data);
//     $app->page->render($data);
// });
