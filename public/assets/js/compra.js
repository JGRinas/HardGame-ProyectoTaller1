const procesarCompraBtn = document.getElementById("procesar-compra");
cargarEventos2()
function cargarEventos2(){
    procesarCompraBtn.addEventListener('click', (e)=>{
       
        procesarCompra(e)
    })
}

function procesarCompra(e) {
    e.preventDefault();
    if (carro.obtenerProductosLocalStorage().length === 0) {
      Swal.fire({
        type: "error",
        title: ":(",
        text: "El carrito está vacío, no hay productos",
        timer: 2000,
        showConfirmButton: false,
      }).then(function () {
        window.location = "products";
      });
    } else if (cliente.value === "" || correo.value === "") {
      Swal.fire({
        type: "error",
        title: ":(",
        text: "Ingrese todos los campos requeridos",
        timer: 2000,
        showConfirmButton: false,
      });
    } else {
      const cargandoGif = document.querySelector("#cargando");
      cargandoGif.style.display = "block";
      const enviado = document.createElement("img");
      enviado.src = "public/assets/img/mail.gif";
      enviado.style.display = "block";
      enviado.width = "150";
      
      setTimeout(() => {
        cargandoGif.style.display = "none";
        document.querySelector("#loaders").appendChild(enviado);
        setTimeout(() => {
          enviado.remove();
          swal({
            title: "Procesando compra",
            text: "En breve será redireccionado",
            type: "info",
          });
        setTimeout(() => {   
            carro.vaciarLocalStorage();
            location.href = "newPurchases";
        }, 5000);
          
        }, 3000);
        
      }, 3000);
      
    }
    
  }