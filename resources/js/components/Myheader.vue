<template>


<nav class="navbar" role="navigation" aria-label="main navigation">

  <div class="navbar-brand">
    <a class="navbar-item" href="https://bulma.io">
   <h1 style="font-weight:bold; color: red; font-size:25px;" >Laravel Vue Js Phonebook</h1>
    </a>

      <div class="navbar-menu is-active">

        <!-- Router link -->
        
      <router-link to="/home" class="navbar-item"><strong>Home</strong></router-link>
      <router-link to="/about" class="navbar-item"><strong>About</strong></router-link>

      </div>
     

     <button class="button navbar-burger">

      <span></span>
      <span></span>
      <span></span>
       

     </button>
  
  </div>
</nav>



</template>


