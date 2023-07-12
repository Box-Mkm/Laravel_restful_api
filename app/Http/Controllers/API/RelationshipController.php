<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;


class RelationshipController extends Controller
{
    public function UserLessons($id)
    {
        //return user with id=$id's all lesssons
        $user = User::findOrFail($id)->lessons;
        return Response::json([
            'data' => $user->toarray()
        ], 200);
    }
    public function LessonTags($id)
    {
        //returns tags for a given lesson
        $lesson = Lesson::findOrFail($id)->tags;
        return Response::json([
            'data' => $lesson->toarray()
        ], 200);
    }
    public function tagLessons($id)
    {
        // returns the list of lessons associated to this particular tag
        $tag = Tag::findOrFail($id)->lessons;
        return Response::json([
            'data' => $tag->toarray()
        ], 200);
    }
}
