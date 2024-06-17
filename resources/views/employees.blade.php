<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">


                <div>
                    <button onclick="showproducts()">VEr productos</button>
                </div>
                <div>
                    <label for="">Fornulario para añadir un nuevo producto</label><br>
                    <label for="">Nombre</label>
                    <input id="nameproduct" type="text"><br>
                    <label for="">Descripcion</label>
                    <input id="descript" type="text"><br>
                    <label for="">Precio</label>
                    <input id="cost" type="number"><br>

                    <button type="button" onclick="">añadir</button>


                </div>


                <div class="bg-white">

                    Formulario para actualizar Datos de un producto

                    <h1>Selecciona un producto a modificar</h1>
                    <div id="productos">

                    </div>
                    <label for="">Nuevo nombre</label><br>
                    <label for="">Descripcion</label><br>
                    <label for="">Precio</label><br>
                    <input type="number" id="quantity"><br>
                    <button type="button" onclick="additem()">Actualizar</button>



                </div>

                <div>

                    Formulario para eliminar producto

                    <h1>Selecciona un producto a eliminar</h1>
                    <div id="productos">

                    </div>
                    <button type="button" onclick="additem()">Eliminar producto</button>



                </div>


                <div>

                    <h1>Selecciona un cliente</h1>
                    <div id="clientes">

                    </div>
                    <button type="button" onclick="additem()">VER EL HISTORIAL DE PEDIDOS</button>

                    <div id="productos">

                    </div>
                </div>


                <script>
                    function displayData(data) {


                        let a = document.getElementById('productos');

                        a.innerHTML = '';

                        let sel = document.createElement('select');


                        const datax = Object.entries(data).map(([id, name, price, description]) => ({
                            id,
                            name,
                            price,
                            description
                        }));

                        datax.forEach(element => {
                            let op = document.createElement('option');
                            op.value = element.id;
                            console.log(element);
                            let text = document.createTextNode(element.name);
                            op.appendChild(text);
                            sel.appendChild(op);
                        });

                        a.appendChild(sel);
                    }


                    function showproducts() {
                        fetch(`{{ route('showp') }}`, {
                                method: 'get',
                                headers: {
                                    'Content-Type': 'application/json',
                                }
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error('Error en la solicitud');
                                }
                                return response;
                            })
                            .then(data => {
                                console.log('Tipo de dato:', typeof data);
                                console.log("Datos del carrito:", data);
                                displayData(data);
                                return data;
                            })
                            .catch(error => {
                                console.error('Error al obtener productos:', error);
                            });
                    }
                </script>


            </div>
        </div>
    </div>
</x-app-layout>
