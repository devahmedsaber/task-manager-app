<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
use App\Http\Resources\TaskCollectionResource;
use App\Http\Resources\TaskResource;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use App\Services\TaskService;
use Illuminate\Http\JsonResponse;
use Exception;

class TaskController extends Controller
{
    use ApiResponse;

    /**
     * Tasks service instance.
     *
     * @var TaskService $taskService
     */
    protected TaskService $taskService;

    /**
     * Tasks controller constructor.
     *
     * @return void
     */
    public function __construct()
    {
        // Protect all routes.
        $this->middleware('auth:sanctum');
        $this->taskService = new taskService();
    }

    /**
     * Retrieve a list of tasks based on the request.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function index(Request $request): JsonResponse
    {
        $tasks = $this->taskService->index($request);

        return $this->success(__('tasks.fetched'), new TaskCollectionResource($tasks));
    }

    /**
     * Retrieve a task based on id.
     *
     * @param string $id
     * @return JsonResponse
     * @throws Exception
     */
    public function show(string $id): JsonResponse
    {
        $task = $this->taskService->show($id);

        return $this->success(__('tasks.fetched'), new TaskResource($task));
    }

    /**
     * Create a new task.
     *
     * @param CreateTaskRequest $request
     * @return JsonResponse
     * @throws Exception
     */
    public function store(CreateTaskRequest $request): JsonResponse
    {
        $task = $this->taskService->store($request);

        return $this->success(__('tasks.created'), new TaskResource($task));
    }

    /**
     * Update a task.
     *
     * @param UpdatetaskRequest $request
     * @param string $id
     * @return JsonResponse
     * @throws Exception
     */
    public function update(UpdateTaskRequest $request, string $id): JsonResponse
    {
        $task = $this->taskService->update($request, $id);

        return $this->success(__('tasks.updated'), new TaskResource($task));
    }

    /**
     * Update a task status.
     *
     * @param UpdateTaskStatusRequest $request
     * @param string $id
     * @return JsonResponse
     * @throws Exception
     */
    public function updateStatus(UpdateTaskStatusRequest $request, string $id): JsonResponse
    {
        $task = $this->taskService->updateStatus($request, $id);

        return $this->success(__('tasks.status_updated'), new TaskResource($task));
    }

    /**
     * Delete a task.
     *
     * @param string $id
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(string $id): JsonResponse
    {
        $this->taskService->destroy($id);

        return $this->success(__('tasks.deleted'));
    }
}
