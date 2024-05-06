@extends('layouts.app')

@section('content')
<div class="container">
     <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>All Trashed</h3>
                    <p class="alert alert-danger" >Records in here will be deleted after 30 days</p>
                </div>
                <div class="card-body">
                <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Content</th>
                                <th>Status</th>
                                <th>Date Created</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                        <tbody>
                            @foreach($allTrashes as $allTrash)
                            <tr>
                                <td>
                                    {{ $allTrash->title }}
                                </td>
                                <td>{{ $allTrash->content }}</td>
                                <td>{{ $allTrash->status }}</td>
                                <td>{{ $allTrash->created_at  }}</td>
                               
                            </tr>
                            @endforeach
                           
                        </tbody>
                           
                        </tbody>
                    </table>
                   
                   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection