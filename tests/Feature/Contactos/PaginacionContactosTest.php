<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('lista los contactos con paginación', function () {

    $user = User::factory()->create();

    Sanctum::actingAs($user);

    Contact::factory()->count(12)->create([
        'user_id' => $user->id,
    ]);

    $response = $this->getJson('/api/contacts');

    $response->assertStatus(200);

    $response->assertJsonStructure([
        'current_page',
        'data',
        'per_page',
        'total',
        'last_page',
    ]);

    $response->assertJsonCount(5, 'data');
});