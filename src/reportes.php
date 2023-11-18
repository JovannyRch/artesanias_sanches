<?php
$title = "Reportes";

$content = '
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Generación de Reportes</h2>

        <!-- Formulario para seleccionar y generar reportes -->
        <div class="bg-white shadow rounded p-4 mb-4">
            <form action="" method="post">
                <!-- Selector de tipo de reporte -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="tipoReporte">Tipo de Reporte:</label>
                    <select class="shadow border rounded w-full py-2 px-3 text-gray-700" id="tipoReporte" name="tipoReporte">
                        <option value="mensual">Reporte Mensual</option>
                        <option value="departamento">Por Departamento</option>
                        <!-- Más opciones según los tipos de reportes disponibles -->
                    </select>
                </div>

                <!-- Selector de rango de fechas -->
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fechaInicio">Fecha Inicio:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" id="fechaInicio" name="fechaInicio" type="date">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="fechaFin">Fecha Fin:</label>
                    <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700" id="fechaFin" name="fechaFin" type="date">
                </div>

                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline mt-4" type="submit">
                    Generar Reporte
                </button>
            </form>
        </div>

        <!-- Aquí se podrían mostrar los reportes generados o las opciones de descarga -->
    </div>
';

include('layout.php');
