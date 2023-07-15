<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Resources\Lesson as LessonResource;

class LessonController extends Controller
{
    /**
     * Instantiate a new controller instance
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50 ? $request->input('limit') : '15';
        return LessonResource::collection(Lesson::paginate($limit));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = new LessonResource(Lesson::create($request->all()));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = new LessonResource(Lesson::findOrFail($id));
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $idlesson = Lesson::findOrFail($id);
        $this->authorize('update', $idlesson);
        $lesson = new LessonResource(Lesson::findOrFail($id));
        $lesson->update($request->all());
        return $lesson->response()->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idlesson = Lesson::findOrFail($id);
        $this->authorize('delete', $idlesson);
        Lesson::findOrFail($id)->delete();
        return 204;
    }
}
