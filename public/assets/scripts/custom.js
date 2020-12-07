///CUSTOM BY EVER

/*
 * Funciones
 */

//Validar correo electronico
function validarCorreo(email) {
    var re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,1}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

//Efecto ancla
function movimiento_go(elemento){
    var posicion = $(elemento).position().top;
    $('html,body').animate({scrollTop: posicion}, 500);
    return;
}

//Discrimitar Caracteres ** Numeros o Letras
function soloNumeros(event){
    //Aqui se colocan las teclas que quedaran fuera.
    if(event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 13 || event.keyCode == 9 || event.keyCode == 110){}
            
    //Las que no se permiten.
    else{
        if(event.keyCode < 95){
            if(event.keyCode < 48 || event.keyCode > 57 ){
                event.preventDefault(); 
            }
        }else{
            if(event.keyCode < 96 || event.keyCode > 105){
                event.preventDefault(); 
            }
        }
    }
}

var formatNumber = {
    separador: ",", // separador para los miles
    sepDecimal: '.', // separador para los decimales
  
    formatear:function (num){
        num +='';
        var splitStr = num.split('.');
        var splitLeft = splitStr[0];
        var splitRight = splitStr.length > 1 ? this.sepDecimal + splitStr[1] : '';
        var regx = /(\d+)(\d{3})/;
 
        while(regx.test(splitLeft)) {
            splitLeft = splitLeft.replace(regx, '$1' + this.separador + '$2');
        }

        return this.simbol + splitLeft  +splitRight;
    },
  
    new:function(num, simbol){
        this.simbol = simbol ||'';
        return this.formatear(num);
    }
}

function calcularTotal(){
    var precioTotal = 0;
    $('.precio').each(function(){
        precioTotal += parseFloat($(this).val());
    });

    $('.precioTotal').text(formatNumber.new(precioTotal));
}

function restalTotal(precio){
    var precioTotal = $('.precioTotal').text();
    
    precioTotal = parseFloat(precioTotal.replace(",",""));
    console.log(precioTotal);

    precioTotal -= parseFloat(precio);
    
    $('.precioTotal').text(formatNumber.new(precioTotal));
}

//Defino los tamaños a todos los input que estan dentro de las tablas
function definirInputClientes(){
    $('.clientesTable td').each(function(){
        var tamanio = $(this).width();
        $('input',this).css("width",tamanio+"px");
        $('input',this).css("padding","0px");
        //console.log(tamanio);
    });
}

//Funcion para Definir el estado en que se encuentra el credito
function estatusCredito(porciento){
    var estado = "";
    if(porciento > 60) { estado = "good"; }
    if(porciento <= 60) { estado = "ok"; }
    if(porciento < 0) { estado = "bad"; }

    return estado;
}

//Funcion para pintar barra de progreso
function pintarProgreso(porciento){
    var estado = "";
    if(porciento > 60) { estado = "progress-bar-success"; }
    if(porciento <= 60) { estado = "progress-bar-warning"; }
    if(porciento < 0) { estado = "progress-bar-danger"; }

    return estado;
}

//Funcion para Definir el estado en que se encuentra el credito [***INVERTIDO***]
function estatusCreditoInvertido(porciento){
    var estado = "";
    if(porciento > 100) { estado = "bad"; }
    if(porciento <= 100) { estado = "ok"; }
    if(porciento <= 30) { estado = "good"; }

    return estado;
}

//Funcion para pintar barra de progreso [***INVERTIDO***]
function pintarProgresoInvertido(porciento){
    var estado = "";
    if(porciento > 100) { estado = "progress-bar-danger"; }
    if(porciento <= 100) { estado = "progress-bar-warning"; }
    if(porciento <= 30) { estado = "progress-bar-success"; }

    return estado;
}

//Limpiar advertencias
function limpiarAdvertencias(elemento){
    elemento.removeClass('good ok bad progress-bar-danger progress-bar-warning progress-bar-success');
}

//Funcion para calcular el credito Consumido y Disponible
function calcularCredito(){
    var creditoConsumido = $('.infoCreConsumido .valor').data('valorDefecto');
    var creditoConsumido = parseFloat(creditoConsumido.replace(',',''));
    
    //Difino la totalidad
    var total = $('.precioTotal').text();
    var total = parseFloat(total.replace(',',''));

    creditoConsumido += total;

    //Saco el limite de credito
    var limiteCredito = $('.infoCreLimite .valor').text();
    var limiteCredito = parseFloat(limiteCredito.replace(',',''));

    //Saco el credito disponible
    var creditoDisponible = limiteCredito - creditoConsumido;

    //Saco el porcentage de credito Consumido y el Disponible
    var porcientoConsumido  = (creditoConsumido * 100) / limiteCredito;
    var porcientoDisponible = (creditoDisponible * 100) / limiteCredito;

    //Pintamos los resultados

    /****** Credito Disponible ******/
    var estadoDisponible = estatusCredito(porcientoDisponible);
    //Estado del credito
    limpiarAdvertencias($('.infoCreDisponible .display'));
    $('.infoCreDisponible .display').addClass(estadoDisponible);
    //Pinto los porcentages
    $('.infoCreDisponible .porcentage').text(porcientoDisponible);
    //Barra
    $('.infoCreDisponible .progress-bar').css('width',porcientoDisponible+'%')
    //Color de la barra progress-bar-
    var ColorDeLaBarra = pintarProgreso(porcientoDisponible);
    limpiarAdvertencias($('.infoCreDisponible .progress-bar'));
    $('.infoCreDisponible .progress-bar').addClass(ColorDeLaBarra);
    //Escribimos la cantidad
    $('.infoCreDisponible .valor').text(formatNumber.new(creditoDisponible));

    /****** Credito Usado o Consumido ******/
    var estadoConsumido = estatusCreditoInvertido(porcientoConsumido);
    //Estado del credito
    limpiarAdvertencias($('.infoCreConsumido .display'));
    $('.infoCreConsumido .display').addClass(estadoConsumido);
    //Pinto los porcentages
    $('.infoCreConsumido .porcentage').text(porcientoConsumido);
    //Barra
    $('.infoCreConsumido .progress-bar').css('width',porcientoConsumido+'%')
    //Color de la barra progress-bar-
    var ColorDeLaBarra = pintarProgresoInvertido(porcientoConsumido);
    limpiarAdvertencias($('.infoCreConsumido .progress-bar'));                     
    $('.infoCreConsumido .progress-bar').addClass(ColorDeLaBarra);
    //Escribimos la cantidad
    $('.infoCreConsumido .valor').text(formatNumber.new(creditoConsumido));
}

function resetOrdenesForm(){
    //document.getElementById("ordenesForm").reset();
    var count = 0;
    $('.contProductos').each(function(){
        if(count > 0){
            $(this).remove();
        }
        count++;
    });
    $('.precioTotal').text('0,00');
}

