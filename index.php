<?php session_start(); ?>
<?php include 'header.php'; ?>
<body class="hold-transition login-page">
<div class="login-box">
  	<div class="login-logo">
  		<p id="date"></p>
      <p id="time" class="bold"></p>
  	</div>
  
  	<div class="login-box-body">
    	

    	<form id="attendance">
          <div class="form-group">
           
            <span id="entrada">ENTRADA</span>
            <input type="checkbox" id="switch" value="out" name="status"/>
            <label for="switch"></label>
            <span id="salida" >SALIDA</span>

<!--
             <select class="form-control" name="status">
                <option value="in">Hora de Entrada</option>
                <option value="out">Hora de Salida</option>
              </select>
-->
          </div>
          <h4 class="login-box-msg">Ingrese su ID de Empleado</h4>

      		<div class="form-group has-feedback">
        		<input type="text" class="form-control input-lg" id="employee" name="employee" required>
        		<span class="glyphicon glyphicon-share form-control-feedback"></span>
      		</div>
      		<div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" style="display: none;" name="signin"><i class="fa fa-sign-in"></i> Login</button>
        		</div>
      		</div>
    	</form>
  	</div>
		<div class="alert alert-success alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-check"></i> <span class="message"></span></span>
    </div>
		<div class="alert alert-danger alert-dismissible mt20 text-center" style="display:none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <span class="result"><i class="icon fa fa-warning"></i> <span class="message"></span></span>
    </div>
  		
</div>
	
<?php include 'scripts.php' ?>
<script type="text/javascript">
$(function() {
  var interval = setInterval(function() {

    var momentNow = moment().locale('es');

    $('#date').html(momentNow.format('dddd').substring(0,3).toUpperCase() + ' - ' + momentNow.format('DD').toUpperCase() + ' de ' + momentNow.format('MMMM').toUpperCase());  
    $('#time').html(momentNow.format('hh:mm:ss A'));
  }, 100);

  $('#attendance').submit(function(e){
    e.preventDefault();
    var attendance = $(this).serialize();
    alert(attendance);
    $.ajax({
      type: 'POST',
      url: 'attendance.php',
      data: attendance,
      dataType: 'json',
      success: function(response){
        if(response.error){
          $('.alert').hide();
          $('.alert-danger').show();
          $('.message').html(response.message);
          setTimeout(function(){ location.reload(); }, 3500);  
        }
        else{
          $('.alert').hide();
          $('.alert-success').show();
          $('.message').html(response.message);
          $('#employee').val('');
          setTimeout(function(){ location.reload(); }, 3500);
        }
      }
    });
  });
    
});
</script>
</body>
</html>