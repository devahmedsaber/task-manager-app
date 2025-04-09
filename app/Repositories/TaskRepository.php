<?php

namespace App\Repositories;

use App\Exceptions\GeneralException;
use App\Exceptions\ModelNotFound;
use App\Http\Requests\Task\CreateTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class TaskRepository
{
    /**
     * Tasks model instance.
     *
     * @var Task $task
     */
    protected $task;

    /**
     * Tasks repository constructor.
     */
    public function __construct()
    {
        $this->task = new Task();
    }

    /**
     * Retrieve all Tasks.
     *
     * @param Request $request
     * @return mixed
     */
    public function getAllTasks(Request $request): mixed
    {
        // Retrieve all tasks with search and pagination functionalities.
        return $this->task->search($request->search ?? null)->paginate($request->offset ?? 10);
    }

    /**
     * Retrieve a task based on id.
     *
     * @param string $id
     * @return mixed
     * @throws ModelNotFound|GeneralException|Exception
     */
    public function showTask(string $id): mixed
    {
        try {
            // Get the task based on the id.
            $task = $this->task->find($id);
            // Check if the task does not exist.
            if (! $task) {
                throw new ModelNotFound(__('tasks.not_found'));
            }
            return $task;
        } catch (ModelNotFound $ex) {
            throw $ex;
        } catch (Exception $ex) {
            throw new GeneralException();
        }
    }

    /**
     * Create a new task.
     *
     * @param CreateTaskRequest $request
     * @return mixed
     * @throws GeneralException|Exception
     */
    public function storeTask(CreateTaskRequest $request): mixed
    {
        try {
            // Create a new task.
            $this->task->title = $request->title;
            $this->task->status = $request->status ?? 'pending';
            $this->task->user_id = Auth::id();
            $this->task->save();
            return $this->task;
        } catch (GeneralException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            throw new GeneralException();
        }
    }

    /**
     * Update a task.
     *
     * @param UpdateTaskRequest $request
     * @param string $id
     * @return mixed
     * @throws ModelNotFound|GeneralException|Exception
     */
    public function updateTask(UpdateTaskRequest $request, string $id): mixed
    {
        try {
            // Get the task based on the id.
            $task = $this->task->find($id);
            // Check if the task does not exist.
            if (! $task) {
                throw new ModelNotFound(__('tasks.not_found'));
            }
            // Update the task details.
            $task->title = $request->title;
            $task->status = $request->status;
            $task->task->user_id = Auth::id();
            $task->save();
            // Send mail notification to the user with updated task details.
            return $task;
        } catch (ModelNotFound|GeneralException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            throw new GeneralException();
        }
    }

    /**
     * Update a task status.
     *
     * @param UpdateTaskStatusRequest $request
     * @param string $id
     * @return mixed
     * @throws ModelNotFound|GeneralException|Exception
     */
    public function updateTaskStatus(UpdateTaskStatusRequest $request, string $id): mixed
    {
        try {
            // Get the task based on the id.
            $task = $this->task->find($id);
            // Check if the task does not exist.
            if (! $task) {
                throw new ModelNotFound(__('tasks.not_found'));
            }
            // Update the task status.
            $task->status = $request->status;
            $task->save();
            return $task;
        } catch (ModelNotFound|GeneralException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            throw new GeneralException();
        }
    }

    /**
     * Delete a task.
     *
     * @param string $id
     * @return mixed
     * @throws ModelNotFound|GeneralException|Exception
     */
    public function deletetask(string $id): void
    {
        try {
            // Get the task based on the id.
            $task = $this->task->find($id);
            // Check if the task does not exist.
            if (! $task) {
                throw new ModelNotFound(__('tasks.not_found'));
            }
            // Delete the task.
            $task->delete();
        } catch (ModelNotFound|GeneralException $ex) {
            throw $ex;
        } catch (Exception $ex) {
            throw new GeneralException();
        }
    }
}
