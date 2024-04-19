 //Cargar el carro
function load_cart(){
    var load_wrapper = $('#load_wrapper'),
    wrapper = $('#cart_wrapper'),
    action = 'get';

    //Petición ajax
    $.ajax({
        url:'Home_Funciones/ajax.php',
        type: 'POST',
        dataType: 'JSON',
        data:{
            action
        },
        beforeSend: function(){
            load_wrapper.waitMe();
        }
    }).done(function(res){
        if(res.status === 200){
            setTimeout(() => {
                wrapper.html(res.data);
                load_wrapper.waitMe('hide');
            }, 2000);
        }
    }).fail(function(err){
        swal('Upps!','Ocurrió un error','error'); // Mostrar el error en la ventana desde la que se agrega el producto
        wrapper.html('¡Intenta de nuevo, por favor!');
        return true;
    }).always(function(){
    
    });
};

 
 $(document).ready(function(){
        
        // Evento click para agregar al carrito
        $('.do_add_to_cart').on('click', function(event){
            //Prevenir una acción
            //submit / redirección
            event.preventDefault();
            var id = $(this).data('id'),
            cantidad = $(this).prev('input[type="number"]').val(),
            action = 'post';

            $.ajax({
                url: 'Home_Funciones/ajax.php',
                type: 'POST',
                dataType: 'JSON',
                cache: false,
                data: {
                    action,
                    id,
                    cantidad
                },
                beforeSend: function(){
                    console.log('Agregando...');
                }
            }).done(function(res){
                if(res.status === 201){
                    swal('¡Bien hecho!','Producto agregado al carrito','success'); 
                    load_cart(); 
                }else{
                    swal('Upps!',res.msg,'error'); 
                    return;
                }
            }).fail(function(err){
                swal('Upps!',res.msg,'error'); 
                    return;
            }).always(function(){

            });
        });

        // Actualizar carro con input
        $('body').on('blur', '.do_update_cart', function(event) {
            var cantidad = $(this).val();
            var id = $(this).data('id');
            var action = 'put';


            $.ajax({
            url: 'Home_Funciones/ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data:
            {
                action,
                id,
                cantidad
            }
            }).done(function(res) {
            if(res.status === 200) {
                swal('¡Bien hecho!', 'Producto actualizado con éxito', 'success');
                load_cart();
                return;
            }
            else {
                swal('Upps!', res.msg, 'error');
                return;
            }
            }).fail(function(err) {
            swal('Upps!', 'Ocurrió un error', 'error');
            }).always(function() {
            });
        });

        // Eliminar un producto del carrito
        $('body').on('click', '.do_delete_from_cart', delete_from_cart);

        function delete_from_cart(event) {
            var confirmation,
                id = $(this).data('id'), // Corrección aquí
                action = 'delete';

            confirmation = confirm('¿Estás seguro?');

            if (!confirmation) return;

            $.ajax({
                url: 'Home_Funciones/ajax.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    action,
                    id
                }
            }).done(function(res) {
                if (res.status === 200) {
                    swal('Producto borrado con éxito');
                    load_cart();
                    return;
                } else {
                    swal('Upps!', res.msg, 'error');
                    return;
                }
            }).fail(function(err) {
                swal('Upps!', 'Hubo un error, intenta de nuevo', 'error');
            }).always(function() {

            });
        }


        // Vaciar carrito
        $('body').on('click', '.do_destroy_cart', destroy_cart);
            function destroy_cart(event){
                var confirmation,
                action = 'destroy';

                confirmation = confirm('¿Estás seguro?');

                if(!confirmation) return;

                $.ajax({
                    url: 'Home_Funciones/ajax.php',
                    type: 'POST',
                    dataType: 'JSON',
                    data:{
                        action
                    }
                }).done(function(res){
                    if(res.status === 200){
                        swal('Carrito borrado con éxito');
                        load_cart();
                        return;
                    } else{
                        swal('Upps!',res.msg,'error');
                        return;
                    }
                }).fail(function(err){
                    swal('Upps!', 'Hubo un error, intenta de nuevo', 'error');
                }).always(function(){

                });
            }

        // Realizar el pago
        $('body').on('submit','#do_pay',do_pay);
        function do_pay(event) {
            event.preventDefault();
            var action = 'pay';

            $.ajax({
            url: 'Home_Funciones/ajax.php',
            type: 'POST',
            dataType: 'JSON',
            data: {
                action,
                
            },
            beforeSend: function() {
            }
            }).done(function (res) {
            if (res.status === 200) {
                $('body').waitMe();
                setTimeout(() => {
                $('body').waitMe('hide');
                load_cart();
                load_order_resume();
                }, 4500);
                return;
            } else {
                swal('Upps!', res.msg, 'error');
                return;
            }
            }).fail(function (err) {
            swal('Upps!', 'Hubo un error, intenta de nuevo', 'error');
            }).always(function () {
            });
        }
        
        // Resumen de compra
        function load_order_resume() {
            var action = 'order_resume';
            $.ajax({
            url: 'Home_Funciones/ajax.php',
            type: 'POST',
            dataType: 'json',
            data:
            {
                action
            }
            }).done(function(res){
            if(res.status === 200) {
                $('body').append(res.data);
                $('#order_resume').modal('show');
                load_cart();
            }
            }).fail(function(err){

            });
        }

    });

