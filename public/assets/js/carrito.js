const fragment = document.createDocumentFragment();
class Carrito {

  comprarProducto(e) {
    if (e.target.classList.contains("agregar-carrito")) {   
      this.leerDatosProducto(e.target.parentElement.parentElement.parentElement);   
    }
  }

  leerDatosProducto(producto) {
    
    const infoProducto = {
      imagen: producto.querySelector("img").src,
      titulo: producto.querySelector("h6").textContent,
      precio: producto.querySelector(".precio span").textContent,
      id: producto.querySelector(".dataId input").getAttribute("data-id"),
      stock: producto.querySelector(".stock span").textContent,
      cantidad: 1,
    };

    
    let productosLS = this.obtenerProductosLocalStorage();

    for (let i = 0; i < productosLS.length; i++) {
      if (productosLS[i].id === infoProducto.id) {
        infoProducto.cantidad += productosLS[i].cantidad;
      }
    }

    console.log(infoProducto.stock)

    productosLS.forEach(function (productoLS) {
      if (productoLS.id === infoProducto.id) {
        productosLS = productoLS.id;
      }
    });

    if (productosLS === infoProducto.id) {
      this.eliminarProductoLocalStorage(productosLS);
      this.insertarCarrito(infoProducto);
    } else {
      this.insertarCarrito(infoProducto);
    }
  }

  insertarCarrito(producto) {
    const row = document.createElement("tr");
    row.innerHTML = `
           <td>
               <img src="${producto.imagen}" width=100>
           </td>
           <td>
               ${producto.titulo}
           </td>
           <td>
               ${producto.cantidad}
           </td>
           <td>
               ${producto.precio * producto.cantidad}
           </td>
           <td>
               <a href ="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a> 
           </td>
        `;


    listaProductos.appendChild(row);
    this.guardarProductosLocalStorage(producto);
  }

  eliminarProducto(e) {
    
    let producto, productoID;
    if (e.target.classList.contains("borrar-producto")) {
      e.target.parentElement.parentElement.parentElement.remove();
      producto = e.target.parentElement.parentElement.parentElement;
      productoID = producto.querySelector("a").getAttribute("data-id");
    }
    this.eliminarProductoLocalStorage(productoID);
    location.href = "removeToCart?rowid="+rowid;
  }

  eliminarProductoCompra(e) {
    e.preventDefault();
    let producto, productoID, rowid;

    console.log(e.target.parentElement.parentElement);
    if (e.target.classList.contains("borrar-producto-compra")) {
      e.target.parentElement.parentElement.parentElement.remove();
      producto = e.target.parentElement.parentElement;
      productoID = producto.querySelector("th a").getAttribute("data-id")
      rowid = producto.querySelector("#rowid").textContent;
      console.log(productoID)
      console.log(rowid)
    }
    this.eliminarProductoLocalStorage(productoID);
    location.href = "removeToCart?rowid="+rowid;
  }

  eliminarProductoLocalStorage(productoID) {
    let productosLS;
    productosLS = this.obtenerProductosLocalStorage();
    productosLS.forEach(function (productoLS, index) {
      if (productoLS.id === productoID) {
        productosLS.splice(index, 1);
      }
    });
    localStorage.setItem("productos", JSON.stringify(productosLS));
  }

  vaciarCarrito(e) {
    while (listaProductos.firstChild) {
      listaProductos.removeChild(listaProductos.firstChild);
    } 
    this.vaciarLocalStorage();
    this.vaciarCartLibrary();
    return false;
  }

  vaciarLocalStorage() {
    localStorage.clear();
  }

  vaciarCartLibrary(){
    location.reload();
    location.href = "cartDestroy";
   
  }

  guardarProductosLocalStorage(producto) {
    let productos;
    productos = this.obtenerProductosLocalStorage();
    productos.push(producto);
    localStorage.setItem("productos", JSON.stringify(productos));
  }

  obtenerProductosLocalStorage() {
    let productoLS;

    if (localStorage.getItem("productos") === null) {
      productoLS = [];
    } else {
      productoLS = JSON.parse(localStorage.getItem("productos"));
    }
    return productoLS;
  }

  leerLocalStorage() {
    let productosLS;
    productosLS = this.obtenerProductosLocalStorage();
    productosLS.forEach(function (producto) {
      const row = document.createElement("tr");
      row.innerHTML = `
               <td>
                   <img src="${producto.imagen}" width=100>
               </td>
               <td>
                   ${producto.titulo}
               </td>
               <td>
                   ${producto.cantidad}
               </td>
               <td>
                   ${producto.precio * producto.cantidad}
               </td>
               <td>
               <a href ="#" class="borrar-producto fas fa-times-circle" data-id="${producto.id}"></a> 
               </td>
            `;
            fragment.appendChild(row);
    });
    listaProductos.appendChild(fragment)
  }

}
