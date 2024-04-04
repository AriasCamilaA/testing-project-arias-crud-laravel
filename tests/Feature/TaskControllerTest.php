<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_task()
    {
        $response = $this->post('/', [
            'title' => 'Test Task',
            'description' => 'This is a test task',
            'category' => 'Test',
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertStatus(200);
        $this->assertDatabaseHas('tasks', ['title' => 'Test Task']);
    }

    public function test_can_search_existing_task()
    {
        $task = Task::factory()->create();

        $response = $this->get('/search?search=' . $task->title);

        $response->assertStatus(200);
        $response->assertSee($task->title);
    }

    public function test_can_edit_existing_task()
    {
        $task = Task::factory()->create();

        $response = $this->put('/' . $task->id, [
            'title' => 'Updated Task',
            'description' => 'Updated task description',
            'category' => 'Updated Category',
            'due_date' => now()->addDays(14)->toDateString(),
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('tasks', ['title' => 'Updated Task']);
    }

    public function test_can_delete_existing_task()
    {
        $task = Task::factory()->create();

        $response = $this->delete('/' . $task->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    public function test_cannot_create_task_without_title()
    {
        $response = $this->post('/', [
            'description' => 'This is a test task',
            'category' => 'Test',
            'due_date' => now()->addDays(7)->toDateString(),
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_cannot_edit_task_with_invalid_data()
    {
        $task = Task::factory()->create();

        $response = $this->put('/' . $task->id, [
            'due_date' => 'invalid_date_format',
        ]);

        $response->assertSessionHasErrors();
    }

    public function test_cannot_delete_nonexistent_task()
    {
        $response = $this->delete('/999');

        $response->assertNotFound();
    }

    public function test_search_tasks_with_empty_search_term()
    {
        $task1 = Task::factory()->create(['title' => 'Task One']);
        $task2 = Task::factory()->create(['title' => 'Task Two']);

        $response = $this->get('/search');

        $response->assertStatus(200);
        $response->assertSee($task1->title);
        $response->assertSee($task2->title);
    }

    public function test_cannot_edit_task_with_duplicate_title()
    {
        $task1 = Task::factory()->create(['title' => 'Task One']);
        $task2 = Task::factory()->create();

        $response = $this->put('/' . $task2->id, [
            'title' => $task1->title,
        ]);

        $response->assertSessionHasErrors('title');
    }

    public function test_can_edit_task_with_valid_data()
    {
        $task = Task::factory()->create();

        $response = $this->put('/' . $task->id, [
            'title' => 'Updated Task',
            'description' => 'Updated task description',
            'category' => 'Updated Category',
            'due_date' => now()->addDays(14)->toDateString(),
        ]);

        $response->assertRedirect('/');
        $this->assertDatabaseHas('tasks', ['title' => 'Updated Task']);
    }
}
