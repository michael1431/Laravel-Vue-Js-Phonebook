<!DOCTYPE html>
<html>

<head>
	<title>Vue Js and Laravel Phonebook App</title>
</head>

<link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">

<body>

	<div id="app">
	

		<Myheader></Myheader>
	
  <!-- component matched by the route will render here -->

  		<div class="container">
  			
  		<router-view></router-view>

  		</div>

       


		<Myfooter></Myfooter>


	</div>


	<script src="{{ asset('js/app.js') }}"></script>

</body>
</html>