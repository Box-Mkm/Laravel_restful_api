<?php

use App\Models\Tag;
use App\models\User;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['prefix' => 'v1'], function () {
    //API v1 route here...
    Route::get('lessons', function () {
        return Lesson::all();
    });
    Route::get('lessons/{id}', function ($id) {
        return Lesson::find($id);
    });
    Route::post('lessons', function (Request $request) {
        return Lesson::create($request->all());
    });
    Route::match(['put', 'patch'], 'lessons/{id}', function (Request $request, $id) {
        $lesson = Lesson::findorfail($id);
        $lesson->update($request->all());
        return $lesson;
    });
    Route::delete('lessons/{id}', function ($id) {
        Lesson::find($id)->delete();
        return 204;
    });
    Route::any('lesson', function () {
        return "Please Make sure to update your code to use the newer version of our API.
        You should use lessons instead of lesson .";
    });
    Route::redirect('lesson', 'lessons');

    Route::get('users', function () {
        return User::all();
    });
    Route::get('users/{id}', function ($id) {
        return User::find($id);
    });
    Route::post('users', function (Request $request) {
        return User::create($request->all());
    });
    Route::match(['put', 'patch'], 'users/{id}', function (Request $request, $id) {
        $user = User::findorfail($id);
        $user->update($request->all());
        return $user;
    });
    Route::delete('users/{id}', function ($id) {
        User::find($id)->delete();
        return 204;
    });
    Route::get('tags', function () {
        return Tag::all();
    });
    Route::get('tags/{id}', function ($id) {
        return Tag::find($id);
    });
    Route::post('tags', function (Request $request) {
        return Tag::create($request->all());
    });
    Route::match(['put', 'patch'], 'tags/{id}', function (Request $request, $id) {
        $tag = Tag::findorfail($id);
        $tag->update($request->all());
        return $tag;
    });
    Route::delete('tags/{id}', function ($id) {
        tag::find($id)->delete();
        return 204;
    });
    Route::get('users/{id}/lessons', function ($id) {
        //return user with id=$id's all lesssons
        $user = User::find($id)->lessons;
        return $user;
    });
    Route::get('lessons/{id}/tags', function ($id) {
        //returns tags for a given lesson
        $lesson = Lesson::find($id)->tags;
        return $lesson;
    });
    Route::get('tags/{id}/lessons', function ($id) {
        // returns the list of lessons associated to this particular tag
        $tag = Tag::find($id)->lessons;
        return $tag;
    });
});
