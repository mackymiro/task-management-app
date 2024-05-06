<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TaskStoreRequest;
use App\Repositories\TaskRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Auth;

class TaskController extends Controller
{
    //
    protected $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository){
        $this->taskRepository = $taskRepository;
    }

    public function searchDraft(Request $request){
        $searchResultDrafts  = $this->taskRepository->searchTaskDraft($request->title);
        
        return view('searchResultsDraft', ['searchResultDrafts'=>$searchResultDrafts]);
    }

    public function draft(){
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Get all tasks associated with the authenticated user
        $allTasks = $this->taskRepository->getTasksByDraft($userId);

        return view('draft', ['allTasks'=>$allTasks]);
    }

    public function search(Request $request){
        
       $searchResults = $this->taskRepository->searchTaskPublished($request->title);
    
       return view('searchResults', ['searchResults'=>$searchResults]);
    }

    public function allTrashed(){
        // Get the authenticated user's ID
        $userId = Auth::id();
        
          // Get all tasks associated with the authenticated user
       $allTrashes= $this->taskRepository->getTrashedTasksByUserId($userId);


        return view('allTrashed', ['allTrashes'=>$allTrashes]);
    }

    public function destroy($id){
        $this->taskRepository->deleteTask($id);
        Session::flash('success', 'Task successfully move to trash.');

        return redirect()->route('taskController.index');

    }

    public function update(Request $request, $id){

        $rules = [
            'title' => 'required|string|max:255|unique:tasks,title,' . $id,
            'content' => 'required|string',
        ];

        // Validate the request data
        $validator = Validator::make($request->all(), $rules);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

         // Check if a file was uploaded
         if($request->hasFile('uploadImage')) {
            // Get the uploaded file
            $image = $request->file('uploadImage');

            $filename = $image->getClientOriginalName();
         
            $path = 'public/images' . $filename; 

            // Store the file in the specified path
            $image->storeAs('public/images', $filename); 
    
            $request->merge(['upload_file' => $filename]);
        }

        $taskData = $request->only(['title', 'content', 'status', 'upload_file', 'wip']);
        
        $taskUpdate = $this->taskRepository->updateTask($id, $taskData);
        Session::flash('success', 'Task updated successfully.');

        return redirect()->route('taskController.edit', ['id'=>$id]);

    }


    public function edit($id){
        $taskId = $this->taskRepository->getTaskId($id);
        return view('editTask', ['taskId'=>$taskId]);
    }

    public function store(TaskStoreRequest $request){
        $validatedData = $request->validated();
        $userId = Auth::id();

         // Check if a file was uploaded
        if($request->hasFile('uploadImage')) {
            // Get the uploaded file
            $image = $request->file('uploadImage');

            $filename = $image->getClientOriginalName();
         
            $path = 'public/images' . $filename; 

              // Store the file in the specified path
             $image->storeAs('public/images', $filename); 
    
            // Update the validated data with the image path
            $validatedData['upload_file'] = $filename;
        }

        $validatedData['user_id'] = $userId;

        // Store the task using the repository
        $this->taskRepository->createTask($validatedData);
        Session::flash('success', 'Task created successfully.');

        return redirect()->route('taskController.create');

    }

    public function createTask(){
       
        return view('createTask');

    }

    public function index(){
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Get all tasks associated with the authenticated user
       $allTasks = $this->taskRepository->getTasksByUserId($userId);

       return view('taskView', ['allTasks' =>$allTasks]);
    }
    
}
