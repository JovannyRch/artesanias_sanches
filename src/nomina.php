<?php
$title = "Cálculo de Nómina";
$content = '
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Cálculo de Nómina</h2>

        <!-- Formulario para calcular la nómina -->
        <div class="bg-white shadow rounded p-4 mb-4">
            <form action="" method="post">
                <!-- Campos del formulario -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="empleado">Empleado:</label>
                    <select class="shadow border rounded w-full py-2 px-3 text-gray-700" id="empleado" name="empleado">
                        <!-- Opciones de empleados -->
                        <option value="1">John Doe</option>
                        <!-- Más opciones -->
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="horas">Horas Trabajadas:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" id="horas" name="horas" type="number" min="0">
                </div>

                <!-- Agregar más campos según sea necesario -->

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4" type="submit">
                    Calcular
                </button>
            </form>
        </div>

        <!-- Resultados de la nómina -->
        <!-- Aquí puedes mostrar los resultados después de un cálculo -->
    </div>
';

include('layout.php');
