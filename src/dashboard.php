<?php

$title = "Dashboard";
$content = '
    <div class="p-4">
        <h2 class="text-xl font-bold mb-4">Bienvenido al Dashboard de SIMAQ</h2>

        <!-- Resúmenes o estadísticas rápidas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="bg-white shadow rounded p-4">
                <h3 class="font-bold text-lg">Empleados Activos</h3>
                <p>50</p>
                <!-- Más información si es necesario -->
            </div>

            <div class="bg-white shadow rounded p-4">
                <h3 class="font-bold text-lg">Nómina Pendiente</h3>
                <p>$10,000</p>
                <!-- Más información si es necesario -->
            </div>

            <div class="bg-white shadow rounded p-4">
                <h3 class="font-bold text-lg">Alertas</h3>
                <p>Ninguna alerta actual</p>
                <!-- Más información si es necesario -->
            </div>
        </div>

        <!-- Otras secciones del dashboard aquí -->
    </div>
';

$content .= '
    <!-- Gráficas -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
        <!-- Gráfico de Barras -->
        <div class="bg-white shadow rounded p-4">
            <h3 class="font-bold text-lg">Reporte de Nómina Mensual</h3>
            <canvas id="barChart"></canvas>
        </div>

        <!-- Gráfico Circular -->
        <div class="bg-white shadow rounded p-4">
            <h3 class="font-bold text-lg">Distribución por Departamento</h3>
            <canvas id="pieChart"></canvas>
        </div>
    </div>
';


$content .= '
    <script>
        // Gráfico de Barras
        var ctxBar = document.getElementById("barChart").getContext("2d");
        var barChart = new Chart(ctxBar, {
            type: "bar",
            data: {
                labels: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio"],
                datasets: [{
                    label: "Nómina",
                    data: [12000, 19000, 3000, 5000, 2000, 3000],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.2)",
                        "rgba(54, 162, 235, 0.2)",
                        "rgba(255, 206, 86, 0.2)",
                        "rgba(75, 192, 192, 0.2)",
                        "rgba(153, 102, 255, 0.2)",
                        "rgba(255, 159, 64, 0.2)"
                    ],
                    borderColor: [
                        "rgba(255, 99, 132, 1)",
                        "rgba(54, 162, 235, 1)",
                        "rgba(255, 206, 86, 1)",
                        "rgba(75, 192, 192, 1)",
                        "rgba(153, 102, 255, 1)",
                        "rgba(255, 159, 64, 1)"
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        // Gráfico Circular
        var ctxPie = document.getElementById("pieChart").getContext("2d");
        var pieChart = new Chart(ctxPie, {
            type: "pie",
            data: {
                labels: ["Finanzas", "RRHH", "IT", "Ventas"],
                datasets: [{
                    data: [10, 20, 30, 40],
                    backgroundColor: [
                        "rgba(255, 99, 132, 0.5)",
                        "rgba(54, 162, 235, 0.5)",
                        "rgba(255, 206, 86, 0.5)",
                        "rgba(75, 192, 192, 0.5)"
                    ]
                }]
            }
        });
    </script>
';

include('layout.php');
