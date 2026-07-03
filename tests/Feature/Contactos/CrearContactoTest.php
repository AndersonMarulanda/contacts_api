<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('crea contacto correctamente', function () {

    $user = User::factory()->create();

    Sanctum::actingAs($user);

    $response = $this->postJson('/api/contacts', [
        'nombre' => 'Juan Pérez',
        'telefono' => '3001234567',
        'email' => 'juan@example.com',
    ]);

    $response->assertStatus(201);

    $this->assertDatabaseHas('contacts', [
        'user_id' => $user->id,
        'nombre' => 'Juan Pérez',
        'telefono' => '3001234567',
        'email' => 'juan@example.com',
    ]);
});