<?php
include_once './const.php';
include_once './db.php';


session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$title = "Cálculo de Nómina";
$db = new Database();



?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo $title ?> - SIMAQ</title>
    <script src="./assets/tailwind.js"></script>
    <script src="./assets/chart.js"></script>
    <script src="./assets/vue.js"></script>
    <script src="./assets/axios.js"></script>
    <link rel="stylesheet" href="./assets/flowbite.css" />
</head>

<body class="bg-gray-100 flex flex-col min-h-screen dark:bg-gray-900 antialiased">
    <header class="sticky top-0 z-40 flex-none w-full mx-auto bg-white border-b border-gray-200 dark:border-gray-600 dark:bg-gray-800">
        <div class="flex items-center justify-between w-full px-3 py-3 mx-auto max-w-8xl lg:px-4">
            <div class="flex items-center">
                <button id="toggleSidebarMobile" aria-expanded="true" aria-controls="sidebar" class="p-2 mr-2 text-gray-500 rounded cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                    <svg id="toggleSidebarMobileHamburger" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    </svg>
                    <svg id="toggleSidebarMobileClose" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="flex items-center justify-between">
                    <a href="/" class="flex">
                        <img src="./assets/logo.png" alt="Imagen de ejemplo" class="inline-block h-8" />
                        <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white ml-4">
                            SIMAQ
                        </span>
                    </a>
                </div>
            </div>

            <div class="flex items-center">
                <ul id="flowbiteMenu" class="flex-col hidden pt-6 lg:flex-row lg:self-center lg:py-0 lg:flex">
                    <?php foreach ($menu as $item) { ?>
                        <li class="mb-3 lg:px-2 xl:px-2 lg:mb-0">
                            <a href="<?php echo $item['url']; ?>" class="text-sm font-medium text-gray-900 hover:text-blue-600 dark:text-gray-300 dark:hover:text-blue-500"><?php echo $item['title']; ?></a>
                        </li>
                    <?php } ?>
                </ul>

                <a href="./logout.php" class="hidden xl:inline-flex items-center text-white bg-blue-600 hover:bg-blue-600 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center ml-1 sm:ml-3">
                    Cerrar sesión
                </a>
            </div>
        </div>
    </header>

    <!-- Contenido Principal -->
    <main class="container mx-auto p-4 flex-1" id="app">
        <h1 class="inline-block mb-2 text-3xl font-extrabold tracking-tight text-gray-900 dark:text-white mb-8">
            <?php echo $title ?>
        </h1>

        <form class="md:w-1/2 sm:w-full" @submit.prevent="onSubmit">
            <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Buscar</label>
            <div class="relative">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input v-model="search" type="search" name="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Ingrese nombre o id del empleado" required />
                <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                    Buscar
                </button>
            </div>
        </form>

        <div v-if="resultados !== null && empleadoSeleccionado === null">


            <div v-if="resultados.length == 0" class="font-bold w-full text-center text-lg h-[200px] flex flex-col items center justify-center">
                No se encontraron resultados
            </div>
            <div v-else class="pt-4">
                <h4 class="font-bold w-full text-lg mb-4">Resultados de la búsqueda</h4>
                <ul class="max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="pb-3 sm:pb-4" v-for="item in resultados">
                        <div class="flex items-center space-x-4 rtl:space-x-reverse">

                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{`${item.nombre} ${item.paterno} ${item.materno}` }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    ID: {{item.id}}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <button @click="empleadoSeleccionado = item" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                    Seleccionar
                                </button>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div v-if="empleadoSeleccionado !== null" class="pt-5">



            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                    {{empleadoSeleccionado.nombre}} {{empleadoSeleccionado.paterno}} {{empleadoSeleccionado.materno}}
                </h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                    {{empleadoSeleccionado.cargo}}
                </p>
                <b class="mb-3 font-bold">
                    Sueldo bruto: {{formatCurrencyFunction(empleadoSeleccionado.salario)}}
                </b>
                <hr class="my-5" />

                <!-- Periodo form -->
                <div class="flex flex-col gap-4 mt-4 w-full md:w-1/2">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Periodo laboral
                    </h5>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="periodo-inicio" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periodo inicio</label>
                            <input v-model="periodoInicio" type="date" name="periodo-inicio" id="periodo-inicio" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>
                        <div class="flex-1">
                            <label for="periodo-fin" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Periodo fin</label>
                            <input v-model="periodoFin" type="date" name="periodo-fin" id="periodo-fin" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        </div>
                    </div>
                    <div class="flex justify-end items-center gap-2 p-4">
                        <b>
                            Días de pago:
                        </b>
                        <b>
                            {{diasDePago}}
                        </b>
                    </div>
                </div>


                <hr class="my-5" />

                <div class="w-full">
                    <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                        Horas extra
                    </h5>

                    <div class="flex gap-4 w-full md:w-1/2">


                        <!-- Horas extra -->
                        <div class="flex-1">
                            <label for="horas-extra" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cantidad de horas extra</label>
                            <input @change="actualizarDatos" v-model="horasExtra" type="number" name="horas-extra" id="horas-extra" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />
                        </div>

                        <!-- Precio por hora -->
                        <div class="flex-1">
                            <label for="precio-hora" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pago por hora</label>
                            <input @change="actualizarDatos" v-model="precioPorHorasExtra" type="number" name="precio-hora" id="precio-hora" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />
                        </div>
                    </div>
                    <div class="flex justify-end items-center gap-2 p-4 w-full md:w-1/2">
                        <b>
                            Pago total por horas extra:
                        </b>
                        <b>
                            {{formatCurrencyFunction(pagoPorHorasExtra)}}
                        </b>
                    </div>
                    <hr class="my-5" />

                    <!-- Deducciones -->
                    <div class="flex flex-col gap-4 mt-4">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Percepciones
                        </h5>
                        <div class="flex flex-col gap-4">
                            <form>
                                <div class="flex gap-4">
                                    <div class="flex-1">
                                        <label for="asignacion-concepto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Concepto</label>
                                        <input v-model="asignacionConcepto" type="text" name="asignacion-concepto" id="asignacion-concepto" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Concepto" required />
                                    </div>
                                    <div class="flex-1">
                                        <label for="asignacion-valor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cantidad</label>
                                        <div class="flex justify-center items-center gap-2">
                                            <b>
                                                $
                                            </b>
                                            <input v-model="asignacionValor" @change="onChangeAsignacionValue" type="number" name="asignacion-valor" id="asignacion-valor" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />
                                        </div>
                                    </div>

                                    <div class="flex-1">

                                        <label for="asignacion-porcentaje" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Porcentaje</label>
                                        <div class="flex items-center justify-center gap-2">
                                            <input v-model="asignacionPorcentaje" @change="onChangeAsignacionPorcentaje" type="number" name="asignacion-porcentaje" id="asignacion-porcentaje" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />
                                            <b>
                                                %
                                            </b>
                                        </div>
                                    </div>

                                    <div class="flex-1 flex flex-col justify-center items-start">
                                        <button @click.prevent="agregarAsignacion(asignacionConcepto, asignacionValor)" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                            Aplicar
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4" v-if="asignaciones.length !== 0">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Concepto
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Cantidad
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(asignacion, index) in asignaciones" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{asignacion.concepto}}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{formatCurrencyFunction(asignacion.valor)}}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button @click.prevent="quitarAsignacion(index)" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                                    Quitar
                                                </button>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Add total -->
                                <div class="flex justify-end items-center gap-2 p-4">
                                    <b>
                                        Percepciones totales:
                                    </b>
                                    <b>
                                        {{formatCurrencyFunction(totalAsignaciones)}}
                                    </b>
                                </div>
                            </div>

                        </div>

                    </div>
                    <hr class="my-5" />
                    <div class="flex flex-col gap-4 mt-4">
                        <h5 class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white">
                            Deducciones
                        </h5>

                        <div class="flex gap-4">
                            <button type="button" class="text-red-700 hover:text-white border border-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-red-900" v-for="item in deduccionesPreestablecidas" @click="onAplicarDeduccionPrestablecidad(item)">
                                {{item.nombre}} - {{item.porcentaje}}%
                            </button>
                        </div>

                        <div class="flex flex-col gap-4">
                            <form>
                                <div class="flex gap-4">
                                    <div class="flex-1">
                                        <label for="deduccion-concepto" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Concepto</label>
                                        <input v-model="deduccionConcepto" type="text" name="deduccion-concepto" id="deduccion-concepto" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Concepto" required />
                                    </div>
                                    <div class="flex-1">
                                        <label for="deduccion-valor" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cantidad</label>
                                        <div class="flex justify-center items-center gap-2">
                                            <b>
                                                $
                                            </b>
                                            <input v-model="deduccionValor" @change="onChangeDeduccionValue" type="number" name="deduccion-valor" id="deduccion-valor" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />
                                        </div>
                                    </div>

                                    <div class="flex-1">

                                        <label for="deduccion-porcentaje" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Porcentaje</label>
                                        <div class="flex items-center justify-center gap-2">
                                            <input v-model="deduccionPorcentaje" @change="onChangeDeduccionPorcentaje" type="number" name="deduccion-porcentaje" id="deduccion-porcentaje" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="0" required />
                                            <b>
                                                %
                                            </b>
                                        </div>
                                    </div>

                                    <div class="flex-1 flex flex-col justify-center items-start">
                                        <button @click.prevent="agregarDeduccion(deduccionConcepto, deduccionValor)" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                            Aplicar
                                        </button>
                                    </div>
                                </div>
                            </form>

                            <div class="relative overflow-x-auto shadow-md sm:rounded-lg mt-4" v-if="deducciones.length !== 0">
                                <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                        <tr>
                                            <th scope="col" class="px-6 py-3">
                                                Concepto
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Cantidad
                                            </th>
                                            <th scope="col" class="px-6 py-3">
                                                Acción
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(deduccion, index) in deducciones" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                {{deduccion.concepto}}
                                            </th>
                                            <td class="px-6 py-4">
                                                {{formatCurrencyFunction(deduccion.valor)}}
                                            </td>
                                            <td class="px-6 py-4">
                                                <button @click.prevent="quitarDeduccion(index)" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-red-600 dark:hover:bg-red-600 dark:focus:ring-red-800">
                                                    Quitar
                                                </button>
                                            </td>

                                        </tr>
                                    </tbody>
                                </table>
                                <!-- Add total -->
                                <div class="flex justify-end items-center gap-2 p-4">
                                    <b>
                                        Deducciones totales:
                                    </b>
                                    <b>
                                        {{formatCurrencyFunction(totalDeducciones)}}
                                    </b>
                                </div>
                            </div>
                            <hr class="my-5" />

                            <!-- Add comentarios text area -->
                            <!--    <div class="flex flex-col gap-4 mt-4">
                                <label for="comentarios" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Comentarios</label>
                                <textarea v-model="comentarios" name="comentarios" id="comentarios" cols="30" rows="2" class="block w-full p-4 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"></textarea>
                            </div>
 -->


                            <hr class="my-5" />

                            <!-- Show sueldo neto -->

                            <div class="flex justify-end items-center gap-2 p-4 text-3xl">
                                <div class="flex flex-col">
                                    <div>
                                        <b>
                                            Sueldo neto:
                                        </b>
                                        <b>
                                            {{formatCurrencyFunction(salarioNeto)}}
                                        </b>
                                    </div>

                                    <div class="flex justify-end mt-5">

                                        <button type="submit" @click="guardar" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-blue-600 dark:hover:bg-blue-600 dark:focus:ring-blue-800">
                                            Guardar
                                        </button>
                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>

                </div>
    </main>

    <footer class="bg-blue-600 text-white mt-8 w-screen">
        <div class="container mx-auto p-4 text-center">
            <p>
                &copy;
                <?php echo date("Y"); ?>
                SIMAQ - Todos los derechos reservados
            </p>
        </div>
    </footer>
    <script>
        const config = {
            headers: {
                "Content-Type": "multipart/form-data"
            }
        };



        const app = new Vue({
            el: "#app",
            data: {
                search: "",
                resultados: null,
                periodoInicio: null,
                periodoFin: null,
                empleadoSeleccionado: null,
                horasExtra: 0,
                precioPorHorasExtra: 0.0,
                asignaciones: [],
                deducciones: [],
                asignacionConcepto: "",
                asignacionValor: 0.0,
                asignacionPorcentaje: 0.0,
                deduccionConcepto: "",
                deduccionValor: 0.0,
                deduccionPorcentaje: 0.0,
                totalAsignaciones: 0.0,
                totalDeducciones: 0.0,
                salarioNeto: 0.0,
                comentarios: "",
                deduccionesPreestablecidas: [{
                        nombre: "ISR",
                        porcentaje: 10.0,
                    },
                    {
                        nombre: "IMSS",
                        porcentaje: 5.0,
                    },

                    {
                        nombre: "INFONAVIT",
                        porcentaje: 5.0,
                    }, {
                        nombre: "AFORE",
                        porcentaje: 1.125,
                    }

                ]
            },
            methods: {
                onSubmit: async function() {
                    this.empleadoSeleccionado = null;
                    const response = await axios.post(
                        "/api.php", {
                            servicio: "buscarEmpleado",
                            search: this.search,
                        },
                        config
                    );
                    this.resultados = response.data;
                },
                formatCurrencyFunction: (value) => {
                    return new Intl.NumberFormat('es-MX', {
                        style: 'currency',
                        currency: 'MXN',
                        minimumFractionDigits: 0
                    }).format(value);
                },
                agregarAsignacion: function(concepto, valor) {

                    this.asignaciones.push({
                        concepto,
                        valor
                    });
                    this.asignacionConcepto = "";
                    this.asignacionValor = 0.0;
                    this.asignacionPorcentaje = 0.0;

                    this.actualizarDatos();

                },
                quitarAsignacion: function(index) {
                    this.asignaciones.splice(index, 1);
                    this.actualizarDatos();
                },
                agregarDeduccion: function(concepto, valor) {
                    this.deducciones.push({
                        concepto,
                        valor
                    });

                    this.deduccionConcepto = "";
                    this.deduccionValor = 0.0;
                    this.deduccionPorcentaje = 0.0;

                    this.actualizarDatos();

                },
                quitarDeduccion: function(index) {
                    this.deducciones.splice(index, 1);
                    this.actualizarDatos();

                },
                actualizarDatos: function() {
                    this.totalAsignaciones = this.sumarArreglo(this.asignaciones);
                    this.totalDeducciones = this.sumarArreglo(this.deducciones);
                    this.calcularSalarioNeto();
                },
                sumarArreglo: function(items) {
                    let total = 0.0;

                    items.forEach(item => {
                        total += Number(item.valor);
                    });

                    return total;
                },
                calcularSalarioNeto: function() {
                    this.salarioNeto = Number(this.empleadoSeleccionado.salario) + this.totalAsignaciones - this.totalDeducciones;
                    this.salarioNeto += this.horasExtra * this.precioPorHorasExtra;
                },

                onChangeAsignacionPorcentaje: function() {
                    this.asignacionValor = this.empleadoSeleccionado.salario * (this.asignacionPorcentaje / 100);
                },
                onChangeDeduccionPorcentaje: function() {
                    this.deduccionValor = this.empleadoSeleccionado.salario * (this.deduccionPorcentaje / 100);
                },
                onChangeAsignacionValue: function() {
                    this.asignacionPorcentaje = (this.asignacionValor / this.empleadoSeleccionado.salario) * 100;

                    this.asignacionPorcentaje = Math.ceil(this.asignacionPorcentaje);
                },
                onChangeDeduccionValue: function() {
                    this.deduccionPorcentaje = (this.deduccionValor / this.empleadoSeleccionado.salario) * 100;

                    this.deduccionPorcentaje = Math.ceil(this.deduccionPorcentaje);
                },
                onAplicarDeduccionPrestablecidad: function(deduccion) {
                    this.deduccionConcepto = deduccion.nombre;
                    this.deduccionValor = this.empleadoSeleccionado.salario * (deduccion.porcentaje / 100);
                    this.deduccionPorcentaje = deduccion.porcentaje;
                },
                guardar: async function() {
                    const data = {
                        empleado_id: this.empleadoSeleccionado.id,
                        periodo_inicio: this.periodoInicio,
                        periodo_fin: this.periodoFin,
                        horas_extras: this.horasExtra,
                        precio_por_horas_extra: this.precioPorHorasExtra,
                        asignaciones: this.asignaciones ?? [],
                        deducciones: this.deducciones ?? [],
                        total_asignaciones: this.totalAsignaciones,
                        total_deducciones: this.totalDeducciones,
                        comentarios: this.comentarios,
                        salario_neto: this.salarioNeto,
                        dias_de_pago: this.diasDePago,
                        salario_bruto: this.empleadoSeleccionado.salario,
                    };

                    const response = await axios.post(
                        "/api.php", {
                            servicio: "guardarNomina",
                            data,
                        },
                        config
                    )

                    console.log("response", response);
                    const idNomina = response.data.id;

                    //check if is a number
                    if (idNomina !== null && !isNaN(idNomina)) {
                        window.location.href = `/detalles_nomina.php?id=${idNomina}`;
                    } else {
                        alert("Ocurrió un error al guardar la nómina");
                    }
                }
            },
            created: function() {
                //Set default values
                const today = new Date();

                const inicio = new Date(today.getFullYear(), today.getMonth() - 1, today.getDate());
                const fin = new Date(today.getFullYear(), today.getMonth(), today.getDate());

                this.periodoInicio = inicio.toISOString().split('T')[0];
                this.periodoFin = fin.toISOString().split('T')[0];



            },
            computed: {
                pagoPorHorasExtra: function() {
                    return this.horasExtra * this.precioPorHorasExtra;
                },
                porcentajeAsingacionAplicado: function() {
                    return (this.asignacionValor / this.empleadoSeleccionado.salario) * 100;
                },
                porcentajeDeduccionAplicado: function() {
                    return (this.deduccionValor / this.empleadoSeleccionado.salario) * 100;
                },
                diasDePago: function() {
                    if (this.periodoInicio === null || this.periodoFin === null) {
                        return 0;
                    }

                    // To calculate the time difference of two dates from period inputs
                    const inicioDate = new Date(this.periodoInicio);
                    const finDate = new Date(this.periodoFin);

                    const diffTime = Math.abs(finDate - inicioDate);
                    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                    return diffDays;
                },
            },

        });
    </script>
    <script src="./assets/flowbite.css"></script>
</body>

</html>