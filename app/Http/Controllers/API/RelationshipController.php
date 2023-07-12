<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;


class RelationshipController extends Controller
{
    public function UserLessons($id)
    {
        //return user with id=$id's all lesssons
        $user = User::find($id)->lessons;
        return $user;
    }
    public function LessonTags($id)
    {
        //returns tags for a given lesson
        $lesson = Lesson::find($id)->tags;
        return $lesson;
    }
    public function tagLessons($id)
    {
        // returns the list of lessons associated to this particular tag
        $tag = Tag::find($id)->lessons;
        return $tag;
    }
}