$(document).ready(function(){
    //Script para cortar imagenes
    $(document).on("click",".cortar",function(){
        window.imagen = $(this).data('img');
        window.id = $(this).data('id');
        window.url = $(this).data('url');
        
        //Insertamos los datos en el modal
        $('.imgCut').attr('src',url+'/'+imagen);

        $('.cutHidden_'+id).click();
        $('#x1,#y1,#x2,#y2,#w,#h').val('');

        FormImageCrop.init();
    });

    //Activo edicion Usuario Pharma
    $(document).on("click",".edit",function(){
        window.id = $(this).data('id');

        window.restoreName = $('.nom_'+id).text();
        window.restoreCorr = $('.cor_'+id).text();
        window.restoreCedu = $('.ced_'+id).text();
        window.restoreCode = $('.cod_'+id).text();
        window.restoreTele = $('.tel_'+id).text();
        window.restoreDpto = $('.dpt_'+id).text();
        window.restoreCrto = $('.crt_'+id).text();

        //Remplazamos los Span por Input
        $('.nom_'+id).replaceWith("<input type='text' class='nom_"+id+" form-control input-small' value='"+restoreName+"' />");
        $('.cor_'+id).replaceWith("<input type='email' class='cor_"+id+" form-control input-small' value='"+restoreCorr+"' />");
        $('.ced_'+id).replaceWith("<input type='text' class='ced_"+id+" form-control input-small' value='"+restoreCedu+"' />");
        $('.cod_'+id).replaceWith("<input type='text' class='cod_"+id+" form-control input-small' value='"+restoreCode+"' />");
        $('.tel_'+id).replaceWith("<input type='text' class='tel_"+id+" form-control input-small' value='"+restoreTele+"' />");
        $('.dpt_'+id).replaceWith("<input type='text' class='dpt_"+id+" form-control input-small' value='"+restoreDpto+"' />");
        $('.crt_'+id).replaceWith("<input type='text' class='crt_"+id+" form-control input-small' value='"+restoreCrto+"' />");
        $(this).replaceWith('<a href="javascript:;" class="save btn btn-xs btn-success" data-id="'+id+'" title="Guardar"><i class="fa fa-save"></i></a> | <a href="javascript:;" class="restore btn btn-xs btn-danger" data-id="'+id+'" title="Restaurar"><i class="fa fa-undo"></i></a>');
        definirInputClientes();
    });

    //Restauro edicion Usuario Pharma
    $(document).on("click",".restore",function(){
        window.id = $(this).data('id');

        //Remplazamos los Span por Input
        $('.nom_'+id).replaceWith('<span class="nom_'+id+'">'+restoreName+'</span>');
        $('.cor_'+id).replaceWith('<span class="cor_'+id+'">'+restoreCorr+'</span>');
        $('.ced_'+id).replaceWith('<span class="ced_'+id+'">'+restoreCedu+'</span>');
        $('.cod_'+id).replaceWith('<span class="cod_'+id+'">'+restoreCode+'</span>');
        $('.tel_'+id).replaceWith('<span class="tel_'+id+'">'+restoreTele+'</span>');
        $('.dpt_'+id).replaceWith('<span class="dpt_'+id+'">'+restoreDpto+'</span>');
        //$('.cre_'+id).replaceWith('<span class="cre_'+id+'">'+restoreCrto+'</span>');
        $('.crt_'+id).replaceWith('<span class="crt_'+id+'">'+restoreCrto+'</span>');

        $('.botones_'+id).html('<a href="javascript:;" class="edit btn btn-xs btn-warning" data-id="'+id+'" title="Editar"><i class="fa fa-edit"></i></a>');
    });

    //Guardamos edicion Usuario Pharma
    $(document).on("click",".save",function(){
        window.id = $(this).data("id");

        //Variables
        window.restoreName = $('.nom_'+id).val();
        window.restoreCorr = $('.cor_'+id).val();
        window.restoreCedu = $('.ced_'+id).val();
        window.restoreCode = $('.cod_'+id).val();
        window.restoreTele = $('.tel_'+id).val();
        window.restoreDpto = $('.dpt_'+id).val();
        //window.restoreCred = $('.cre_'+id).val();
        window.restoreCrto = $('.crt_'+id).val();

        $('.loading_'+id).css('display','inline-block');
        //+"&cre="+restoreCred

        $.ajax({
            url: "/admin/clientes/editar-clientes", 
            dataType: "json",
            type:"POST",
            data: "idUser="+id+"&nom="+restoreName+"&corr="+restoreCorr+"&ced="+restoreCedu+"&cod="+restoreCode+"&tel="+restoreTele+"&dpt="+restoreDpto+"&cred="+restoreCrto,
            success: function (dato) {
                if(dato.error == 1){
                    $('.nom_'+id).replaceWith('<span class="nom_'+id+'">'+restoreName+'</span>');
                    $('.cor_'+id).replaceWith('<span class="cor_'+id+'">'+restoreCorr+'</span>');
                    $('.ced_'+id).replaceWith('<span class="ced_'+id+'">'+restoreCedu+'</span>');
                    $('.cod_'+id).replaceWith('<span class="cod_'+id+'">'+restoreCode+'</span>');
                    $('.tel_'+id).replaceWith('<span class="tel_'+id+'">'+restoreTele+'</span>');
                    $('.dpt_'+id).replaceWith('<span class="dpt_'+id+'">'+restoreDpto+'</span>');
                    //$('.cre_'+id).replaceWith('<span class="cre_'+id+'">'+restoreCred+'</span>');
                    $('.crt_'+id).replaceWith('<span class="crt_'+id+'">'+restoreCrto+'</span>');

                    $('.botones_'+id).html('<a href="javascript:;" class="edit btn btn-xs btn-warning" data-id="'+id+'" title="Editar"><i class="fa fa-edit"></i></a>');
                }

                //Toda clase de error.
                if (dato.error == 4){
                    alert(dato.mensaje);
                }

                $('.loading_'+id).fadeOut();
            }
        });
    });

    $('.radio-inline').click(function(){
        $('#input-busqueda').attr("placeholder",$(this).text().trim()+"...");
    });

    $(document).on("click",".btn-vinvular",function(){
        window.id = $(this).data("id");

        $('.alert-danger').hide();
        $('.loading_vinculos').hide();
        $('.vinOk').hide();
        $('.vinNoOk').hide();

        $('.vincular_loading_'+id).css('display','inline-block');

        $.ajax({
            url: "/admin/clientes/get-relacion-tienda", 
            dataType: "json",
            type:"POST",
            data: "idCliente="+id,
            success: function (dato) {
                if(dato.code == 200){
                    //Pinto el formulario
                    $('.conTienda').html(dato.mensaje);
                    
                    $('#idCliente').val(id);
                    $('#modalVinculante').modal('show');

                    window.cuenta = dato.cuenta;
                    window.optionTienda = dato.optionTienda;

                    $('.vincular_loading_'+id).fadeOut();
                }

                //Toda clase de error.
                if (dato.code == 400){
                    $('.alert-danger').html(dato.mensaje);

                    $('.vincular_loading_'+id).fadeOut();
                }
            }
        });
    });

    $(document).on("click","#saveVinculado",function(){
        window.id = $('#idCliente').val();

        $('.alert-danger').hide();
        $('.vinOk').hide();
        $('.vinNoOk').hide();

        $('.loading_vinculos').fadeIn();

        $.ajax({
            url: "/admin/clientes/set-vinculo", 
            dataType: "json",
            type:"POST",
            data: $('#formVinculo').serialize(),
            success: function (dato) {
                if(dato.code == 200){
                    $('.vinOk span').html(dato.mensaje);
                    $('.vinOk').fadeIn();
                    $('.loading_vinculos').fadeOut();

                    $('.vinculadoOk_'+id).css('display','inline-block');

                    console.log(id);
                }

                //Toda clase de error.
                if (dato.code == 400){
                    $('.vinNoOk span').html(dato.mensaje);
                    $('.vinNoOk').fadeIn();
                    $('.loading_vinculos').fadeOut();
                }
            }
        });
    });

    $(document).on("click","#removeVinculado",function(){
        window.id = $('#idCliente').val();

        $('.alert-danger').hide();
        $('.vinOk').hide();
        $('.vinNoOk').hide();

        $('.loading_vinculos').fadeIn();

        $.ajax({
            url: "/admin/clientes/put-vinculo", 
            dataType: "json",
            type:"POST",
            data: $('#formVinculo').serialize(),
            success: function (dato) {
                if(dato.code == 200){
                    $('.vinOk span').html(dato.mensaje);
                    $('.vinOk').fadeIn();
                    $('.loading_vinculos').fadeOut();

                    ///Limipo el form 
                    $('#formVinculo input[type=text], #formVinculo select').val('');

                    var cc = 1;
                    $('.bloke').each(function(){
                        if(cc > 1){
                            $(this).remove();
                        }
                        cc++;
                    });

                    $('.vinculadoOk_'+id).hide();
                }

                //Toda clase de error.
                if (dato.code == 400){
                    $('.vinNoOk span').html(dato.mensaje);
                    $('.vinNoOk').fadeIn();
                    $('.loading_vinculos').fadeOut();
                }
            }
        });
    });

    //Agregamos mas tiendas y codigos 
    $(document).on("click",".addTienda",function(){
        var html = '';

        html += '<div class="bloke tienda-'+(cuenta+1)+'">';
            html += '<div class="form-group" style="overflow: hidden;">';
                html += '<label class="col-md-3 control-label">Código:</label>';
                                
                html += '<div class="col-md-9">';
                    html += '<input type="text" class="form-control" id="codigo" name="codigos[]">';
                html += '</div>';
            html += '</div>';

            html += '<div class="form-group" style="overflow: hidden;">';
                html += '<label class="col-md-3 control-label">Tiendas:</label>';
                                                
                html += '<div class="col-md-9">';
                    html += '<select id="selectTiendas" name="tiendas[]" class="form-control">';
                            html += '<option value="">Seleccionar tienda</option>';
                            html += optionTienda;
                    html += '</select>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        $('.conTienda').append(html);

        window.cuenta ++;

        return false;
    });

    $('.emailToCrm').click(function(){
        $('.emailToLlamar').removeClass('active');
        $(this).addClass('active');
        $('.interaccionesLLamada').hide();
        $('.interaccionesEmail').fadeIn();
        return false;
    });

    $('.emailToLlamar').click(function(){
        $('.emailToCrm').removeClass('active');
        $(this).addClass('active');
        $('.interaccionesEmail').hide();
        $('.interaccionesLLamada').fadeIn();
        return false;
    });

    $('.downloandCsv').one("click",function(){
        $('.downloandCsv i').removeClass('fa-download');
        $('.downloandCsv i').addClass('fa-cog fa-spin');

        $.ajax({
            url: "/admin/clientes/exportar", 
            dataType: "json",
            type:"POST",
            data: "void",
            success: function (dato) {
                if(dato.error == 1){
                    $('.downloandCsv').removeAttr('href');
                    $('.downloandCsv').attr('href',dato.mensaje);
                }

                //Toda clase de error.
                if (dato.error == 4){
                    alert(dato.mensaje);
                }

                $('.downloandCsv i').removeClass('fa-cog fa-spin');
                $('.downloandCsv i').addClass('fa-download');
                $('.downloandCsv').addClass('descargarCsv');
                $('.descargarCsv').removeClass('downloandCsv');
                location.href = dato.mensaje;
            }
        });
    });

    $(document).on("click",".btnDislow",function(){
        window.id = $(this).data("id");

        $('.loading_'+id).css('display','inline-block');

        $.ajax({
            url: "/admin/productos/status", 
            dataType: "json",
            type:"POST",
            data: "idProducto="+id+"&estado=desactivar",
            success: function (dato) {
                if(dato.error == 1){
                    $('.btn_'+id).removeClass('btnDislow');
                    $('.btn_'+id).removeClass('btn-danger');
                    $('.btn_'+id).addClass('btn-success');
                    $('.btn_'+id).addClass('btnAllow');
                    $('.btn_'+id).text('Activar');
                }

                //Toda clase de error.
                if (dato.error == 4){
                    alert(dato.mensaje);
                }

                $('.loading_'+id).fadeOut();
            }
        });
    });

    $(document).on("click",".btnAllow",function(){
        window.id = $(this).data("id");

        $('.loading_'+id).css('display','inline-block');

        $.ajax({
            url: "/admin/productos/status", 
            dataType: "json",
            type:"POST",
            data: "idProducto="+id+"&estado=activar",
            success: function (dato) {
                if(dato.error == 1){
                    $('.btn_'+id).removeClass('btn-success');
                    $('.btn_'+id).removeClass('btnAllow');

                    $('.btn_'+id).addClass('btnDislow');
                    $('.btn_'+id).addClass('btn-danger');
                    
                    $('.btn_'+id).text('Despublicar');
                }

                //Toda clase de error.
                if (dato.error == 4){
                    alert(dato.mensaje);
                }

                $('.loading_'+id).fadeOut();
            }
        });
    });

    //Exportar Usuarios de una empresa
    $('.eDownloandCsv').one("click",function(){
        window.empresa = $(this).data('empresa');

        $('.eDownloandCsv i').removeClass('fa-download');
        $('.eDownloandCsv i').addClass('fa-cog fa-spin');

        $.ajax({
            url: "/admin/admin-empresa/usuarios/exportar", 
            dataType: "json",
            type:"POST",
            data: "idEmpresa="+empresa,
            success: function (dato) {
                if(dato.error == 1){
                    $('.eDownloandCsv').removeAttr('href');
                    $('.eDownloandCsv').attr('href',dato.mensaje);

                    $('.eDownloandCsv i').removeClass('fa-cog fa-spin');
                    $('.eDownloandCsv i').addClass('fa-download');
                    $('.eDownloandCsv').addClass('descargarCsv');
                    $('.descargarCsv').removeClass('eDownloandCsv');
                    location.href = dato.mensaje;
                }

                //Toda clase de error.
                if (dato.error == 4){
                    $('.eDownloandCsv i').removeClass('fa-spin');
                    alert(dato.mensaje);
                }
            }
        });
    });

    var i = 1; 
    $(document).on("click",".masProducto",function(){
        var html = "";
        i++;

        html += '<div class="contProductos cp-'+i+'">';
            html += '<div class="col-sm-2">';
                html += '<input type="number" name="cantidad[]" data-id="'+i+'" value="1" min="1" class="form-control cantidad" disabled />';
            html += '</div>';
            
            html += '<div class="col-sm-5">';
                html += '<div class="input-group">';
                    html += '<span class="input-group-addon">';
                        html += '<i class="fa fa-cube"></i>';
                    html += '</span>';
                        
                    html += '<input type="text" name="producto[]" class="form-control productName round-right" data-id="'+i+'" />';
                    html += '<i class="fa fa-cog fa-spin loading_'+i+'" style="font-size: 22px;position: relative;margin-top: 10px;margin-left: -25px;z-index: 9;display:none;"></i>';
                html += '</div>';
            html += '</div>';

            html += '<div class="col-sm-2">';
                html += '<span class="btn btn-success masProducto" data-id="'+i+'"><i class="fa fa-plus"></i></span>';
                html += ' <span class="btn btn-danger menosProducto" data-id="'+i+'"><i class="fa fa-minus"></i></span>';
            html += '</div>';
            
            html += '<div class="col-sm-3">';
                html += '<div class="input-group">';
                    html += '<span class="input-group-addon">';
                        html += 'RD <i class="fa fa-dollar"></i>';
                    html += '</span>';
                        
                    html += '<input type="text" name="precio[]" class="precio form-control round-right" value="0" readonly/>';
                html += '</div>';
            html += '</div>';
        html += '</div>';

        $('.productos').append(html);
    });
    
    //Elimitar un producto de la orden
    $(document).on("click",".menosProducto",function(){
        window.id = parseInt($(this).data('id'));

        if(id != 1){
            var precio = $('.cp-'+id+' .precio').val();
            $('.cp-'+id).remove();
            restalTotal(precio);
            calcularCredito();
        }
    });

    $(document).on("keydown",".cantidad, .onlyNumber",function(event){
        soloNumeros(event);
    });

    $(document).on("keyup",".productName",function(){
        window.idProducto = $(this).data('id');

        if($('.clientes').val() == ""){
            $('.alert-danger span').text('Por favor seleccione un cliente primero');
            $('.alert-danger').fadeIn();
            return;
        }

        $(this).autocomplete({
            source: function( request, response ) {
                $('.loading_'+idProducto).fadeIn();
                $('.alert-danger').hide();
                $.ajax({
                    url: "/admin/productos/name",
                    dataType: "JSON",
                    type:"POST",
                    data: {
                        q: request.term
                    },
                    success: function( data ) {
                        response($.map(data.productos,function(value, key){
                            return {
                                label: value.nombre,
                                value: value.nombre,
                                id: value.idPro,
                                precio: value.precio
                            };
                        }));

                        $('.loading_'+idProducto).fadeOut();
                    }
                });
            },
            minLength: 3,
            select: function(event,ui){
                $('.cp-'+idProducto+' .precio').val(ui.item.precio);
                $('.cp-'+idProducto+' .precio').data('precio',ui.item.precio);

                //Desabilitamos la opcion de agregar nuevo
                $('.cp-'+idProducto+' .cantidad').val(1);
                $('.cp-'+idProducto+' .cantidad').removeAttr('disabled');
                
                //Le asignamos el id al producto
                $('.cp-'+idProducto+' .productName').data('idProd',ui.item.id);

                calcularTotal();
                calcularCredito();
            },
        });      
    });

    //Marco El precio 
    $(document).on("change",".precio",function(){
        calcularTotal();
        calcularCredito();

        //Compruebo si ya no tengo un deficit y quito la alerta
        if(parseFloat($('.infoCreDisponible .valor').val()) >= 0){
            $('.alert-danger').hide();
        }
    });

    //Incremento por cantidad
    $(document).on("change",".cantidad",function(){
        window.Cantidad = parseInt($(this).val());
        window.idCantidad = $(this).data('id');
        var valor = 0;
        
        if($('.cp-'+idCantidad+' .precio').val() != 0 && $('.cp-'+idCantidad+' .precio').val() != ""){
            //Multiplicamos el valor del producto por la cantidad
            
            valor = Cantidad * parseFloat($('.cp-'+idCantidad+' .precio').data('precio'));
            $('.cp-'+idCantidad+' .precio').val(valor);
            calcularTotal();
            calcularCredito();
        }
    });

    //Enviamos la Orden
    $(document).on("click",".btn-colocar",function(){
        if(parseFloat($('.infoCreDisponible .valor').text()) < 0){
            $('.alert-danger span').text('Solo tiene RD$ '+$('.infoCreLimite .valor').text()+' de su límite de crédito disponible.');
            $('.alert-danger').fadeIn();
            return;
        }

        //Verificamos si se ha seleccionado la direccion
        window.selecDir = $('input[name=direccion]:checked').val();
        if(typeof selecDir == 'undefined'){
            $('.alert-danger span').text('Por favor seleccionar una dirección de envio.');
            $('.alert-danger').fadeIn();
            return;
        }

        $('.loadingColocar').fadeIn();

        window.idProd   = "";
        window.precios  = "";
        window.cantidad = "";
        window.crtConsu = $('.infoCreConsumido .valor').text();
        crtConsu = crtConsu.replace(',','');

        $('.contProductos').each(function(){
            idProd   += $('.productName',this).data('idProd')+",";
            precios  += $('.precio',this).data('precio')+",";
            cantidad += $('.cantidad',this).val()+",";
        });

        idProd = idProd.substring(0,idProd.length -1);
        precios = precios.substring(0,precios.length -1);
        cantidad = cantidad.substring(0,cantidad.length -1);

        $.ajax({
            url: "/admin/ordenes/set", 
            dataType: "json",
            type:"POST",
            data: "idProd="+idProd+'&precios='+precios+'&cantidad='+cantidad+"&idCliente="+$('.clientes').val()+'&precioTotal='+$('.precioTotal').text()+"&crtConsumido="+crtConsu+"&idEmpresa="+$('.selEmpresas').val()+'&idDireccion='+selecDir,
            success: function (dato) {
                if(dato.error == 1) {
                    $('.alert-danger').fadeOut();

                    $('.alert-success span').html(dato.mensaje);
                    $('.alert-success').fadeIn();

                    //Resetear Ordenes
                    document.getElementById("ordenesForm").reset();
                    var count = 0;
                    $('.contProductos').each(function(){
                        if(count > 0){
                            $(this).remove();
                        }
                        count++;
                    });
                    $('.precioTotal').text('0,00');
                    $('.infoCredito').hide();                  
                }

                if(dato.error == 4) {
                    $('.alert-success').fadeOut();

                    $('.alert-danger span').html(dato.mensaje);
                    $('.alert-danger').fadeIn();
                }

                $('.loadingColocar').fadeOut();
            }
        });
    });

    /*
     * Dispararo el enlace del select para asignar una empresa en la seccion
     * de admin empresa seccion ordenes
     */
    $('.selOrdenes').change(function(){
        if($(this).val() != ""){
            window.location.href = '/admin/admin-empresa/ordenes/'+$(this).val();
        }else{
            window.location.href = '/admin/admin-empresa/ordenes';
        }
    });

    /*
     * Esta accion sera para crear el enlace cuando un admin quiera ver todos los clientes
     * de una empresa
     */
    $('.verUsuarios').click(function(){
        if($('#selEmpresas').val() != ""){
            var idEmp = $('#selEmpresas').val();
            window.location.href = "/admin/admin-empresa/usuarios/todos/"+idEmp;
        }else{
            $('.alert-danger').show();
            $('.alert-danger span').text('Por favor seleccione una empresa.');
        }
    });

    //Asignamos la informacion crediticia de los clientes [Menu Admin - Empresa]
    $('.clientes').change(function(){
        if($(this).val() != ""){
            $('.loading_clientes').fadeIn();

            //Oculto cualquier alerta
            $('.alert-danger').hide();

            window.idCliente = $(this).val();
            //Resetear Ordenes
            resetOrdenesForm();

            $.ajax({
                url: "/admin/clientes/buscar", 
                dataType: "json",
                type:"POST",
                data: "idCliente="+idCliente,
                success: function (dato) {
                    if(dato.error == 1) {
                        //Pintamos las graficas crediticias

                        /****** Credito Disponible ******/
                        var estadoDisponible = estatusCredito(dato.porcientoDisponible);
                        //Estado del credito
                        limpiarAdvertencias($('.infoCreDisponible .display'));
                        $('.infoCreDisponible .display').addClass(estadoDisponible);
                        //Pinto los porcentages
                        $('.infoCreDisponible .porcentage').text(dato.porcientoDisponible);
                        //Barra
                        $('.infoCreDisponible .progress-bar').css('width',dato.porcientoDisponible+'%')
                        //Color de la barra progress-bar-
                        var ColorDeLaBarra = pintarProgreso(dato.porcientoDisponible);
                        limpiarAdvertencias($('.infoCreDisponible .progress-bar'));
                        $('.infoCreDisponible .progress-bar').addClass(ColorDeLaBarra);
                        //Escribimos la cantidad
                        $('.infoCreDisponible .valor').text(dato.creditoDisponible);



                        /****** Credito Usado o Consumido ******/
                        var estadoConsumido = estatusCreditoInvertido(dato.porcientoConsumido);
                        //Estado del credito
                        limpiarAdvertencias($('.infoCreConsumido .display'));
                        $('.infoCreConsumido .display').addClass(estadoConsumido);
                        //Pinto los porcentages
                        $('.infoCreConsumido .porcentage').text(dato.porcientoConsumido);
                        //Barra
                        $('.infoCreConsumido .progress-bar').css('width',dato.porcientoConsumido+'%')
                        //Color de la barra progress-bar-
                        var ColorDeLaBarra = pintarProgresoInvertido(dato.porcientoConsumido);
                        limpiarAdvertencias($('.infoCreConsumido .progress-bar'));                     
                        $('.infoCreConsumido .progress-bar').addClass(ColorDeLaBarra);
                        //Escribimos la cantidad
                        $('.infoCreConsumido .valor').text(dato.creditoConsumido);

                        //Defino el credito consumido por defecto
                        $('.infoCreConsumido .valor').data('valorDefecto',dato.creditoConsumido);

                        /****** Limite de Credito ******/
                        $('.infoCreLimite .valor').text(dato.limiteCredito);

                        //Hack para mostrar un solo bloque de credito.
                        $('.limiteCreditoClient').text(dato.limiteCredito);
                        
                        //Muestro los creditos
                        $('.infoCredito').show();

                        //Muestro las direcciones del cliente
                        $('#content-direcciones .direcciones-body').html(dato.direcciones);
                        $('#content-direcciones').fadeIn();
                    }

                    if(dato.error == 4) {
                        $('.alert-success').fadeOut();

                        $('.alert-danger span').html(dato.mensaje);
                        $('.alert-danger').fadeIn();
                    }

                    $('.loading_clientes').fadeOut();
                }
            });
        }else{
            $('.infoCredito').hide();

            //Oculto las direcciones
            $('#content-direcciones').fadeOut();
        }
    });

    /*** INTERACCIONES CRM ***/
    
    /*
     *  Correo 
     */
    $(document).on('click','.btnEmail',function(){
        var idCliente   = $('.interaccionesEmail .idCliente').val();
        var nota        = $('.interaccionesEmail .nota').val();

        if(nota == ""){
            $('.interaccionesEmail .alert-danger span').html("Por favor escriba una nota.");
            $('.interaccionesEmail .alert-danger').fadeIn();
            $('.interaccionesEmail .loading_inter').fadeOut();
            return;
        }else{
            $('.interaccionesEmail .alert-danger').fadeOut();
        }

        $('.interaccionesEmail .loading_inter').fadeIn();

        $.ajax({
            url: "/admin/crm/interacciones", 
            dataType: "json",
            type:"POST",
            data: "idCliente="+idCliente+"&nota="+nota+"&interaccion=Email",
            success: function (dato) {
                if(dato.error == 1) {
                    $('.interaccionesEmail .alert-danger').fadeOut();

                    //Añadimos la nueva nota
                    var html = '<div class="panel panel-default">';
                            html += '<div class="panel-heading">';
                                html += '<h3 class="panel-title">';
                                    html += '<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#llamadas" href="#email_'+dato.id+'">';
                                        html += 'Correo eviado el dia '+dato.fecha+' a las '+dato.hora+' <span class="text-right text-danger creadorInter"> Nota creada por: '+dato.nameAdmin+'</span>';
                                    html += '</a>';
                                html += '</h3>';
                            html += '</div>';
                        
                            html += '<div id="email_'+dato.id+'" class="panel-collapse collapse" style="height: 0px;">';
                                html += '<div class="panel-body">';
                                    html += '<p>'+dato.nota+'</p>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';

                    $('.interaccionesEmail .accordion').prepend(html);

                    //Resetear Form
                    document.getElementById("form-intEmail").reset();                
                }

                if(dato.error == 4) {
                    $('.interaccionesEmail .alert-danger span').html(dato.mensaje);
                    $('.interaccionesEmail .alert-danger').fadeIn();
                }

                $('.interaccionesEmail .loading_inter').fadeOut();
            }
        });
    });

    /*
     *  LLamada 
     */
    $(document).on('click','.btnLlamada',function(){
        var idCliente   = $('.interaccionesLLamada .idCliente').val();
        var nota        = $('.interaccionesLLamada .nota').val();

        if(nota == ""){
            $('.interaccionesLLamada .alert-danger span').html("Por favor escriba una nota.");
            $('.interaccionesLLamada .alert-danger').fadeIn();
            $('.interaccionesLLamada .loading_inter').fadeOut();
            return;
        }else{
            $('.interaccionesLLamada .alert-danger').fadeOut();
        }

        $('.interaccionesLLamada .loading_inter').fadeIn();

        $.ajax({
            url: "/admin/crm/interacciones", 
            dataType: "json",
            type:"POST",
            data: "idCliente="+idCliente+"&nota="+nota+"&interaccion=Llamada",
            success: function (dato) {
                if(dato.error == 1) {
                    $('.interaccionesLLamada .alert-danger').fadeOut();

                    //Añadimos la nueva nota
                    var html = '<div class="panel panel-default">';
                            html += '<div class="panel-heading">';
                                html += '<h3 class="panel-title">';
                                    html += '<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#llamadas" href="#llamada_'+dato.id+'">';
                                        html += 'Llamada realizada el dia '+dato.fecha+' a las '+dato.hora+' <span class="text-right text-danger creadorInter"> Nota creada por: '+dato.nameAdmin+'</span>';
                                    html += '</a>';
                                html += '</h3>';
                            html += '</div>';
                        
                            html += '<div id="llamada_'+dato.id+'" class="panel-collapse collapse" style="height: 0px;">';
                                html += '<div class="panel-body">';
                                    html += '<p>'+dato.nota+'</p>';
                                html += '</div>';
                            html += '</div>';
                        html += '</div>';

                    $('.interaccionesLLamada .accordion').prepend(html);

                    //Resetear Form
                    document.getElementById("form-intLlamada").reset();                
                }

                if(dato.error == 4) {
                    $('.interaccionesLLamada .alert-danger span').html(dato.mensaje);
                    $('.interaccionesLLamada .alert-danger').fadeIn();
                }

                $('.interaccionesLLamada .loading_inter').fadeOut();
            }
        });
    });

    //Cambiamos el estatus 
    $('.changeEstatus').change(function(){
        window.id = $(this).data("orden");

        if($(this).val() == ""){
            $('.alert-danger span').text('Por favor seleccione un estatus');
            $('.alert-danger').show();
            return;
        }else{
            $('.alert-danger').hide();
            var statusId = $(this).val();
        }

        $('.loading_'+id).css('display','inline-block');

        $.ajax({
            url: "/admin/ordenes/cambiar-estatus", 
            dataType: "json",
            type:"POST",
            data: "idOrden="+id+"&idStatus="+statusId,
            success: function (dato) {
                if(dato.error == 1){
                    if(dato.estatus == 1){
                        $('.fila_'+id+' .label-estatus').removeClass('label-default label-primary label-danger label-warning label-success label-info');
                        $('.fila_'+id+' .label-estatus').addClass('label-info');
                        $('.fila_'+id+' .label-estatus').text('Verificación');
                    }

                    if(dato.estatus == 2){
                        $('.fila_'+id+' .label-estatus').removeClass('label-default label-primary label-danger label-warning label-success label-info');
                        $('.fila_'+id+' .label-estatus').addClass('label-warning');
                        $('.fila_'+id+' .label-estatus').text('En Tránsito');
                    }

                    if(dato.estatus == 3){
                        $('.fila_'+id+' .label-estatus').removeClass('label-default label-primary label-danger label-warning label-success label-info');
                        $('.fila_'+id+' .label-estatus').addClass('label-success');
                        $('.fila_'+id+' .label-estatus').text('Entregada');
                    }

                    if(dato.estatus == 4){
                        $('.fila_'+id+' .label-estatus').removeClass('label-default label-primary label-danger label-warning label-success label-info');
                        $('.fila_'+id+' .label-estatus').addClass('label-danger');
                        $('.fila_'+id+' .label-estatus').text('Cancelada');
                    } 

                    if(dato.estatus == 5){
                        $('.fila_'+id+' .label-estatus').removeClass('label-default label-primary label-danger label-warning label-success label-info');
                        $('.fila_'+id+' .label-estatus').addClass('label-default');
                        $('.fila_'+id+' .label-estatus').text('Procesada');
                    }  

                    if(dato.estatus == 6){
                        $('.fila_'+id+' .label-estatus').removeClass('label-default label-primary label-danger label-warning label-success label-info');
                        $('.fila_'+id+' .label-estatus').addClass('label-primary');
                        $('.fila_'+id+' .label-estatus').text('Pendiente');
                    }                  
                }

                //Toda clase de error.
                if (dato.error == 4){
                    $('.alert-danger span').text(dato.mensaje);
                    $('.alert-danger').show();
                }

                $('.loading_'+id).fadeOut();
            }
        });
    });

    //Muestro las secciones que estaran disponibles para el administrador
    $('.admin_type').change(function(){
        //Si se ha seleccionado un tipo de administrador sigo
        if($(this).val() != ""){
            $('.loading_adminType').fadeIn();
            $('.alert-danger').hide();

            $.ajax({
                url: "/admin/solicitar-secciones", 
                dataType: "json",
                type:"POST",
                data: "adminKey="+$(this).val(),
                success: function (dato) {
                    //Si todo esta bien
                    if(dato.code == 200){                   
                        $('.secciones').html(dato.secciones);

                        //Si se ha seleccionado un Admin empresa o tienda, Traigo los kioscos
                        if(dato.kioscos != false){ 
                            $('.contentKioscos label').text("Seleccione la "+dato.typeKiosco+" que será administrada:");
                            
                            //Agrego los option
                            $('.contentKioscos select').html(dato.kioscos);

                            //Mostramos el contendor
                            $('.contentKioscos').show();
                        }else{
                            //Ocultamos el contendor
                            $('.contentKioscos').hide();
                        }

                        $('.contentSeccionesDatos').fadeIn();
                    }

                    //Toda clase de error.
                    if (dato.code == 400){
                        $('.alert-danger span').text(dato.mensaje);
                        $('.alert-danger').show();
                        $('.contentSeccionesDatos').fadeOut();
                    }

                    $('.loading_adminType').fadeOut();
                }
            });
        }
    });

    $(document).on("click",".btn-create-admin",function(){
        //Valido de que no tenga campos obligatorios vacios
        var error = "";

        if($('.admin_type').val() == ""){
            error += 'Por favor seleccione el tipo de administrador. </br>';
        }else{
            var secciones = $('.secciones').val();

            if(!secciones){
                error += 'Por favor seleccione al menos una seccion. </br>';
            } 
            
            if($('.admin_type').val() != 'super-admin'){
                var kioscos = $('.kioscos').val();

                if(!kioscos){
                    var kiosco = $('.admin_type').val().split('-');
                    error += "Por favor seleccione una "+kiosco[0]+". </br>";
                }
            }

            if($('.nombre').val() == ""){
                error += 'Por favor escriba el nombre del admin. </br>';
            } 
            
            if(!validarCorreo($('.email').val())){
                error += "Por favor escriba un correo electrónico valido. <br>";
            } 

            if($('.pass').val() == ""){
                error += 'Por favor escriba la contraseña. </br>';
            }

            var exportar = $('input[name=exportar]:checked', '.form-create-admin').val();
            if(!exportar){
                error += 'Por favor seleccione si desea dar privilegios para exportar. </br>';
            }
        }

        if(error == ""){
            //Arrancamos el loading
            $('.loading_adminCreate').css('display','inline-block');
            $('.alert-danger').hide();
            
            $.ajax({
                url: "/admin/crear-admin", 
                dataType: "json",
                type:"POST",
                data: $('.form-create-admin').serialize(),
                success: function (dato) {
                    //Si todo esta bien
                    if(dato.code == 200){                   
                        //Ocultamos el bloque de secciones y datos
                        $('.contentSeccionesDatos').fadeOut();
                        
                        //Mostramos el mensaje de que se ha creado el admin correctamente
                        $('.alert-success span').text(dato.mensaje);
                        $('.alert-success').show();
                        document.getElementById("form-create-admin").reset();
                    }

                    //Toda clase de error.
                    if (dato.code == 400){
                        $('.alert-danger span').text(dato.mensaje);
                        $('.alert-danger').show();
                    }

                    $('.loading_adminCreate').fadeOut();
                }
            });
        }else{
            $('.alert-danger span').html(error);
            $('.alert-danger').show();
            movimiento_go('.portlet-title');
        }
    });

    /*
     * Date Picker para filtrar por fecha en el corte
     */
    $( "#fecha1" ).datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: "dd/mm/yy",
        onClose: function( selectedDate ) {
          $( "#fecha2" ).datepicker( "option", "minDate", selectedDate );
        }
    });

    $( "#fecha2" ).datepicker({
        changeMonth: true,
        numberOfMonths: 1,
        dateFormat: "dd/mm/yy",
        onClose: function( selectedDate ) {
          $( "#fecha1" ).datepicker( "option", "maxDate", selectedDate );
        }
    });



    /**
     * Select para asignar tiendas a los clientes en el dashboard
     */
    //Muestro las secciones que estaran disponibles para el administrador
    $('.tiendasDash').change(function(){
        //Si se ha seleccionado una tinda
        if($(this).val() != ""){
            window.id = $(this).data('id');
            window.id_cliente = $(this).data('cliente');

            $('.loading_tienda_'+id).fadeIn();
            $('.alert-danger').hide();

            $.ajax({
                url: "/admin/dashboard/asignar-tienda", 
                dataType: "json",
                type:"POST",
                data: "id_cliente="+id_cliente+'&tienda='+$(this).val()+'&orden='+id,
                success: function (dato) {
                    //Si todo esta bien
                    if(dato.code == 200){                   
                        $('.loading_tienda_'+id).fadeOut();
                    }

                    //Toda clase de error.
                    if (dato.code == 400){
                        $('.alert-danger span').text(dato.mensaje);
                        $('.alert-danger').show();

                        $('.loading_tienda_'+id).fadeOut();
                    }
                }
            });
        }
    });


    /**
     * Select para asignar el estado de pago
     */
    $('.pagoChange').change(function(){
        //Si se ha seleccionado un estado de pago
        if($(this).val() != ""){
            window.id = $(this).data('id');
            window.pago = $(this).val();

            $('.loading_pago_'+id).fadeIn();
            $('.alert-danger').hide();

            $.ajax({
                url: "/admin/ordenes/cambiar-pago", 
                dataType: "json",
                type:"POST",
                data: "pago="+pago+'&orden='+id,
                success: function (dato) {
                    //Si todo esta bien
                    if(dato.code == 200){                   
                        $('.loading_pago_'+id).fadeOut();
                    }

                    //Toda clase de error.
                    if (dato.code == 400){
                        $('.alert-danger span').text(dato.mensaje);
                        $('.alert-danger').show();

                        $('.loading_pago_'+id).fadeOut();
                    }
                }
            });
        }
    });

    /**
     * Desplegamos las listas de la empresa
     */
    $('.get-listas').change(function(){
        if($(this).val() != ''){
            $('.alert-danger').fadeOut();
            $('.loading').fadeIn();
            $('.loading-empresa').fadeIn();

            window.empresa = $(this).val();

            $.ajax({
                url: "/admin/get-listas", 
                dataType: "json",
                type:"POST",
                data: 'empresa='+empresa,
                success: function (dato) {
                    if(dato.code == 200){
                        //Pintamos las listas
                        $('.listas').html(dato.mensaje)
                        $('.mensajeros').html(dato.mensajeros)
                        $('.loading').fadeOut();
                        $('.loading-empresa').fadeOut();
                    }

                    //Toda clase de error.
                    if (dato.code == 400){
                        $('.alert-danger').text(dato.mensaje);
                        $('.loading').fadeOut();
                        $('.loading-empresa').fadeOut();
                    }
                }
            });
        }else{
            $('.listas').html('<option value="">Listas: Seleccionar primero la empresa...</option>');
        }
    });

    /***** Tablas Dinamicas *******/
    $('#table1').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 1 },
            { "searchable": false, "targets": 1 }
        ]
    });
    $('#table2').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 2 },
            { "searchable": false, "targets": 2 }
        ]
    });
    $('#table3').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 3 },
            { "searchable": false, "targets": 3 }
        ]
    });
    $('#table5').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 5 },
            { "searchable": false, "targets": 5 }
        ]
    });
    $('#table6').DataTable({
        "columnDefs": [
            { "orderable": false, "targets": 6 },
            { "searchable": false, "targets": 6 }
        ]
    });

    /**** Despliego  el crear o seleccionar lista ****/
    $(document).on('click','#list-vieja',function(){
        $('#mensajeroContent').hide();
        $('.listNew').hide();
        $('.listOld').fadeIn();
        $('.dontentDestinatario').fadeIn();
    });
    $(document).on('click','#list-nueva',function(){
        $('#mensajeroContent').show();
        $('.listOld').hide();
        $('.listNew').fadeIn();
        $('.dontentDestinatario').fadeIn();
    });

    $('.btn-eliminar').click(function(){
        if (confirm('¿Desea eliminar el registro?')){
            return true;
        }else{
            return false;
        }
    });

    /**
     * Copia del formulario de destinatarios
     */
    var f = 2;
    $(document).on('click','.add-destinatario',function(){

        var cantidad = $('.ecr-row-destinatario').length;

        var html = '';

            html += '<div class="ecr-row-destinatario formulario-destinatarios" id="fila-'+(cantidad+1)+'">';
                
                html += '<h3>Destinatario No.'+(cantidad+1)+'<h3>';
                
                html += '<div class="form-group">';
                    html += '<label for="">Nombre: </label>';
                    html += '<input type="text" id="nombre" name="nombre[]" class="form-control" required>';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Cédula: </label>';
                    html += '<input type="text" id="cedula" name="cedula[]" class="form-control onlyNumber" required>';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Correo electrónico: </label>';
                    html += '<input type="email" id="email" name="email[]" class="form-control">';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Teléfono: </label>';
                    html += '<input type="text" id="t1" name="t1[]" class="form-control onlyNumber" required>';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Teléfono 2: </label>';
                    html += '<input type="text" id="t2" name="t2[]" class="form-control onlyNumber">';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Dirección: </label>';
                    html += '<input type="text" id="direccion" name="direccion[]" class="form-control" required>';
                html += '</div>';

                if ($('#ecr-sencillos').length) {
                    html += '<div class="form-group">';
                        html += '<label for="">Dirección 2: </label>';
                        html += '<input type="text" id="direccion2" name="direccion2[]" class="form-control" required>';
                    html += '</div>';
                    html += '<div class="form-group">';
                        html += '<label for="">Ciudad: </label>';
                        html += '<input type="text" id="ciudad" name="ciudad[]" class="form-control" required>';
                    html += '</div>';
                    html += '<div class="form-group">';
                        html += '<label for="">Provincia: </label>';
                        html += '<input type="text" id="provincia" name="provincia[]" class="form-control" required>';
                    html += '</div>';
                    html += '<div class="form-group">';
                        html += '<label for="">Código postal: </label>';
                        html += '<input type="text" id="cp" name="cp[]" class="form-control" required>';
                    html += '</div>';
                }


                html += '<div class="form-group">';
                    html += '<label for="">Referencia: </label>';
                    html += '<input type="text" id="referencia" name="referencia[]" class="form-control" >';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Autorizado 1 Nombre: </label>';
                    html += '<input type="text" id="autorizado_nombre1" name="autorizado_nombre1[]" class="form-control" >';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Autorizado 1 Cédula: </label>';
                    html += '<input type="text" id="autorizado_cedula1" name="autorizado_cedula1[]" class="form-control onlyNumber" >';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Autorizado 2 Nombre: </label>';
                    html += '<input type="text" id="autorizado_nombre2" name="autorizado_nombre2[]" class="form-control" >';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Autorizado 2 Cédula: </label>';
                    html += '<input type="text" id="autorizado_cedula2" name="autorizado_cedula2[]" class="form-control onlyNumber" >';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Autorizado 3 Nombre: </label>';
                    html += '<input type="text" id="autorizado_nombre3" name="autorizado_nombre3[]" class="form-control" >';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Autorizado 3 Cédula: </label>';
                    html += '<input type="text" id="autorizado_cedula3" name="autorizado_cedula3[]" class="form-control onlyNumber" >';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Autorizado 4 Nombre: </label>';
                    html += '<input type="text" id="autorizado_nombre4" name="autorizado_nombre4[]" class="form-control" >';
                html += '</div>';
                html += '<div class="form-group">';
                    html += '<label for="">Autorizado 4 Cédula: </label>';
                    html += '<input type="text" id="autorizado_cedula4" name="autorizado_cedula4[]" class="form-control onlyNumber" >';
                html += '</div>';                
            html += '</div>';

        /**
         * Imprimo el html
         */
        $('#tabla-form-destinatarios').append(html);

        $('.ecr-titular-dest').text("Agregar destinatario ("+(cantidad+1)+")");

        return false;
    });

    /**
     * Elimuno  una fila de destinatario
     */
    $(document).on('click','.rm-destinatario',function(){

        var cantidad = $('.ecr-row-destinatario').length;

        if(cantidad == 1){
            return false;          
        }

        $('#fila-'+cantidad).remove();

        var cantidad = $('.ecr-row-destinatario').length;

        $('.ecr-titular-dest').text("Agregar destinatario ("+cantidad+")");

        return false;
    });



    /**
     * Seleccionar todos los checkbox
     */
    $(document).on('click','.check-all',function(){
        $('.check-gnl').each(function(){
            $(this).attr('checked','checked');
        });

        $('.check-label span').addClass('checked');
        $('span',this).addClass('checked');
    });


});//END READY

