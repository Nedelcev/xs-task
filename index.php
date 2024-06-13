<?php
session_start();

$isIncluded = true;

include_once 'db.php';
include_once 'models/User.php';
include_once 'models/Book.php';

$request = $_SERVER['REQUEST_URI'];
$params = explode('/', trim($request, '/'));

$controller = isset($params[0]) ? $params[0] : 'home';
$action = isset($params[1]) ? $params[1] : 'index';

include 'template/header.php';
switch ($controller) {
    case 'register':
		if (isset($_SESSION['user_id'])) {
            header("Location: /home");
        } else {
			include 'views/register.php';
        }
        break;
    case 'login':
        include 'views/login.php';
        break;
    case 'logout':
        include 'logout.php';
        break;
    case 'edit-book':
        if (isset($_SESSION['user_id']) && $_SESSION['is_admin']) {
            include 'views/edit-book.php';
        } else {
            header("Location: /login");
        }
        break;
    case 'home':
    case 'index':
    case '':
		include 'home.php';
        break;
    case 'edit-profile':
        if (isset($_SESSION['user_id'])) {
            include 'views/edit-profile.php';
        } else {
            header("Location: /login");
        }
        break;
    case 'my-books':
        if (isset($_SESSION['user_id'])) {
            include 'views/my-books.php';
        } else {
            header("Location: /login");
        }
        break;
    case 'admin':
        if (isset($_SESSION['user_id']) && $_SESSION['is_admin']) {
			if(!$action || empty($action)) {
				include 'views/404.php';
			}
			switch ($action) {
				case 'users-list':
					include 'admin/users-list.php';
					break;
				case 'create-book':
					include 'admin/create-book.php';
					break;
				case 'inactive-users':
					include 'admin/inactive-users.php';
					break;
				default:
					include 'views/404.php';
					break;
			}
        } else {
            include 'views/404.php';
        }
        break;
    default:
        include 'home.php';
        break;
}
include 'template/footer.php';
?>
