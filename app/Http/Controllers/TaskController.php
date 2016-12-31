<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;
use Illuminate\Support\Facades\Crypt;
use App\Models\User;
use App\Models\Task;
use Log;
use Illuminate\Support\Facades\Hash;

class TaskController extends Controller
{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function createTask(Request $request) {
        $user_logged = $this->jwt->user();
        if($user_logged->role->role==="Administrator"){
            $this->validate($request, [
                'title'    => 'required',
                'description' => 'required',
                'due_date' => 'required',
                'assigned_to' => 'required',
                'priority' => 'required',
            ]);
            $task = new Task;
            $task->title = $request->title;
            $task->description = $request->description;
            $task->due_date = $request->due_date;
            $task->assigned_to = User::where('email','=',$request->assigned_to)->select('id')->value('id');
            $task->created_by = $user_logged->id;
            $task->priority = ($request->priority === "High" ? 1 : ($request->priority === "Medium" ? 2 : 
                ($request->priority === "Low" ? 3 : 3)));
            $task->save();
            return response ()->json ( "Tarea Creada" , 200 );
        }
        else{
            return response ()->json ( "Necesita ser Administrador" , 401 );
        } 
    }

    public function getTasks(){
        $user_logged = $this->jwt->user();
        $task = Task::with('created_by','priority')->where('assigned_to','=',$user_logged->id)
        ->orderBy('priority','asc')->get();
        return response ()->json ($task);
    }

}