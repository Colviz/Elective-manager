<?php

//getting the request path
function request_path()
{
    $request_uri = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    $script_name = explode('/', trim($_SERVER['SCRIPT_NAME'], '/'));
    $parts = array_diff_assoc($request_uri, $script_name);
    if (empty($parts))
    {
        return '/';
    }
    $path = implode('/', $parts);
    if (($position = strpos($path, '?')) !== FALSE)
    {
        $path = substr($path, 0, $position);
    }
    return $path;
}

//including the routes file
include_once('routes.php');

//checking the route availability
$path = request_path();

if (isset($routes[$path]) AND is_callable($routes[$path]))
{
    $routes[$path]();
}
else
{
    // Everything else - The default 404 page
    header('HTTP/1.0 404 Not Found');
    include_once('views/public/public_404.php');
}

//footer here
include_once('views/includes/includes_footer.php');

?>
