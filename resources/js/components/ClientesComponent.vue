<template>
    <div class="container">
        <div class="row" v-if="nuevo">
            <div class="col-6">
                <h2>Agregar Clientes</h2>
                <form action="">
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input class="form-control" type="text" name="nombre" id="nombre" v-model="dataCliente.nombre">
                        <small style="color:red" v-for="(e_nombre, index) in errors.nombre" :key="index">{{e_nombre}}</small>
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido paterno:</label>
                        <input class="form-control" type="text" name="apellido_paterno" id="apellido_paterno" v-model="dataCliente.apellido_paterno">
                        <small style="color:red" v-for="(e_apellido_paterno, index) in errors.apellido_paterno" :key="index">{{e_apellido_paterno}}</small>
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido materno:</label>
                        <input class="form-control" type="text" name="apellido_paterno" id="apellido_materno" v-model="dataCliente.apellido_materno">
                        <small style="color:red" v-for="(e_apellido_materno, index) in errors.apellido_materno" :key="index">{{e_apellido_materno}}</small>
                    </div>
                    <div class="form-group">
                        <label for="domicilio">Domicilio:</label>
                        <input class="form-control" type="text" name="domicilio" id="domicilio" v-model="dataCliente.domicilio">
                        <small style="color:red" v-for="(e_domicilio, index) in errors.domicilio" :key="index">{{e_domicilio}}</small>
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo electrónico:</label>
                        <input class="form-control" type="text" name="correo_electronico" id="correo_electronico" v-model="dataCliente.correo_electronico">
                        <small style="color:red" v-for="(e_correo_electronico, index) in errors.correo_electronico" :key="index">{{e_correo_electronico}}</small>
                    </div>
                    <br>
                    <button v-if="opcion=='guardar'" class="btn btn-primary" @click.prevent="guardar()">Guardar</button>
                    <button v-if="opcion=='modificar'" class="btn btn-primary" @click.prevent="modificar()">Modificar</button>
                </form>
            </div>
        </div>
        <hr>
        <div class="row" v-if="nuevo==0">
            <div class="col-12">
                <button class="btn btn-primary" @click.prevent="agregarCliente()">Agregar</button>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Domicilio</th>
                            <th>Correo electrónico</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="cliente in clientes" :key="cliente.id">
                            <td>
                                {{cliente.id}}
                            </td>
                            <td>
                                {{cliente.nombre}} {{cliente.apellido_paterno}} {{cliente.apellido_materno}}
                            </td>
                            <td>
                                {{cliente.domicilio}}
                            </td>
                            <td>
                                {{cliente.correo_electronico}}
                            </td>
                            <td>
                                <div class="row">
                                    <div class="col-6">
                                        <button class="btn btn-warning btn-sm" @click="editar(cliente)">Editar</button>
                                    </div>
                                    <div class="col-6">
                                        <button class="btn btn-danger btn-sm" @click="eliminar(cliente.id)">Eliminar</button>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>
<script>

import axios from 'axios';
export default {
    data() {
        return {
            nuevo:0,
            opcion:'guardar',
            errors:[],
            invalid:{
                'nombre':0,
                'apellido_paterno':0,
                'apellido_materno':0,
                'domicilio':0,
                'correo_electronico':0,
            },
            clientes:[],
            dataCliente:{
                nombre:'',
                apellido_paterno:'',
                apellido_materno:'',
                domicilio:'',
                correo_electronico:'',
            },
            cliente_id:'',
        }
    },
    methods: {
        agregarCliente(){
            this.nuevo = 1;
            this.reiniciarMensajesError();
            this.limpiarCampos();
        },
        eliminar(id){
            if(window.confirm("¿Quieres eliminar realmente este registro?")){
                axios.delete('clientes/'+id).then(response=>{
                    if(response && response.data.statusCode ==200){
                        alert("Registro eliminado correctamente");
                        this.obtenerClientes();
                    }
                })
            }
        },
        reiniciarMensajesError(){
            for(let inval in this.invalid){
                this.invalid[inval]=0;
            }
        },
        limpiarCampos(){
            this.opcion= 'guardar';
            this.cliente_id =  '';
            this.dataCliente.nombre = '';
            this.dataCliente.apellido_paterno = '';
            this.dataCliente.apellido_materno = '';
            this.dataCliente.domicilio = '';
            this.dataCliente.correo_electronico = '';
        },
        editar(cliente){
            this.nuevo=1;
            this.opcion= 'modificar';
            this.cliente_id =  cliente.id;
            this.dataCliente.nombre = cliente.nombre;
            this.dataCliente.apellido_paterno = cliente.apellido_paterno;
            this.dataCliente.apellido_materno = cliente.apellido_materno;
            this.dataCliente.domicilio = cliente.domicilio;
            this.dataCliente.correo_electronico = cliente.correo_electronico;
        },
        obtenerClientes(){
            axios.get('/obtener-clientes').then(response=>{
                console.log(response);
                this.clientes = response.data.clientes;
            })
        },
        guardar(){
            axios.post('clientes', this.dataCliente).then(response=>{
                if(response && response.data.statusCode ==200){
                    this.nuevo = 0;
                    this.limpiarCampos();
                    this.obtenerClientes();
                    alert("Datos guardados correctamente");
                }
            })
            .catch((error)=>{
                if(error.response.status==422){
                    this.errors = error.response.data.errors;
                    this.mostrarErrores();
                }
                else{
                    console.log(this.errors);
                }
            })
        },
        modificar(){
            axios.put('clientes/'+ this.cliente_id, this.dataCliente).then(response=>{
                if(response && response.data.statusCode ==200){
                    this.nuevo = 0;
                    this.limpiarCampos();
                    this.obtenerClientes();
                    alert("Datos modificados correctamente");
                }
            })
            .catch((error)=>{
                if(error.response.status==422){
                    this.errors = error.response.data.errors;
                    this.mostrarErrores();
                }
                else{
                    console.log(this.errors);
                }
            })
        },
        mostrarErrores(){
            this.reiniciarMensajesError()
            for(let error in this.errors){
                switch(error){
                    case 'nombre':
                        this.invalid.nombre =1;
                    break;
                    case 'apellido_paterno':
                        this.invalid.apellido_paterno =1;
                    break;
                    case 'apellido_materno':
                        this.invalid.apellido_materno =1;
                    break;
                    case 'correo_electronico':
                        this.invalid.correo_electronico =1;
                    break;
                }
            }
        }
    },
    mounted() {
        this.obtenerClientes();
    },
    
}
</script>