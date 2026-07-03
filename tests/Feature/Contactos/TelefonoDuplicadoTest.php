<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('no permite registrar un contacto con un número de teléfono duplicado', function () {

    $user = User::factory()->create();

    Sanctum::actingAs($user);

    Contact::factory()->create([
        'user_id' => $user->id,
        'telefono' => '3001234567',
    ]);

    $response = $this->postJson('/api/contacts', [
        'nombre' => 'Juan Pérez',
        'telefono' => '3001234567',
        'email' => 'juan@example.com',
    ]);

    $response->assertStatus(422);

    $response->assertJsonValidationErrors([
        'telefono',
    ]);
});