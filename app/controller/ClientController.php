<?php
// controller/ClientController.php
// El controlador recibe la acción, llama al modelo y carga la vista.

require_once __DIR__ . '/../model/Client.php';

class ClientController
{
    // Muestra el listado
    public function index(): void
    {
        $clients = Client::all();
        require __DIR__ . '/../views/clients/index.php';
    }

    // Muestra el formulario de creación
    public function create(array $old = [], array $errors = []): void
    {
        require __DIR__ . '/../views/clients/create.php';
    }

    // Procesa el formulario de creación (POST)
    public function store(array $post): void
    {
        $errors = Client::validate($post);

        // Si hay errores, volvemos al formulario mostrando errores
        if (!empty($errors)) {
            $this->create($post, $errors);
            return;
        }

        Client::create($post);

        // Redirigir a la lista para evitar reenviar formulario al recargar
        header('Location: index.php?action=index');
        exit;
    }

    // Muestra el formulario de edición
    public function edit(int $id, array $old = [], array $errors = []): void
    {
        $client = Client::find($id);

        if (!$client) {
            echo "Cliente no encontrado";
            return;
        }

        require __DIR__ . '/../views/clients/edit.php';
    }

    // Procesa el formulario de edición (POST)
    public function update(int $id, array $post): void
    {
        $client = Client::find($id);

        if (!$client) {
            echo "Cliente no encontrado";
            return;
        }

        $errors = Client::validate($post);

        // Si hay errores, volvemos a editar
        if (!empty($errors)) {
            $this->edit($id, $post, $errors);
            return;
        }

        Client::update($id, $post);

        header('Location: index.php?action=index');
        exit;
    }

    // Borrar (POST)
    public function destroy(int $id): void
    {
        $client = Client::find($id);

        if (!$client) {
            echo "Cliente no encontrado";
            return;
        }

        Client::delete($id);

        header('Location: index.php?action=index');
        exit;
    }
}