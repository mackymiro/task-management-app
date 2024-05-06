@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Task</div>
                <div class="card-body">
                    @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                     @endif
                        <form action="{{ route('taskController.update', $taskId->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT') 
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title', $taskId->title) }}" />
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Content</label>
                                <textarea name="content" name="content" class="form-control cols="30" rows="10">{{ old('content', $taskId->content) }}</textarea>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <select name="status" class="form-control" >
                                    <option value="to-do" {{ $taskId->status === 'to-do' ? 'selected' : '' }}>To Do</option>
                                    <option value="in-progress" {{ $taskId->status === 'in-progress' ? 'selected' : '' }}>In Progress</option>
                                    <option value="done" {{ $taskId->status === 'done' ? 'selected' : '' }}>Done</option>
                                </select>
                             
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Work In Progress</label>
                                <select name="wip" class="form-control" >
                                    <option value="draft" {{ $taskId->wip === 'draft' ? 'selected' : '' }}>Draft</option>
                                    <option value="published" {{ $taskId->wip === 'published' ? 'selected' : '' }}>Published</option>
                                </select>
                            
                            </div>
                            <div class="mb-3">
                                <label for="uploadImage" class="form-label">Upload Image</label>
                                <input type="file" name="uploadImage" class="form-control" />
                               

                                @if($taskId->upload_file)
                                <img src="{{ asset('storage/images/' . $taskId->upload_file) }}"  width="250px;" height="250px;" alt="Task Image">
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection