<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('no permite registrar un usuario con un correo ya registrado', function () {

    User::factory()->create([
        'name' => 'Anderson',
        'email' => 'anderson@example.com',
        'password' => bcrypt('password123'),
    ]);

    $response = $this->postJson('/api/register', [
        'name' => 'Juan Pérez',
        'email' => 'anderson@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors([
        'email',
    ]);
});