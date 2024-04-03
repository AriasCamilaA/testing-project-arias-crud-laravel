@extends('layouts.app')

@section('content')
<div class="container task-container">
    <div class="row">
    @foreach($tasks->sortByDesc('id') as $task)
        <div class="col-md-3" id="taskCard-{{$task->id}}">
            <div class="card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline flex-wrap">
                        <h5 class="card-title text-break">{{ $task->title }}</h5>
                        <span class="badge text-bg-secondary">{{ $task->category }}</span>
                    </div>
                    <hr class="my-1">
                    <div class="d-flex justify-content-center">
                        <i class="bi bi-calendar3"></i>
                        <p class="ms-2 card-text">{{ $task->due_date }}</p>
                    </div>
                    <hr class="my-1">
                    <p class="card-text">{{ $task->description }}</p>
                    <div class="d-flex w-100 gap-2 justify-content-end">
                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editTaskModal-{{$task->id}}"><i class="bi bi-pencil-square"></i></button>
                        <button class="btn btn-outline-danger" onclick="deleteTask({{ $task->id }})"><i class="bi bi-trash3"></i></button>
                    </div>
                </div>
            </div>
        </div>

       <!-- Modal para editar tarea -->
        <div class="modal fade" id="editTaskModal-{{$task->id}}" tabindex="-1" aria-labelledby="editTaskModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTaskModalLabel">Edit Task</h5>
                        <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario para editar tarea -->
                        <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="editTaskForm" data-task-id="{{$task->id}}">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" value="{{ $task->title }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ $task->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Category</label>
                                <input type="text" class="form-control" id="category" name="category" value="{{ $task->category }}">
                            </div>
                            <div class="mb-3">
                                <label for="due_date" class="form-label">Due Date</label>
                                <input type="date" class="form-control" id="due_date" name="due_date" value="{{ $task->due_date }}" required>
                            </div>
                            <!-- Agrega los demás campos para editar -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <!-- Botón para confirmar la edición -->
                                <button type="submit" class="btn btn-primary">Update Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        @endforeach
    </div>
</div>

<!-- Modal para agregar tarea -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="addTaskModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addTaskModalLabel">Add Task</h5>
                <button type="button" class="btn-close text-light" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Formulario para agregar tarea -->
                <form action="{{ route('tasks.store') }}" method="POST" id="addTaskForm">
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-card-text"></i></span>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-file-earmark-text"></i></span>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-folder2-open"></i></span>
                            <input type="text" class="form-control" id="category" name="category">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="due_date" class="form-label">Due Date</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-calendar3"></i></span>
                            <input type="date" class="form-control" id="due_date" name="due_date">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save Task</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

<script>
// Definir la función deleteTask en el ámbito global
function deleteTask(taskId) {
    Swal.fire({
        title: `Are you sure you want to delete the task?`,
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar una solicitud AJAX para eliminar la tarea
            $.ajax({
                url: "{{ url('tasks') }}/" + taskId,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function(response) {
                    // Mostrar una alerta de SweetAlert si la operación fue exitosa
                    if (response.success) {
                        // Eliminar la tarjeta de la tarea eliminada
                        $(`#taskCard-${taskId}`).remove();
                        Swal.fire({
                            title: 'Deleted!',
                            text: 'The task has been deleted.',
                            icon: 'success'
                        });
                    }
                },
                error: function(xhr) {
                    // Manejar errores si es necesario
                    Swal.fire({
                        title: 'Error!',
                        text: 'There was an error deleting the task.',
                        icon: 'error'
                    });
                }
            });
        }
    });
}

$(document).ready(function() {
    // Escuchar el evento submit del formulario
    $('#addTaskForm').submit(function(e) {
        e.preventDefault();

        // Enviar la solicitud AJAX para agregar la tarea
        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                // Mostrar una alerta de SweetAlert si la operación fue exitosa
                if (response.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Task added successfully',
                        showConfirmButton: false,
                        timer: 1500
                    });

                    // Limpiar el formulario
                    $('#addTaskModal').modal('hide');
                    $('#addTaskForm')[0].reset();

                    // Insertar el nuevo elemento al DOM
                    const newTask = response.task;
                    const newTaskHtml = `
                        <div class="col-md-3" id="taskCard-${newTask.id}">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-baseline flex-wrap">
                                        <h5 class="card-title text-break">${newTask.title}</h5>
                                        <span class="badge text-bg-secondary">${newTask.category}</span>
                                    </div>
                                    <hr class="my-1">
                                    <div class="d-flex justify-content-center">
                                        <i class="bi bi-calendar3"></i>
                                        <p class="ms-2 card-text">${newTask.due_date}</p>
                                    </div>
                                    <hr class="my-1">
                                    <p class="card-text">${newTask.description}</p>
                                    <div class="d-flex w-100 gap-2 justify-content-end">
                                        <button class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#editTaskModal-${newTask.id}"><i class="bi bi-pencil-square"></i></button>
                                        <button class="btn btn-outline-danger" onclick="deleteTask(${newTask.id})"><i class="bi bi-trash3"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                    $('.row').prepend(newTaskHtml);
                }
            },
            error: function(xhr) {
                // Manejar errores si es necesario
            }
        });
    });
});

// Escuchar el evento submit del formulario de edición de tarea
$(document).on('submit', '.editTaskForm', function(e) {
    e.preventDefault();
    const taskId = $(this).data('task-id');

    // Mostrar una alerta de SweetAlert para confirmar la actualización
    Swal.fire({
        title: `Are you sure you want to update the task?`,
        text: 'This action cannot be undone!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'Cancel'
    }).then((result) => {
        if (result.isConfirmed) {
            // Enviar una solicitud AJAX para actualizar la tarea
            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: $(this).serialize(),
            });
            location.reload();
        }
    });
});

</script>

@endsection
