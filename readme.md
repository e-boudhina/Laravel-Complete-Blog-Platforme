<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## About This Larvel Project :
 
* php artisan --version => Laravel Framework 5.8.36

This is a complete blog platforme with user authenticattion, C.R.U.D operations and validation controls over : Posts, Categories, Tags, Users & role managment .



Routes :

* php artisan route:list
     
| Domain | Method    | URI                        | Name                 | Action                                                                 | Middleware                     
|-----------|-----------|--------------------|------------------|-------------------------------------------------|--------------------------------|
|        | GET|HEAD  | /                          | welcome              | App\Http\Controllers\WelcomeController@index                           | web                            |
|        | GET|HEAD  | api/user                   |                      | Closure                                                                | api,auth:api                   |
|        | GET|HEAD  | blog/posts/{post}          | blog.show            | App\Http\Controllers\Blog\PostsController@show                         | web                            |
|        | POST      | categories                 | categories.store     | App\Http\Controllers\CategoriesController@store                        | web,auth                       |
|        | GET|HEAD  | categories                 | categories.index     | App\Http\Controllers\CategoriesController@index                        | web,auth                       |
|        | GET|HEAD  | categories/create          | categories.create    | App\Http\Controllers\CategoriesController@create                       | web,auth                       |
|        | DELETE    | categories/{category}      | categories.destroy   | App\Http\Controllers\CategoriesController@destroy                      | web,auth                       |
|        | GET|HEAD  | categories/{category}      | categories.show      | App\Http\Controllers\CategoriesController@show                         | web,auth                       |
|        | PUT|PATCH | categories/{category}      | categories.update    | App\Http\Controllers\CategoriesController@update                       | web,auth                       |
|        | GET|HEAD  | categories/{category}/edit | categories.edit      | App\Http\Controllers\CategoriesController@edit                         | web,auth                       |
|        | GET|HEAD  | home                       | home                 | App\Http\Controllers\HomeController@index                              | web,auth                       |
|        | POST      | login                      |                      | App\Http\Controllers\Auth\LoginController@login                        | web,guest                      |
|        | GET|HEAD  | login                      | login                | App\Http\Controllers\Auth\LoginController@showLoginForm                | web,guest                      |
|        | POST      | logout                     | logout               | App\Http\Controllers\Auth\LoginController@logout                       | web                            |
|        | POST      | password/email             | password.email       | App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail  | web,guest                      |
|        | GET|HEAD  | password/reset             | password.request     | App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm | web,guest                      |
|        | POST      | password/reset             | password.update      | App\Http\Controllers\Auth\ResetPasswordController@reset                | web,guest                      |
|        | GET|HEAD  | password/reset/{token}     | password.reset       | App\Http\Controllers\Auth\ResetPasswordController@showResetForm        | web,guest                      |
|        | POST      | posts                      | posts.store          | App\Http\Controllers\PostsController@store                             | web,auth,verifyCategoriesCount |
|        | GET|HEAD  | posts                      | posts.index          | App\Http\Controllers\PostsController@index                             | web,auth                       |
|        | GET|HEAD  | posts/create               | posts.create         | App\Http\Controllers\PostsController@create                            | web,auth,verifyCategoriesCount |
|        | GET|HEAD  | posts/{post}               | posts.show           | App\Http\Controllers\PostsController@show                              | web,auth                       |
|        | PUT|PATCH | posts/{post}               | posts.update         | App\Http\Controllers\PostsController@update                            | web,auth                       |
|        | DELETE    | posts/{post}               | posts.destroy        | App\Http\Controllers\PostsController@destroy                           | web,auth                       |
|        | GET|HEAD  | posts/{post}/edit          | posts.edit           | App\Http\Controllers\PostsController@edit                              | web,auth                       |
|        | POST      | register                   |                      | App\Http\Controllers\Auth\RegisterController@register                  | web,guest                      |
|        | GET|HEAD  | register                   | register             | App\Http\Controllers\Auth\RegisterController@showRegistrationForm      | web,guest                      |
|        | PUT       | restore-post/{post}        | restore-posts        | App\Http\Controllers\PostsController@restore                           | web,auth                       |
|        | PUT       | route/profile              | route.update-profile | App\Http\Controllers\UsersController@update                            | web,auth,admin                 |
|        | GET|HEAD  | tags                       | tags.index           | App\Http\Controllers\TagsController@index                              | web,auth                       |
|        | POST      | tags                       | tags.store           | App\Http\Controllers\TagsController@store                              | web,auth                       |
|        | GET|HEAD  | tags/create                | tags.create          | App\Http\Controllers\TagsController@create                             | web,auth                       |
|        | PUT|PATCH | tags/{tag}                 | tags.update          | App\Http\Controllers\TagsController@update                             | web,auth                       |
|        | DELETE    | tags/{tag}                 | tags.destroy         | App\Http\Controllers\TagsController@destroy                            | web,auth                       |
|        | GET|HEAD  | tags/{tag}                 | tags.show            | App\Http\Controllers\TagsController@show                               | web,auth                       |
|        | GET|HEAD  | tags/{tag}/edit            | tags.edit            | App\Http\Controllers\TagsController@edit                               | web,auth                       |
|        | GET|HEAD  | trashed-posts              | trashed-posts.index  | App\Http\Controllers\PostsController@trashed                           | web,auth                       |
|        | GET|HEAD  | users                      | users-index          | App\Http\Controllers\UsersController@index                             | web,auth,admin                 |
|        | GET|HEAD  | users/profile              | users.edit-profile   | App\Http\Controllers\UsersController@edit                              | web,auth,admin                 |
|        | POST      | users/{user}/make-admin    | users.make-admin     | App\Http\Controllers\UsersController@makeadmin                         | web,auth,admin                 |

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 1500 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.




## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
