<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('actualiza usuario correctamente', function () {

    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->putJson('/api/user', [
        'name' => 'Anderson Marulanda',
        'email' => 'andersonnuevo@example.com',
    ]);

    $response->assertStatus(200)
        ->assertJsonFragment([
            'message' => 'Usuario actualizado correctamente.',
        ]);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Anderson Marulanda',
        'email' => 'andersonnuevo@example.com',
    ]);
});