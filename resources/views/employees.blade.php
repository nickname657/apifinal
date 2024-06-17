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

                    <button type="button" onclick="newproduct()">añadir</button>


                </div>


                <div class="bg-white">

                    Formulario para actualizar Datos de un producto

                    <h1>Selecciona un producto a modificar</h1>
                    <div id="productos">

                    </div>
                    <label for="">Nuevo nombre</label><br>
                    <input id="newnameProduct" type="text"><br>
                    <label for="">Descripcion</label><br>
                    <input id="newdescriptionProduct" type="text"><br>
                    <label for="">Precio</label><br>
                    <input id="newpriceProduct" type="text"><br>
                    <button type="button" onclick="updatedataProduct()">Actualizar</button>



                </div>

                <div>

                    Formulario para eliminar producto

                    <h1>Selecciona un producto a eliminar</h1>
                    <div id="productos">

                    </div>
                    <button type="button" onclick="updatedataProduct()">Eliminar producto</button>



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
                    function newproduct() {
                        let name = document.getElementById('nameproduct').value;
                        let descript = document.getElementById('descript').value;
                        let cost = document.getElementById('cost').value;

                        let data = {
                            name: name,
                            description: descript,
                            cost: cost
                        }

                        console.log(data);

                        fetch(`{{ route('product.newproduct') }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Error al enviar los datos al servidor');
                            }
                            return response.json();
                        }).then(data => {
                            console.log('Respuesta del servidor:', data);
                        }).catch(error => {
                            console.error('Error en create cart:', error);
                        });
                    }

                    function updatedataProduct() {
                        let id = document.getElementById('selectproduct').value;
                        let name = document.getElementById('newnameProduct').value;
                        let descript = document.getElementById('newdescriptionProduct').value;
                        let cost = document.getElementById('newpriceProduct').value;

                        let data = {
                            id: id,
                            name: name,
                            description: descript,
                            cost: cost
                        }

                        console.log(data);

                        fetch(`{{ route('product.updateproduct') }}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: JSON.stringify(data)
                        }).then(response => {
                            if (!response.ok) {
                                throw new Error('Error al enviar los datos al servidor');
                            }
                            return response.json();
                        }).then(data => {
                            console.log('Respuesta del servidor:', data);
                        }).catch(error => {
                            console.error('Error en create cart:', error);
                        });
                    }

                    function displayData(data) {


                        let a = document.getElementById('productos');

                        a.innerHTML = '';

                        let sel = document.createElement('select');
                        sel.id = 'selectproduct';



                        data.forEach(element => {
                            let op = document.createElement('option');
                            op.value = element.id;
                            let text = document.createTextNode(element.name);
                            op.appendChild(text);
                            sel.appendChild(op);
                        });

                        a.appendChild(sel);
                    }


                    async function showproducts() {
                        try {
                            const response = await fetch(`{{ route('showp') }}`);
                            if (!response.ok) {
                                throw new Error('Error al obtener los datos del servidor');
                            }
                            const data = await response.json();
                            console.log("Respuesta de  pro:", data);
                            displayData(data);

                        } catch (error) {
                            console.error('Error en create cart:', error);
                        }
                    }
                </script>


            </div>
        </div>
    </div>
</x-app-layout>
