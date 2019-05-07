<?php
/**
 * Pig controller
 */
return [
    // Path where to mount the routes, is added to each route path.
    "routes" => [
        [
            "info" => "Pig controller.",
            "mount" => "pig1",
            "handler" => "\Malm18\Pig\PigController",
        ],
    ]
];
