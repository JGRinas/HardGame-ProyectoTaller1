const carro = new Carrito();
const carrito = document.getElementById("carrito");
const productos = document.getElementById("lista-productos");
const listaProductos = document.querySelector("#lista-carrito tbody");
const vaciarCarritoBtn = document.getElementById("vaciar-carrito"); 
const procesarPedidoBtn = document.getElementById("procesar-pedido"); 
const eliminarProductoBtn = document.getElementById("eliminar-producto-compra");

cargarEventos();

function cargarEventos() {

  document.addEventListener("DOMContentLoaded", () => {

    carro.leerLocalStorage();
    verCarritoVacio();
    
      vaciarCarritoBtn.addEventListener("click", (e) => {
        carro.vaciarCarrito(e);
 
      });

      carrito.addEventListener("click", (e) => {
        carro.eliminarProductoCompra(e);
      });
   
      eliminarProductoBtn.addEventListener("click", (e)=>{        
        carro.eliminarProductoCompra(e);        
      });

  });
  
  productos.addEventListener("click", (e) => {
    carro.comprarProducto(e);
  });
 
}

function verCarritoVacio() {
  if (carro.obtenerProductosLocalStorage().length === 0) {
    const carritoVacio = document.getElementById('carritoVacio')

    carritoVacio.classList.remove("hide")
  } else {
   
    procesarPedidoBtn.classList.remove("hide")
    vaciarCarritoBtn.classList.remove("hide")

    procesarPedidoBtn.classList.add("btn-success")
    vaciarCarritoBtn.classList.add("btn-danger")
    procesarPedidoBtn.classList.add("btn")
    vaciarCarritoBtn.classList.add("btn")
    procesarPedidoBtn.classList.add("btn-block")
    vaciarCarritoBtn.classList.add("btn-block")
  }
}

