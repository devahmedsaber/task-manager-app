<?php

namespace App\Services;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
use App\Repositories\TaskRepository;
use Exception;
use Illuminate\Http\Request;

class TaskService
{
    /**
     * Tasks repository instance.
     *
     * @var TaskRepository $taskRepository
     */
    protected TaskRepository $taskRepository;

    /**
     * Tasks service constructor.
     *
     * @return void
     */
    public function __construct()
    {
        $this->taskRepository = new TaskRepository();
    }

    /**
     * Retrieve a list of tasks based on the request.
     *
     * @param Request $request
     * @return mixed
     * @throws Exception
     */
    public function index(Request $request): mixed
    {
        try {
            return $this->taskRepository->getAllTasks($request);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Retrieve a task based on id.
     *
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function show(string $id): mixed
    {
        try {
            return $this->taskRepository->showTask($id);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Create a new task.
     *
     * @param CreateTaskRequest $request
     * @return mixed
     * @throws Exception
     */
    public function store(CreateTaskRequest $request): mixed
    {
        try {
            return $this->taskRepository->storeTask($request);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Update a task.
     *
     * @param UpdateTaskRequest $request
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function update(UpdateTaskRequest $request, string $id): mixed
    {
        try {
            return $this->taskRepository->updateTask($request, $id);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Update a task status.
     *
     * @param UpdateTaskStatusRequest $request
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function updateStatus(UpdateTaskStatusRequest $request, string $id): mixed
    {
        try {
            return $this->taskRepository->updateTaskStatus($request, $id);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Delete a task.
     *
     * @param string $id
     * @return mixed
     * @throws Exception
     */
    public function destroy(string $id): mixed
    {
        try {
            return $this->taskRepository->deleteTask($id);
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