$( "#fecha_movimiento" ).datepicker({
    changeMonth: true,
    numberOfMonths: 1,
    dateFormat: "dd/mm/yy"
});

$('#hora_movimiento').timepicker({ 'timeFormat': 'H:i:s' });

//muestra movimientos en paquetes
function verMovimientos(c){
    $("#id_destinatario").val(c);
    $.post( "tableMovimientos",{buscar:c}, function( data ) {
        $('.tableMovimientos tbody').html(data);
    });
}

function mostrarMovimiento(i,m){
    data = {
        id:i,
        mostrar:m
    }
    $.post( "setMostrar",data, function( data ) {

    });    
}

$('#form-movimientos').on('submit', function(e){
    e.preventDefault();
    // validation code here
    $.post( "setMovimientos",$(this).serialize(), function( data ) {
        $('.tableMovimientos tbody').html(data);
        $('#form-movimientos input#fecha_movimiento,#form-movimientos input#hora_movimiento,#form-movimientos select,#form-movimientos textarea').val('');
    });
});

$( ".form-tracking" ).on( "submit", function(event) {
    event.preventDefault();
});

$( "#TrackingCode" ).on( "keyup", function(event) {
    
    var counttrack = 0;
    
    $(".value-tracking_code").each(function(i,v){
        if($(v).text().trim() == $( "#TrackingCode").val().trim())
        {
            counttrack++;
        }
    });

    if(event.which == 13) {
      if(counttrack===0){
        $.post("trackingBarcorder",$("#TrackingCode").serialize(),function(data){
            $(".table-tracking tbody").append(data);            
        });
      }
      $( "#TrackingCode" ).attr("value","");
    }


    $(this).focus();
});

