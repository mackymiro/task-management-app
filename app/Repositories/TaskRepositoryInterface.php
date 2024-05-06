<?php

namespace App\Repositories;

interface TaskRepositoryInterface{

    public function getTasksByUserId($id);

    public function createTask(array $data);

    public function updateTask($id, array $data);

    public function getTaskId($id);

    public function deleteTask($id);

    public function searchTaskPublished($searchTerm);

    public function getTasksByDraft($id);

    public function searchTaskDraft($searchTerm);

    public function getTrashedTasksByUserId($id);

}