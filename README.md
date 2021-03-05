<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# GENERAL:
 feedbacksystem has 2 roles, One is admin and the otherone is user
 User can give a feedback and view what admin replied to that specific message
 Admin can see those feedbacks, reply to them, and can restrict or unrestrict that user from giving feedback

# TECHNICAL:
 To Create Database Tables:
### Command: 
 php artisan migrate

 To Populate Database With Data:
### Command: 
 php artisan db:seed

### Note: By running this command you will have 2 users data:

 (email: admin@gmail.com, password: admin123, role:ADMIN), 
 (email: alex@gmail.com, password: alex1234, role:USER)


