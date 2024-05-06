<?php

namespace App\Repositories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
use Auth;

class TaskRepository implements TaskRepositoryInterface{
    protected $model;

    public function __construct(Task $model){
        $this->model = $model;
    }

    public function getTrashedTasksByUserId($id){
        // Retrieve trashed tasks associated with the specified user ID
        return Task::onlyTrashed()
                    ->where('user_id', $id)
                    ->get();
    }

    public function searchTaskDraft($searchTerm, $perPage = 10, $status = 'draft'){
        $userId = Auth::id();
        $query = Task::where('user_id', $userId)
                    ->where('title', 'like', '%' . $searchTerm . '%')
                    ->where('wip', $status);
        
        return $query->paginate($perPage);

    }

    public function getTasksByDraft($id,  $status = 'draft',  $perPage = 10){
        // Retrieve tasks associated with the specified user ID and wip
        return Task::where('user_id', $id)
                    ->where('wip', $status)
                    ->orderBy('title', 'asc') // Sort by title alphabetically
                    ->orderBy('created_at', 'asc') // Then sort by date created
                    ->paginate($perPage); // Paginate the results
    }

    public function searchTaskPublished($searchTerm, $perPage = 10, $status = 'published'){
        $userId = Auth::id();
        $query = Task::where('user_id', $userId)
                    ->where('title', 'like', '%' . $searchTerm . '%')
                    ->where('wip', $status);
        
        return $query->paginate($perPage);
    }

    public function deleteTask($id){
        $task = Task::find($id);
        if($task){
            $task->delete();
            return true;
        }

        return false;
    }

    public function getTaskId($id){
        $taskId = Task::find($id);
        return $taskId;
    }

    public function updateTask($id, array $data){
        $task = Task::find($id);
        $task->update($data);
        return $task;
    }


    public function createTask(array $data){
        return Task::create($data);
    }

    public function getTasksByUserId($id, $status = 'published',  $perPage = 10){
        // Retrieve tasks associated with the specified user ID and wip
        return Task::where('user_id', $id)
                    ->where('wip', $status)
                    ->orderBy('title', 'asc') // Sort by title alphabetically
                    ->orderBy('created_at', 'asc') // Then sort by date created
                    ->paginate($perPage); // Paginate the results
    }

   
}