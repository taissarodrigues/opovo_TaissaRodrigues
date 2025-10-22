<?php

declare(strict_types=1);

$BASE_PATH = dirname(__DIR__);

require_once $BASE_PATH . '/config/database.php';
require_once $BASE_PATH . '/app/Controllers/HomeController.php';
require_once $BASE_PATH . '/app/Controllers/AuthorsController.php';
require_once $BASE_PATH . '/app/Models/Author.php';

use App\Controllers\HomeController;
use App\Controllers\AuthorsController;

// o parâmetro ?r= define a rota.
// permite navegar entre as telas com os cases.
$route = $_GET['r'] ?? 'home';

switch ($route) {
    case 'home':
        (new HomeController())->index();
        break;

    case 'authors/index':
        (new AuthorsController())->index();
        break;
    case 'authors/create':
        (new AuthorsController())->create();
        break;
    case 'authors/store':
        (new AuthorsController())->store();
        break;
    case 'authors/edit':
        (new AuthorsController())->edit();
        break;
    case 'authors/update':
        (new AuthorsController())->update();
        break;
    case 'authors/delete':
        (new AuthorsController())->delete();
        break;

    default:
        http_response_code(404);
        echo "<h1>404</h1><p>Rota não encontrada.</p>";
}
