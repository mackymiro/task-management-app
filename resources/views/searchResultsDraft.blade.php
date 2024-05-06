@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>All Tasks Draft</h3>
                </div>
                <div class="card-body">
                      <!-- Search Form -->
                      <form action="{{ route('taskController.searchDraft') }}" method="GET" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="title" class="form-control" placeholder="Search tasks...">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </div>
                    </form>
                    @if(Session::has('success'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('success') }}
                            </div>
                     @endif

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                          
                        @foreach($searchResultDrafts as $searchResultDraft)
                            <tr>
                                <td>
                                    {{ $searchResultDraft->title }}
                                </td>
                                <td>{{ $searchResultDraft->content }}</td>
                                <td>{{ $searchResultDraft->status }}</td>
                                <td>{{ $searchResultDraft->created_at  }}</td>
                                <td>
                                    <a href="{{ route('taskController.edit', $searchResultDraft->id) }}" class="btn btn-warning">Edit</a>
                                    |
                                    <form method="post" action="{{ route('taskController.destroy', $searchResultDraft->id) }}" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this task?')">Move to trash</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                           
                        </tbody>
                    </table>
                     <!-- Display pagination links -->
                     <div class="row">
                        <div class="col-md-12">
                            {{ $searchResultDrafts->links() }}
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>

@endsection