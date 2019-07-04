<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

// namespace Malm18\Content;
//
// $xContent = new Content();

/**
 * Show all movies.
 */
$app->router->get("content", function () use ($app) {
    $title = "Innehåll | oophp";

    $app->db->connect();
    $sql = "SELECT * FROM content;";
    $resultset = $app->db->executeFetchAll($sql);

    // $pigobj = new Malm18\Pig\Pig();
    //
    // $pigobj->gozer();

    if ($_SESSION["user"] ?? null) {
        $app->page->add("content/header2");
    } else {
        $app->page->add("content/header");
    }

    $app->page->add("content/show-all", [
        "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
});




$app->router->get("pages", function () use ($app) {
    $title = "Pages | oophp";

    if ($_GET["route"] ?? false) {
        $route = $_GET["route"];
        // echo ($route);
        // echo (substr($route, 0, 5));
        // if (substr($route, 0, 5) === "blog/") {
            //  Matches blog/slug, display content by slug and type post
            $app->db->connect();
            $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS modified_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS modified
FROM content
WHERE
    path = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
;
EOD;
            $resultset = $app->db->executeFetch($sql, [$route, "page"]);


            if ($_SESSION["user"]) {
                $app->page->add("content/header2");
            } else {
                $app->page->add("content/header");
            }

            $app->page->add("content/page", [
                "resultset" => $resultset,
            ]);

            return $app->page->render([
                "title" => $title,
            ]);





} else {


        $app->db->connect();
        $sql = <<<EOD
SELECT
    *,
    CASE
        WHEN (deleted <= NOW()) THEN "isDeleted"
        WHEN (published <= NOW()) THEN "isPublished"
        ELSE "notPublished"
    END AS status
FROM content
WHERE type=?
;
EOD;
        $resultset = $app->db->executeFetchAll($sql, ["page"]);



    if ($_SESSION["user"] ?? null) {
        $app->page->add("content/header2");
    } else {
        $app->page->add("content/header");
    }

    $app->page->add("content/pages", [
        "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
}
});





$app->router->get("blog", function () use ($app) {
    $title = "Blogg | oophp";

    // if ($_SESSION) {
    //     print_r($_SESSION);
    // }

    if ($_GET["route"] ?? false) {

        $route = $_GET["route"];
        // echo ($route);
        // echo (substr($route, 0, 5));
        // if (substr($route, 0, 5) === "blog/") {
            //  Matches blog/slug, display content by slug and type post
            $app->db->connect();
            $sql = <<<EOD
SELECT
    *,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
    DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE
    slug = ?
    AND type = ?
    AND (deleted IS NULL OR deleted > NOW())
    AND published <= NOW()
ORDER BY published DESC
;
EOD;
$slug = $route;
    $resultset = $app->db->executeFetch($sql, [$slug, "post"]);


    if ($_SESSION["user"] ?? null) {
        $app->page->add("content/header2");
    } else {
        $app->page->add("content/header");
    }



    // $app->page->add("content/header");

    $app->page->add("content/blogpost", [
        "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);


    // if ($_POST["doSearch"] ?? false) {
    //     $_SESSION["searchTitle"] = $_POST["searchTitle"];
} else {

        $app->db->connect();
//         $sql = <<<EOD
// SELECT
//     *,
//     DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
//     DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
// FROM content
// WHERE type=?
// ORDER BY published DESC
// ;
// EOD;

$sql = <<<EOD
SELECT
*,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%dT%TZ') AS published_iso8601,
DATE_FORMAT(COALESCE(updated, published), '%Y-%m-%d') AS published
FROM content
WHERE type=?
AND (deleted IS NULL OR deleted > NOW())
AND published <= NOW()
ORDER BY published DESC
;
EOD;

        $resultset = $app->db->executeFetchAll($sql, ["post"]);



    if ($_SESSION["user"] ?? null) {
        $app->page->add("content/header2");
    } else {
        $app->page->add("content/header");
    }

    $app->page->add("content/blog", [
        "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
}
});



$app->router->get("edit", function () use ($app) {
    $title = "Edit | oophp";

    if ($_GET["id"] ?? false) {

        $id = $_GET["id"];
        echo ($id);

        $app->db->connect();
        $sql = "SELECT * FROM content WHERE id = ?;";
        $resultset = $app->db->executeFetch($sql, [$id]);


    if ($_SESSION["user"]) {
        $app->page->add("content/header2");
    } else {
        $app->page->add("content/header");
    }

    $app->page->add("content/edit", [
        "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);
}
});


$app->router->post("edit", function () use ($app) {
    // $title = "Movie database | oophp";
    $xContent = new Malm18\Content\Content();




    if ($xContent->hasKeyPost("doSave")) {
        // $_SESSION["searchTitle"] = $_POST["searchTitle"];
        $params = $xContent->getPost([
                "contentTitle",
                "contentPath",
                "contentSlug",
                "contentData",
                "contentType",
                "contentFilter",
                "contentPublish",
                "contentId"
            ]);

            $app->db->connect();
            $sql = "SELECT * from content;";
            $resultset = $app->db->executeFetchAll($sql);


            if (!$params["contentSlug"]) {
                    $params["contentSlug"] = $xContent->slugify($params["contentTitle"]);
                }


            foreach ($resultset as $row) {
                if (($params["contentSlug"] == $row->slug)) {
                    $params["contentSlug"] = $params["contentSlug"] . "x";
                    continue;
                }
            }




            if (!$params["contentPath"]) {
                $params["contentPath"] = null;
            }

            $app->db->connect();
            $sql = "UPDATE content SET title=?, path=?, slug=?, data=?, type=?, filter=?, published=? WHERE id = ?;";
            $app->db->execute($sql, array_values($params));
    }


    if ($xContent->hasKeyPost("doDelete")) {
        // $_SESSION["searchTitle"] = $_POST["searchTitle"];
        $contentId = $_GET["id"];
        if (!is_numeric($contentId)) {
            die("Not valid for content id.");
        }

            $app->db->connect();
            $sql = "UPDATE content SET deleted=NOW() WHERE id=?;";
            $app->db->execute($sql, [$contentId]);
    }


    return $app->response->redirect("admin");
});





$app->router->get("admin", function () use ($app) {
    $title = "Admin | oophp";
    // $searchTitle = "";
    if ($_SESSION) {
        print_r($_SESSION);
    }

    // if ($_SESSION["searchTitle"] ?? false) {
    //     $searchTitle = $_SESSION["searchTitle"];
    // }
    //
    // $data = [];
    //
    //
    // $data = [
    //     "searchTitle" => $searchTitle
    // ];

    // if ($searchTitle) {
        $app->db->connect();
        $sql = "SELECT * FROM content;";
        $resultset = $app->db->executeFetchAll($sql);



    if ($_SESSION["user"] ?? null) {
        $app->page->add("content/header2");
    } else {
        $app->page->add("content/header");
    }

    $app->page->add("content/admin", [
        "resultset" => $resultset,
    ]);
    // , $data);

    // // if ($searchTitle) {
    //     $app->db->connect();
    //     $sql = "SELECT * FROM content;";
    //     $resultset = $app->db->executeFetchAll($sql);
    //     $app->page->add("content/admin", [
    //         "resultset" => $resultset,
    //     ]);
    // }


    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->post("admin", function () use ($app) {
    // $title = "Movie database | oophp";

    print_r($_POST);

    // if ($_POST["doCreate"] ?? false) {
    //     // $_SESSION["searchTitle"] = $_POST["searchTitle"];
    //     return $app->response->redirect("pages");
    // }


    return $app->response->redirect("create");
});



$app->router->get("login", function () use ($app) {
    $title = "Login | oophp";

    $user = "test";
    $password = "test";

    if (isset($_SESSION)) {
        print_r($_SESSION);
    }

    $app->db->connect();
    $sql = "SELECT * FROM users;";
    $resultset = $app->db->executeFetchAll($sql);

    // foreach ($resultset as $row) {
    //     // if (($user == $row->user && $password == $row->password)) {
    //         echo $row->user . " " . $row->password;
    //         // break;
    //     }
    // }

    $app->page->add("content/header");

    $app->page->add("content/login");

    return $app->page->render([
        "title" => $title,
    ]);
});


$app->router->post("login", function () use ($app) {

    // Get incoming values from posted form
    $user = $_POST["user"] ?? null;
    $password = $_POST["password"] ?? null;

    // $_SESSION["user"] = $_POST["user"] ?? null;
    // $_SESSION["password"] = $_POST["password"] ?? null;

    $app->db->connect();
    $sql = "SELECT * FROM users;";
    $resultset = $app->db->executeFetchAll($sql);

    foreach ($resultset as $row) {
        if (($user === $row->user && $password === $row->password)) {
            // $_SESSION["user"] = $_POST["user"] ?? null;
            // $_SESSION["password"] = $_POST["password"] ?? null;
            $_SESSION["user"] = $user;
            $_SESSION["name"] = $row->name;
            $name = $row->name;
            $_SESSION["flashmessage"] = "Welcome, user $name!";
            return $app->response->redirect("admin");
            break;
        }
    }

    $_SESSION["flashmessage"] = "You failed to login!";
    return $app->response->redirect("login");

    // $title = "Login | oophp";
    //
    // $app->page->add("content/header");
    //
    // $app->page->add("content/login");
    //
    // return $app->page->render([
    //     "title" => $title,
    // ]);
});





$app->router->get("logout", function () use ($app) {

    $user = $_SESSION["user"] ?? null;
    $name = $_SESSION["name"] ?? null;
    $_SESSION["user"] = null;
    $_SESSION["flashmessage"] = "User $name has logged out.";
    return $app->response->redirect("login");

});



$app->router->get("create", function () use ($app) {
    $title = "Create | oophp";
        //
        // $app->db->connect();
        // $sql = "SELECT * FROM content;";
        // $resultset = $app->db->executeFetchAll($sql);



    if ($_SESSION["user"]) {
        $app->page->add("content/header2");
    } else {
        $app->page->add("content/header");
    }

    $app->page->add("content/create", [
        // "resultset" => $resultset,
    ]);

    return $app->page->render([
        "title" => $title,
    ]);

});



$app->router->post("create", function () use ($app) {
    $xContent = new Malm18\Content\Content();
    // $title = "Create | oophp";

    if ($xContent->hasKeyPost("doCreate")) {
        // return $app->response->redirect("false");
        $_SESSION["contentTitle"] = $_POST["contentTitle"];
        $_SESSION["cock"] = "bird";
        $title = $_POST["contentTitle"];
        $app->db->connect();
        $sql = "INSERT INTO content (title) VALUES (?);";
        $app->db->execute($sql, [$title]);

}
    $_SESSION["Ass"] = "Donkey";
    // $_SESSION = $_POST;
    return $app->response->redirect("admin");
    // $app->page->add("content/header");
    //
    // $app->page->add("content/create", [
    //     // "resultset" => $resultset,
    // ]);
    //
    // return $app->page->render([
    //     "title" => $title,
    // ]);

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
