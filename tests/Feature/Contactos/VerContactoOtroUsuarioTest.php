<?php

use App\Models\Contact;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

uses(RefreshDatabase::class);

test('no permite ver los contactos de otro usuario', function () {

    $user1 = User::factory()->create();
    $user2 = User::factory()->create();

    $contact = Contact::factory()->create([
        'user_id' => $user1->id,
    ]);

    Sanctum::actingAs($user2);

    $response = $this->getJson("/api/contacts/{$contact->id}");

    $response->assertStatus(403);

    $response->assertJson([
        'message' => 'No autorizado.',
    ]);
});