<?php

namespace Tests\Unit;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Http\Response;
use Tests\TestCase;

class TodoTest extends TestCase
{


    public function testCreateTodo()
    {
        $todo = [
                'title' => "New Product",
                'description' => "This is a product",
                ];
        $user = User::factory()->create();
        $this->actingAs($user, 'api')->json('POST', '/api/todos',$todo)
            ->assertStatus(200)
            ->assertJson([]);
    }

    public function testGetAllTodos()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        Todo::create([
            'title' => 'test 1',
            'description' => 'test 1 description',
            'user_id' => $user->id
        ]);
        $this->json('GET', 'api/todos', ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([]);
    }

    public function testUpdateTodos()
    {
        $this->withoutMiddleware();
        $user = User::factory()->create();
        $this->actingAs($user, 'api');
        $todo = Todo::create([
            'title' => 'test 1',
            'description' => 'test 1 description',
            'user_id' => $user->id
        ]);
        $payload = [
            'title' => 'test 12',
            'description' => 'test 1 description 12',
        ];

        $this->json('PATCH', 'api/todos/' . $todo->id , $payload, ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJson([
            ]);
    }

    public function testDeleteTodo()
    {
        $user = User::factory()->create();
        $this->actingAs($user, 'api');

        $todo = Todo::create([
            'title' => 'test 1djasdjk',
            'description' => 'test 1 jkasdjkasdh',
            'user_id' => $user->id
        ]);

        $this->json('DELETE', 'api/todos/' . $todo->id, [], ['Accept' => 'application/json'])
            ->assertStatus(204);
    }
}
