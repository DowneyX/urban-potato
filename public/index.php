<?php

use controllers\StudentEnrollController;
use controllers\StudentOverviewController;
use controllers\TeacherCoursesController;
use controllers\TeacherCourseController;
use controllers\HomeController;
use controllers\AdminCreateUserController;
use controllers\AdminCreateCourseController;
use controllers\AdminCoursesController;
use controllers\AdminUsersController;
use controllers\AdminEnrollmentsController;
use controllers\LoginController;
use controllers\LogoutController;
use controllers\TestController;
use core\Application;
use core\container\Container;
use core\middleware\ErrorHandlingMiddleware;
use core\middleware\RoutingMiddleware;
use core\middleware\SessionMiddleware;
use core\session\SessionManager;
use core\routing\RouteCollection;



require_once(__DIR__ . '/../core/Autoloader.php');

//creating instance of app
$container = new Container();
$app = $container->get(Application::class);

//middleware
$app->addMiddleware(new ErrorHandlingMiddleware());
$app->addMiddleware(new SessionMiddleware($container->get(SessionManager::class)));
$app->addMiddleware(new RoutingMiddleware($container->get(RouteCollection::class), $container));

//home
$app->addRoute([HomeController::class, 'homeGet'], '/', 'get', 'home');

//login & logout routes
$app->addRoute([LoginController::class, 'loginGet'], '/login', 'get', 'login');
$app->addRoute([LoginController::class, 'loginPost'], '/login', 'post', 'loginPost');
$app->addRoute([LogoutController::class, 'logout'], '/logout', 'get', 'logout');

//admin routes
$app->addRoute([AdminUsersController::class, 'usersGet'], '/admin/users', 'get', 'adminUsers');
$app->addRoute([AdminCoursesController::class, 'coursesGet'], '/admin/courses', 'get', 'adminCourses');
$app->addRoute([AdminCreateUserController::class, 'adminCreateUser'], '/admin/users/create-user', 'get', 'adminCreateUser');
$app->addRoute([AdminCreateUserController::class, 'adminCreateUserPost'], '/admin/users/create-user', 'post', 'adminCreateUserPost');
$app->addRoute([AdminCreateCourseController::class, 'adminCreateCourse'], '/admin/courses/create-course', 'get', 'adminCreateCourse');
$app->addRoute([AdminCreateCourseController::class, 'adminCreateCoursePost'], '/admin/courses/create-course', 'post', 'adminCreateCoursePost');

//student routes
$app->addRoute([StudentEnrollController::class, 'enroll'], '/student/enroll', 'get', 'enroll');
$app->addRoute([StudentEnrollController::class, 'enrollPost'], '/student/enroll', 'post', 'enrollPost');
$app->addRoute([StudentOverviewController::class, 'studentOverview'], '/student/overview', 'get', 'studentOverview');

//teacher routes
$app->addRoute([TeacherCoursesController::class, 'teacherCourses'], '/teacher/courses', 'get', 'teacherCourses');
$app->addRoute([TeacherCourseController::class, 'teacherCourse'], '/teacher/courses/course/{courseId}', 'get', 'teacherCourse');
$app->addRoute([TeacherCourseController::class, 'teacherCoursePost'], '/teacher/courses/course/{courseId}', 'post', 'teacherCoursePost');

//testing
$app->addRoute([TestController::class, 'test'], '/user/{id}', 'get', 'test');
$app->run();