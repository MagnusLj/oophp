<?php
/**
 * Create routes using $app programming style.
 */
//var_dump(array_keys(get_defined_vars()));

$app->router->get("filterTest", function () use ($app) {
    $title = "Filter test | oophp";

    $app->page->add("filtertest/parse");

    return $app->page->render([
        "title" => $title,
    ]);
});
