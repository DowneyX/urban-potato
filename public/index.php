<?php

use controllers\AdminCreateAdminController;
use controllers\AdminCreateStudentController;
use controllers\AdminCreateTeacherController;
use controllers\AdminEnrollStudentController;
use controllers\AdminCreateCourseController;
use controllers\AdminCoursesController;

use controllers\AdminDeleteUserController;
use controllers\AdminDeleteCourseController;
use controllers\AdminDeleteEnrollmentController;

use controllers\AdminUsersAdminsController;
use controllers\AdminUsersTeachersController;
use controllers\AdminUsersStudentsController;
use controllers\AdminEnrollmentsController;
use controllers\StudentEnrollController;
use controllers\StudentOverviewController;
use controllers\TeacherCoursesController;
use controllers\TeacherCourseController;
use controllers\HomeController;
use controllers\LoginController;
use controllers\LogoutController;
use controllers\TestController;
use core\Application;
use core\container\Container;
use core\middleware\ErrorHandlingMiddleware;
use core\middleware\RoutingMiddleware;
use core\middleware\SessionMiddleware;
use core\middleware\SqliteEnforceConstraintMiddleware;
use core\session\SessionManager;
use core\routing\RouteCollection;
use PDO;



require_once(__DIR__ . '/../core/Autoloader.php');

//creating instance of app
$container = new Container();
$app = $container->get(Application::class);

//middleware
$app->addMiddleware(new ErrorHandlingMiddleware());
$app->addMiddleware(new SessionMiddleware($container->get(SessionManager::class)));
$app->addMiddleware(new SqliteEnforceConstraintMiddleware($container->get(PDO::class)));
$app->addMiddleware(new RoutingMiddleware($container->get(RouteCollection::class), $container));

//home
$app->addRoute([HomeController::class, 'homeGet'], '/', 'get', 'home');

//login & logout routes
$app->addRoute([LoginController::class, 'loginGet'], '/login', 'get', 'login');
$app->addRoute([LoginController::class, 'loginPost'], '/login', 'post', 'loginPost');
$app->addRoute([LogoutController::class, 'logout'], '/logout', 'get', 'logout');

$app->addRoute([AdminEnrollStudentController::class, 'adminEnrollStudent'], '/admin/users/students/{id}/enrollments/enroll', 'get', 'adminEnrollStudent');
$app->addRoute([AdminEnrollStudentController::class, 'adminEnrollStudentPost'], '/admin/users/students/{id}/enrollments/enroll', 'post', 'adminEnrollStudentPost');

//admin
$app->addRoute([AdminUsersAdminsController::class, 'usersGet'], '/admin/users/admins', 'get', 'adminUsersAdmins');
$app->addRoute([AdminUsersTeachersController::class, 'usersGet'], '/admin/users/teachers', 'get', 'adminUsersTeachers');
$app->addRoute([AdminUsersStudentsController::class, 'usersGet'], '/admin/users/students', 'get', 'adminUsersStudents');
$app->addRoute([AdminCoursesController::class, 'coursesGet'], '/admin/courses', 'get', 'adminCourses');
$app->addRoute([AdminEnrollmentsController::class, 'adminEnrollments'], '/admin/users/students/{id}/enrollments', 'get', 'adminEnrollments');


//creating users
$app->addRoute([AdminCreateAdminController::class, 'adminCreateUser'], '/admin/users/admins/create-admin', 'get', 'adminCreateAdmin');
$app->addRoute([AdminCreateAdminController::class, 'adminCreateUserPost'], '/admin/users/admins/create-admin', 'post', 'adminCreateAdminPost');

$app->addRoute([AdminCreateTeacherController::class, 'adminCreateUser'], '/admin/users/teachers/create-teacher', 'get', 'adminCreateTeacher');
$app->addRoute([AdminCreateTeacherController::class, 'adminCreateUserPost'], '/admin/users/teachers/create-teacher', 'post', 'adminCreateTeacherPost');

$app->addRoute([AdminCreateStudentController::class, 'adminCreateUser'], '/admin/users/students/create-user', 'get', 'adminCreateStudent');
$app->addRoute([AdminCreateStudentController::class, 'adminCreateUserPost'], '/admin/users/students/create-user', 'post', 'adminCreateStudentPost');

//creating course
$app->addRoute([AdminCreateCourseController::class, 'adminCreateCourse'], '/admin/courses/create-course', 'get', 'adminCreateCourse');
$app->addRoute([AdminCreateCourseController::class, 'adminCreateCoursePost'], '/admin/courses/create-course', 'post', 'adminCreateCoursePost');

//deleting
$app->addRoute([AdminDeleteUserController::class, 'adminDeleteUser'], '/admin/users/delete/{id}', 'get', 'adminDeleteUser');
$app->addRoute([AdminDeleteCourseController::class, 'adminDeleteCourse'], '/admin/courses/delete/{id}', 'get', 'adminDeleteCourse');
$app->addRoute([AdminDeleteEnrollmentController::class, 'adminDeleteEnrollment'], '/admin/enrollments/delete/{id}', 'get', 'adminDeleteEnrollment');

//student routes
$app->addRoute([StudentEnrollController::class, 'enroll'], '/student/enroll', 'get', 'enroll');
$app->addRoute([StudentEnrollController::class, 'enrollPost'], '/student/enroll', 'post', 'enrollPost');
$app->addRoute([StudentOverviewController::class, 'studentOverview'], '/student/overview', 'get', 'studentOverview');

//teacher routes
$app->addRoute([TeacherCoursesController::class, 'teacherCourses'], '/teacher/courses', 'get', 'teacherCourses');
$app->addRoute([TeacherCourseController::class, 'teacherCourse'], '/teacher/courses/{courseId}', 'get', 'teacherCourse');
$app->addRoute([TeacherCourseController::class, 'teacherCoursePost'], '/teacher/courses/{courseId}', 'post', 'teacherCoursePost');

//testing
$app->addRoute([TestController::class, 'test'], '/user/{id}', 'get', 'test');
$app->run();