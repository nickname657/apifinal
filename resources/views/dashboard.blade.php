<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>

    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>


                <div>
                    <button type="button" onclick="showcart()">show cart</button>
                </div>

                <div>
                    <button type="button" onclick="showproducts()">show products</button>
                </div>



                <div id="selcat">
                    <h1>Selecciona una categoría</h1>
                    <select name="sel" id="sel">
                        <option value="1">Primera</option>
                        <option value="2">Segunda</option>
                    </select>
                </div>




                <div>
                    <h1>selecciona un producto a añadir al carrito</h1>
                    <div id="data">

                    </div>
                    <input type="number" id="quantity">
                    <button type="button" onclick="additem()">enviar</button>
                </div>


                <div class="container mx-auto py-8">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Producto</th>
                                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Cantidad</th>
                                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Precio Unitario</th>
                                    <th class="w-1/3 py-3 px-4 uppercase font-semibold text-sm">Acciones</th>
                                </tr>
                            </thead>
                            <tbody id="tbody" class="text-gray-700">

                            </tbody>
                        </table>
                    </div>
                </div>



                <script>
                    const showUrl = 'http://127.0.0.1:8000/api/getall';
                    const proUrl = 'http://127.0.0.1:8000/api/showp';
                    const postsel = 'http://127.0.0.1:8000/api/filterprod';


                    async function showproducts() {
                        try {
                            const response = await fetch(proUrl);
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

                    function totalmount() {
                        fetch(`{{ route('cart.calculateTotalAmount') }}`, {
                                method: 'GET',
                                headers: {
                                    'Content-Type': 'application/json',
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Error en la solicitud');
                                }
                                return response;
                            })
                            .then(data => {
                                console.log('Tipo de dato:', typeof data);
                                return data;
                            })
                            .catch(error => {
                                console.error('Error al calcular el monto:', error);
                            });
                    }


                    function additem() {

                        let productId = document.getElementById('data').querySelector('select').value;
                        let quantity = document.getElementById('quantity').value;

                        fetch(`{{ route('cart.addprod') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    productId: productId,
                                    quantity: quantity
                                })
                            }).then(response => response)
                            .then(data => console.log(data));
                    }


                    function pay() {

                        let totalamount = document.getElementById('total').value;
                        let stat = "pagado";
                        


                        fetch(`{{ route('cart.storeorder') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    totalamount: totalamount,
                                    status: stat
                                })
                            }).then(response => response)
                            .then(data => console.log(data));
                    }



                    function displayData(data) {
                        let a = document.getElementById('data');

                        a.innerHTML = '';

                        let sel = document.createElement('select');

                        data.forEach(element => {
                            let op = document.createElement('option');
                            op.value = element.id;
                            let text = document.createTextNode(element.name);
                            op.appendChild(text);
                            sel.appendChild(op);
                        });

                        a.appendChild(sel);
                    }



                    async function showcart() {
                        try {
                            const response = await fetch(showUrl);
                            if (!response.ok) {
                                throw new Error('Error al obtener los datos del servidor');
                            }
                            const data = await response.json();
                            console.log("Datos del carrito:", typeof data, data);
                            const datax = Object.entries(data).map(([name, price]) => ({
                                name,
                                price
                            }));
                            let secondata = totalmount();

                            console.log("Datos del carrito:", typeof datax, datax);
                            displayItems(datax);

                        } catch (error) {
                            console.error('Error en show cart:', error);
                        }
                    }


                    function displayItems(data) {


                        let tbody = document.getElementById('tbody');

                        tbody.innerHTML = '';


                        let trpay = document.createElement('tr');
                        let tdpay1 = document.createElement('td');
                        tdpay1.className = 'w-1/3 py-3 px-4';
                        let tday1text = document.createTextNode('Total a pagar');
                        let tdpay2 = document.createElement('td');
                        tdpay2.className = 'w-1/3 py-3 px-4';
                        td2span = document.createElement('span');
                        td2span.className = 'text-green-500';
                        td2span.id = 'total';
                        td2span.value = '12345';
                        let total = document.createTextNode('12345');
                        td2span.appendChild(total);
                        let tdpay3 = document.createElement('td');
                        tdpay3.className = 'w-1/3 py-3 px-4';
                        let tdpay4 = document.createElement('td');
                        tdpay4.className = 'w-1/3 py-3 px-4';
                        let td5button = document.createElement('button');
                        let td5buttontext = document.createTextNode('Pagar');
                        td5button.className = 'bg-green-100 text-white py-1 px-3 rounded';
                        td5button.onclick = function() {
                            pay();
                        };

                        data.forEach(element => {

                            let tr = document.createElement('tr');
                            let td = document.createElement('td');
                            td.className = 'w-1/3 py-3 px-4';


                            let td2 = document.createElement('td');
                            td2.className = 'w-1/3 py-3 px-4';


                            let n = document.createTextNode(element.name);
                            let input = document.createElement('input');

                            let td3 = document.createElement('td');
                            //precio del producto
                            let texttd3 = document.createTextNode(element.price);

                            let td4 = document.createElement('td');

                            let buttonupd = document.createElement('button');
                            let buttonupdtext = document.createTextNode('Actualizar');
                            buttonupd.className = 'bg-green-100 text-white py-1 px-3 rounded';
                            buttonupd.onclick = function() {
                                updateQuantity(element.name, input.value);
                            };

                            let buttondel = document.createElement('button');
                            let buttondeltext = document.createTextNode('Eliminar');
                            buttondel.className = 'bg-red-500 text-white py-1 px-3 rounded';
                            buttondel.onclick = function() {
                                deleteProduct(element.name);
                            };



                            input.type = 'number';
                            input.value = element.quantity;
                            input.min = 1;
                            input.className = 'w-full py-1 px-2 border border-gray-300 rounded';
                            td2.appendChild(input);

                            td3.className = 'w-1/3 py-3 px-4';
                            td3.appendChild(texttd3);

                            td4.className = 'w-1/3 py-3 px-4';

                            td.appendChild(n);
                            tbody.appendChild(tr);
                            tr.appendChild(td);
                            tr.appendChild(td2);
                            tr.appendChild(td3);
                            tr.appendChild(td4);

                            td4.appendChild(buttonupd);
                            buttonupd.appendChild(buttonupdtext);

                            td4.appendChild(buttondel);
                            buttondel.appendChild(buttondeltext);



                        });


                        tbody.appendChild(trpay);
                        trpay.appendChild(tdpay1);
                        tdpay1.appendChild(tday1text);
                        trpay.appendChild(tdpay2);
                        tdpay2.appendChild(td2span);
                        trpay.appendChild(tdpay3);
                        trpay.appendChild(tdpay4);
                        tdpay4.appendChild(td5button);
                        td5button.appendChild(td5buttontext);


                    }




                    document.getElementById('sel').addEventListener('change', function() {
                        var selectedValue = this.value;

                        fetch(postsel, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                },
                                body: JSON.stringify({
                                    categoryId: selectedValue
                                })
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                console.log('Respuesta recibida:', data);
                            })
                            .catch(error => {
                                console.error('Error al hacer la solicitud:', error);
                            });
                    });


                    function updateQuantity(productId, quantity) {
                        fetch(`{{ route('cart.updateitem') }}`, {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    productId: productId,
                                    quantity: quantity
                                })
                            }).then(response => response)
                            .then(data => console.log(data));
                    }

                    function deleteProduct(productId) {


                        fetch(`{{ route('cart.deleteitem') }}`, {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    productId: productId
                                })
                            }).then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.text();
                            })
                            .then(data => {
                                if (data) {
                                    return JSON.parse(data);
                                }
                            })
                            .then(parsedData => console.log(parsedData))
                            .catch(error => console.error(`Fetch Error: ${error}`));
                    }
                </script>


            </div>
        </div>
    </div>
</x-app-layout>
