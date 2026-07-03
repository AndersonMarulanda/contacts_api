<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('registra un usuario correctamente', function () {

    $response = $this->postJson('/api/register', [
        'name' => 'Anderson Marulanda',
        'email' => 'anderson@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertCreated()
        ->assertJsonStructure([
            'message',
            'user' => [
                'id',
                'name',
                'email',
                'created_at',
                'updated_at',
            ],
            'token',
        ]);

    $this->assertDatabaseHas('users', [
        'email' => 'anderson@example.com',
    ]);
});