@extends('principal')

@section('content')
    <div id="pcont" class="container-fluid">
        <div class="page-head">
            <h2 style="display:inline-block;">Secciones</h2>
            <select class="input-lg" id="cmbAnio">
            </select>
            <select class="input-lg " id="cmbTurno" onchange="listar()">
                <option value="M">MAÑANA</option>
                <option value="T">TARDE</option>
                <option value="N">NOCTURNA</option>
            </select>
            <i id="loading" style="display:none;" class="fa fa-2x fa-spinner fa-spin"></i>
        </div>
        <div class="cl-mcont">
            <div class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="tab-container">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tp1" data-toggle="tab">Listado</a></li>
                            <li><a href="#tp2" data-toggle="tab">Registrar</a></li>
                        </ul>
                        <div class="tab-content">
                            <div id="tp1" class="tab-pane active cont">
                                <table class='table table-bordered dataTable no-footer' id="tblListado">
                                    <thead>
                                    <tr>
                                        <th>Seccion</th>
                                        <th>Vacantes</th>
                                        <th>Tutor</th>
                                        <th>Activo</th>
                                        <th>Acción</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    </tbody>
                                </table>
                            </div>
                            <div id="tp2" class="tab-pane cont">
                                <div class="container">
                                    <form id="frmPeriodo" method="post" data-parsley-validate="" data-parsley-excluded="[disabled=disabled]" novalidate="">
                                        <input type="hidden" id="hddCodigo" value="">
                                        <div class="row">
                                            <label for="txtNombre" class="col-md-1 control-label">Nombre</label>
                                            <div class="col-md-6">
                                                <input id="txtNombre" type="text" placeholder="Ejem. Año del Buen Servicio al Ciudadano" class="form-control"
                                                       data-parsley-trigger="change" data-parsley-required="true">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="txtAbreviatura" class="col-md-1 control-label">Abreviatura</label>
                                            <div class="col-md-4">
                                                <input id="txtAbreviatura" type="text" placeholder="Ejem. II BIM." class="form-control"
                                                       data-parsley-trigger="change" data-parsley-required="true"></div>
                                            <label for="chkActivo" class="col-sm-2 control-label">Activo
                                                <input id="chkActivo" class="icheck" type="checkbox" >
                                            </label>
                                        </div>
                                    </form>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <button id="btnGuardar" class="btn btn-primary" onclick="guardar()">Registrar</button>
                                        <button class="btn btn-default" onclick="cancelar()">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                            <div id="tp3" class="tab-pane cont">
                                <h2>Typography</h2>
                                <p>This is just an example of content writen by <b>Jeff Hanneman</b>, as you can see it
                                    is a clean design with large</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">

        var t;

        $(document).ready(function () {
            //initialize the javascript
            App.init();
            App.formElements();
            t = $("#tblListado").DataTable();
            $("#frmPeriodo").parsley();
            listarAnios();
        });

        function guardar(){
            var accion = $("#hddCodigo").val() == "" ? true : false;
            if($("#frmPeriodo").parsley().validate()){
                if (accion)
                    registrar()
                else
                    modificar()
            }
        }

        $("#cmbAnio").on('change',function(){
            cancelar();
        });

        function obtenerDatos(){
            var info = [{"_token": "{{ csrf_token() }}",
                "nombre": $("#txtNombre").val(),
                "abreviatura": $("#txtAbreviatura").val(),
                "anio_lectivo_id": parseInt($("#cmbAnio").val()),
                "activo": $("#chkActivo").is(":checked")}][0];
            return info;
        }

        function registrar() {
            if (confirm("¿Deseas continuar el registro?")) {
                var info = obtenerDatos();
                $.ajax({
                    url: "/mantenimientos/periodo",
                    type: "POST",
                    data: info,
                    beforeSend: function () {
                        $("#loading").show();
                    },
                    success: function (data) {
                        notificacion('Registro', 'Datos registrados correctamente', 'primary');
                        cancelar();
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    },
                    complete: function () {
                        $("#loading").hide();
                    }
                });
            }
        }

        function modificar() {
            if (confirm("¿Deseas continuar la modificación?")) {
                var info = obtenerDatos();
                $.ajax({
                    url: "/mantenimientos/periodo/" + $("#hddCodigo").val(),
                    type: "PUT",
                    data: info,
                    beforeSend: function () {
                        $("#loading").show();
                    },
                    success: function (data) {
                        notificacion('Actualización', 'Datos actualizados correctamente', 'success');
                        cancelar();
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    },
                    complete: function () {
                        $("#loading").hide();
                    }
                });
            }
        }

        function eliminar(id) {
            if (confirm("¿Deseas eliminar el elemento?")) {
                var info = [{"_token": "{{ csrf_token() }}"}][0];
                $.ajax({
                    url: "/mantenimientos/anio_lectivo/" + id,
                    type: "DELETE",
                    data: info,
                    beforeSend: function () {
                        $("#loading").show();
                    },
                    success: function (data) {
                        notificacion('Eliminación', 'Datos actualizados correctamente', 'warning');
                        cancelar();
                    },
                    error: function (request, status, error) {
                        console.log(request.responseText);
                    },
                    complete: function () {
                        $("#loading").hide();
                    }
                });
            }
        }

        function grupo_opciones(id){
            var opciones = "<div class='btn-group'>";
            opciones += "<button class='btn btn-default btn-xs' type='button'>Acciones</button>";
            opciones += "<button data-toggle='dropdown' class='btn btn-xs btn-primary dropdown-toggle' type='button' aria-expanded='true'>";
            opciones += "        <span class='caret'></span>";
            opciones += "        <span class='sr-only'>Toggle Dropdown</span>";
            opciones += "</button>";
            opciones += "<ul role='menu' class='dropdown-menu pull-right'>";
            opciones += "<li><a href='#' onclick=editar("+id+")><i class='fa fa-edit'></i> Editar</a></li>";
            opciones += "<li><a href='#' onclick=eliminar("+id+")><i class='fa fa-trash-o'></i> Eliminar</a></li>";
            opciones += "</ul>";
            return opciones;
        }

        function editar(id) {
            $.ajax({
                url: "/mantenimientos/periodo/" + id,
                type: "GET",
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (data) {
                    $("#hddCodigo").val(id);
                    $("#txtNombre").val(data["nombre"]);
                    $("#txtAbreviatura").val(data["abreviatura"]);
                    $("#chkActivo").iCheck(data["activo"] == true ? "check" : "uncheck" );
                    $("#btnGuardar").text("Guardar");
                    $('a[href="#tp2"]').click();
                    $('a[href="#tp2"]').text("Modificando : "+data["nombre"]);
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                },
                complete: function () {
                    $("#loading").hide();
                }
            });
        }

        function cancelar(){
            $("#hddCodigo").val("");
            $("#txtNombre").val("");
            $("#txtAbreviatura").val("");
            $("#chkActivo").iCheck("uncheck");
            $("#btnGuardar").text("Registrar");
            $('#frmPeriodo').parsley().reset();
            $('a[href="#tp1"]').click();
            $('a[href="#tp2"]').text("Registrar");
            listar();
        }

        function listar() {
            var info = [{"_token": "{{ csrf_token() }}",
                "anio_lectivo_id": parseInt($("#cmbAnio").val()),
                "turno": $("#cmbTurno").val()}][0];
            $.ajax({
                url: "/mantenimientos/seccion/listar",
                type: "GET",
                data: info,
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (data) {
                    t.clear().draw();
                    $.each(data,function( index, value ) {
                        var tutor = "";
                        if(value["trabajador_id"] != null)
                             tutor = value["trabajador"]["apellido_paterno"]+" "+value["trabajador"]["apellido_materno"]+" "+value["trabajador"]["nombres"];
                        t.row.add([value['grado']['nivel']['abreviatura']+"-"+value['grado']['numero']+' '+value['letra'],
                                value["vacantes"],tutor,
                            "<input type='checkbox' "+( value['activo'] == true ? "checked" : "")+" disabled>",
                            grupo_opciones(value['id'])]).draw(false);
                    });
                },
                error: function (request, status, error) {
                    mostrar_error(request.responseText);
                },
                complete: function () {
                    $("#loading").hide();
                }
            });
        }

        function listarAnios() {
            $.ajax({
                url: "/mantenimientos/anio_lectivo/*",
                type: "GET",
                beforeSend: function () {
                    $("#loading").show();
                },
                success: function (data) {
                    var opciones = "";
                    $.each(data,function( index, value ) {
                        opciones += "<option value='"+value["id"]+"'>"+value["anio"]+"</option>";
                    });
                    $("#cmbAnio").append(opciones);
                },
                error: function (request, status, error) {
                    console.log(request.responseText);
                },
                complete: function () {
                    $("#loading").hide();
                    listar();
                }
            });
        }
    </script>
@endsection

