<?php
$title = "Gestión de Empleados";
$content = '
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Gestión de Empleados</h2>

        <!-- Formulario para añadir o editar empleados -->
        <div class="bg-white shadow rounded p-4 mb-4">
            <form action="" method="post">
                <!-- Campos del formulario -->
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nombre">Nombre:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" id="nombre" name="nombre" type="text" required>
                </div>
                <!-- Agregar más campos según sea necesario -->

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4" type="submit">
                    Guardar
                </button>
            </form>
        </div>

        <!-- Tabla de empleados -->
        <div class="bg-white shadow rounded p-4">
            <table class="table-auto w-full">
                <thead>
                    <tr>
                        <th class="border px-4 py-2">Nombre</th>
                        <th class="border px-4 py-2">Departamento</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="border px-4 py-2">John Doe</td>
                        <td class="border px-4 py-2">Ventas</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Jane Doe</td>
                        <td class="border px-4 py-2">Ventas</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Jane Doe</td>
                        <td class="border px-4 py-2">Ventas</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Jane Doe</td>
                        <td class="border px-4 py-2">Ventas</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Jane Doe</td>
                        <td class="border px-4 py-2">Ventas</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Jane Doe</td>
                        <td class="border px-4 py-2">Ventas</td>
                    </tr>
                    <tr>
                        <td class="border px-4 py-2">Jane Doe</td>
                        <td class="border px-4 py-2">Ventas</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
';


include('layout.php');
