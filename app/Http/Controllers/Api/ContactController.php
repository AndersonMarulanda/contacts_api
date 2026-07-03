<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        $contacts = $request->user()->contacts;

        return response()->json([
            'contacts' => $contacts
        ], 200);
    }

    public function store(Request $request)
{
    $request->validate(
        [
            'nombre' => 'required|string|max:255',
            'telefono' => 'required|string|unique:contacts,telefono',
            'email' => 'nullable|email|unique:contacts,email',
        ],
        [
            'nombre.required' => 'El nombre es obligatorio.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.unique' => 'El teléfono ya está registrado.',
            'email.email' => 'El correo electrónico no es válido.',
            'email.unique' => 'El correo electrónico ya está registrado.',
        ]
    );

    $contact = Contact::create([
        'user_id' => $request->user()->id,
        'nombre' => $request->nombre,
        'telefono' => $request->telefono,
        'email' => $request->email,
    ]);

    return response()->json([
        'message' => 'Contacto creado correctamente.',
        'contact' => $contact,
    ], 201);
}

   public function show(Contact $contact)
{
    if ($contact->user_id !== auth()->id()) {
        return response()->json([
            'message' => 'No autorizado.'
        ], 403);
    }

    return response()->json($contact, 200);
}
    public function update(Request $request, Contact $contact)
{
    // Verificar que el contacto pertenezca al usuario autenticado
    if ($contact->user_id !== auth()->id()) {
        return response()->json([
            'message' => 'No autorizado.'
        ], 403);
    }

    // Validar los datos
    $validated = $request->validate([
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|unique:contacts,telefono,' . $contact->id,
    ]);

    // Actualizar el contacto
    $contact->update($validated);

    return response()->json([
        'message' => 'Contacto actualizado correctamente.',
        'contact' => $contact
    ], 200);
}

    public function destroy(Contact $contact)
{
    // Verificar que el contacto pertenezca al usuario autenticado
    if ($contact->user_id !== auth()->id()) {
        return response()->json([
            'message' => 'No autorizado.'
        ], 403);
    }

    // Eliminar el contacto
    $contact->delete();

    return response()->json([
        'message' => 'Contacto eliminado correctamente.'
    ], 200);
}
}