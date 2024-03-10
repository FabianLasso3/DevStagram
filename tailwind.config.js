/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.blade.js",
    //necesario para agregar estilos de tailwind a la paginacion
    "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

//De forma recursiva va entrar a todas las carptesas y va a buscar a todos los archivos .blade.php que estan en resources
//git mode se añada tailwind solo al componente que uno le indique