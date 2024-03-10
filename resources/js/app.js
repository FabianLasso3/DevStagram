import Dropzone from "dropzone";

Dropzone.autoDiscover = false;

//Configuracion de dropzones para poder subir imagenes al servidor 
//primero se hizo una instalacion atraves de la pagina con un npm
const dropzone = new Dropzone('#dropzone' ,{
    dictDefaultMessage: "Sube aqui tu imagen",
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    //Mantener la imagen que se subio por si faltan datos en el formulario, osea pa que la suba una ves y llene lo que falta del formulario
    init: function() {
        if(document.querySelector('[name="imagen"]').value.trim()){
            const imagenPublicada = {}
            imagenPublicada.size = 1234;
            imagenPublicada.name = document.querySelector('[name="imagen"]').value;

            this.options.addedfile.call(this, imagenPublicada);
            this.options.thumbnail.call(this, imagenPublicada, `../uploads/${imagenPublicada.name}`);

            imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
        }
    },
});

dropzone.on('success', function(file, response) {
    document.querySelector('[name="imagen"]').value = response.imagen;
});


// dropzone.on("error", function(file, message) {
//     console.log(message);
// })
//Remover imagen que no deseamos subir, que en todo caso se sube el nombre no la imagen
dropzone.on("removedfile", function() {
    document.querySelector('[name="imagen"]').value = "";
})