$(".btn-registrar").on("click",function(e){

    if($("#estado").val()!=""){
        var lote = '';
        $(".value-tracking_code").each(function(i,v){
            if($(v).text() != "undefined" || $(v).text() != ""){lote += $(v).text() + ',';}
        });
        if(lote!=''){
            $.post("registrar",{"lote":lote,"estado":$("#estado").val()},function(data){
                if(data==1){
                    $(".table-tracking tbody").html("");
                    alert("Cambios completados");
                }else{
                    alert("Error al guardar");                    
                }
            });
        }
    }else{
        alert("Debe colocar un estado");
    }
    $( "#estado" ).attr("value","");
    $( "#trackingBarcorder" ).focus();
});


$(".btn-TrackingCode.clear").on("click",function(event){
    $( "#estado" ).val("");
    $( "#TrackingCode" ).val("");
    $(".table-tracking tbody").html('');
    $( "#TrackingCode" ).focus();
});

function adminEstados(i,e,d){
    $("#id").attr("value",i);
    $("#estado").attr("value",e);
    $("#detalle").attr("value",d);
}

/**
 * 
 * Muestra Alertars tipo SweetAlert 
 * 
 */
function mostararAlertaSweet(titulo,mensaje,tipo){
    swal({
        title: titulo,
        text: mensaje,
        type: tipo
    });
}

