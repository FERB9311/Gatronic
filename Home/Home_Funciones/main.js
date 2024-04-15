$(document).ready(function(){
    //Cargar el carro
    function load_cart(){
        var wrapper = $('#cart_wrapper'),
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
                wrapper.waitMe();
            }
        }).done(function(res){
            if(res.status === 200){
                wrapper.html(res.data);
            }
        }).fail(function(err){
            swal('Upps!','Ocurrió un error','error'); // Mostrar el error en la ventana desde la que se agrega el producto
            wrapper.html('¡Intenta de nuevo, por favor!');
            return true;
        }).always(function(){
          setTimeout(() => {
            wrapper.waitMe('hide');
          }, 3500);
        });
    };

    load_cart();

    // Evento click para agregar al carrito
    $('.do_add_to_cart').on('click', function(event){
        //Prevenir una acción
        //submit / redirección
        event.preventDefault();
        var id = $(this).data('id'),
        cantidad = $(this).data('cantidad'),
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
                swal('¡Bien hecho!','Producto agregado al carrito','success'); // Mostrar la notificación de éxito en la ventana desde la que se agrega el producto
                load_cart(); // Si el producto se agrega correctamente, simplemente volvemos a cargar el carrito
                return;
            }else{
                swal('Upps!',res.msg,'error'); // Mostrar el error en la ventana desde la que se agrega el producto
                return;
            }
        }).fail(function(err){

        }).always(function(){

        });
    });
});
