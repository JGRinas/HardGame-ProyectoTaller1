document.addEventListener("DOMContentLoaded", ()=>{
    const btnDescargarPdf = document.querySelector(".btnDescargarPdf");
    btnDescargarPdf.addEventListener("click", ()=>{
        const elementoAConvertir = document.body;
        html2pdf()
        .set({
            margin: 1,
            filename: 'comprobante.pdf',
            image: {
                type: 'jpeg',
                quality: 0.98
            },
            html2canvas: {
                scale: 3,
                letterRendering: true,
            },
            jsPDF: {
                unit: "in",
                format: "a3",
                orientation: 'portrait'//hoja normal, vertical
            }
        })
        .from(elementoAConvertir)
        .save()
        .catch(err => console.log(err))
        .then(() =>{
            console.log('guardado')
        })
    })
})