function toggleCheck(source) {
    var checkboxes = document.querySelectorAll('input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i] != source){
            checkboxes[i].checked = source.checked;
        }
    }
}

$('.ecr-add-mensajero').click(function(){
    var ids = $(".ecr-select:checkbox:checked").map(function(){
        return $(this).data('id');
    }).get();

    var names = $(".ecr-select:checkbox:checked").map(function(){
        return $(this).data('name');
    }).get();

    if (ids.length > 0) {
        $('#ecr-msj-destinatarios-hide').val(ids.join());

        $('#ecr-msj-destinatarios').html('');

        for (var i = 0; i < names.length; i++) {
            $('#ecr-msj-destinatarios').append('<option>'+names[i]+'</option>');
        }

        $('#ecr-modal-add-msj').modal('show');

    }else{
        mostararAlertaSweet('Error','Debe seleccionar al menos un destinatario','error');
        $('.ecr-add-mensajero').prop('disabled',false);
    }
});

function changeDestStatus(tag,status){
    console.log($(tag));
    console.log(status);

    if (status == 0) {
        $(tag).removeClass('label-success');
        $(tag).addClass('label-danger');
        $(tag).text('No');
        $(tag).data('status',0);
    }
    else{
        $(tag).removeClass('label-danger');
        $(tag).addClass('label-success');
        $(tag).text('Si');
        $(tag).data('status',1);
    }
}

$(document).on("click",".ecr-trigger-update-destinatarios-status",function(){
    
    $(this).prop('disabled',true);

    window._this = this;

    var url = $(this).data('url');

    var type = $(this).data('type');
    var id = $(this).data('id');
    var status = parseInt($(this).data('status'));

    changeDestStatus(this,status);

    var request = $.ajax({
        url: "/admin/destinatarios/update/"+type+"/"+status+"/"+id,
        type: 'POST',
        dataType: 'json'
    });
    
    request.always(function(data) {
        if(data.code == 200){
        
        }
        else{
            mostararAlertaSweet('Error',data.message,'error');
            var newstatus = (status == 1) ? 0 : 1; 
            // Rollback
            changeDestStatus(_this,newstatus);
        }

        $(_this).prop('disabled',false);
    });
});

$('.ecr-check-pass').strength_meter({

    //  CSS selectors
    strengthWrapperClass: 'strength_wrapper',
    inputClass: 'strength_input form-control',
    strengthMeterClass: 'strength_meter',
    toggleButtonClass: 'button_strength',

    // text for show / hide password links
    showPasswordText: 'Show Password',
    hidePasswordText: 'Hide Password'
  
});