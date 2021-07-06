<?php session_start(); ?>
<?php include 'header.php'; ?>

<script>
function miFuncion(){
  var desc = document.getElementById('descrip_s');
  var desc2 = document.getElementById('descrip_t');
  desc.style.display = 'none';
  desc2.style.display = 'none';
}

function s_desc_1(){
    var desc = document.getElementById('descrip_s');
    desc.style.display = 'none';
    desc.style.margin= '0vh';
  }
  function s_desc_2(){
    var desc = document.getElementById('descrip_s');
    desc.style.display = 'block';
    desc.style.margin = '1vh';
  }

  
function t_desc_1(){
    var desc = document.getElementById('descrip_t');
    desc.style.display = 'none';
    desc.style.margin = '0vh';
  }
  function t_desc_2(){
    var desc = document.getElementById('descrip_t');
    desc.style.display = 'block';
    desc.style.margin = '1vh';
  }


</script>

<body class="hold-transition login-page" onload="miFuncion();">
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
            <label for="switch" class="lb"></label>
            <span id="salida" >SALIDA</span>

<!--
             <select class="form-control" name="status">
                <option value="in">Hora de Entrada</option>
                <option value="out">Hora de Salida</option>
              </select>
-->
          
          <h4 class="login-box-msg">ID de Empleado</h4>
          <div class="empleado">
            <div class="form-group has-feedback">
              <input type="text" class="form-control input-lg" id="employee" name="employee">
              <span class="glyphicon glyphicon-share form-control-feedback"></span>
            </div>
          </div>
          <span class="s_salud">SALUD</span>
          <div class="salud" id="salud">
                  <div class="toggle-radio">
                    <input type="radio" name="rdo" id="yes" value=0 onclick="s_desc_1()">
                    <input type="radio" name="rdo" id="no" value=1 onclick="s_desc_2()">
                    <div class="switch">
                      <label id="lb_bm" for="yes">Bueno</label>
                      <label id="lb_bm" for="no">Malo</label>
                      <span></span>
                    </div>
                  </div>
          </div>
      		

          <span class="s_equip">TECNICO</span>
          <div class="equip" id="equip">
                  <div class="toggle-radio">
                    <input type="radio" name="rdo2" id="yes2" value=2 onclick="t_desc_1()">
                    <input type="radio" name="rdo2" id="no2" value=4 onclick="t_desc_2()">
                    <div class="switch2">
                      <label id="lb_bm2" for="yes2">OK</label>
                      <label id="lb_bm2" for="no2">NO</label>
                      <span></span>
                    </div>
                  </div>
          </div>

          <div class="descrip_s">
            <div class="form-group has-feedback">
              <textarea name="descrip_s" id="descrip_s" cols="45" rows="3" placeholder="Problema Salud: Descripción breve..." ></textarea>
             
              <!-- <input type="text" cols="1" rows="3" class="form-control input-lg" id="descrip" name="descrip" placeholder="Descripción del problema..." required>
              -->

            </div>
          </div>
          <hr>
          <div class="descrip_t">
            <div class="form-group has-feedback">
              <textarea name="descrip_t" id="descrip_t" cols="45" rows="3" placeholder="Problema Tecnico: Descripción breve..." ></textarea>
             
              <!-- <input type="text" cols="1" rows="3" class="form-control input-lg" id="descrip" name="descrip" placeholder="Descripción del problema..." required>
              -->

            </div>
          </div>

          <div class="row">
    			<div class="col-xs-4">
          			<button type="submit" class="btn btn-primary btn-block btn-flat" style="display: none;" name="signin"><i class="fa fa-sign-in"></i> Login</button>
        		</div>
      		</div>
          <div class="ip">
            <spam id="ipp" name="ipp">Deshabilitar AdBlock</spam>
            <input type="text" style="display: none;" name="ip" id="ip" >
              
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
    if (document.querySelector('#switch').checked == true) {
      document.querySelector('#yes').checked = true;
      document.querySelector('#yes2').checked = true; 
    }
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
          //setTimeout(function(){ location.reload(); }, 3500);  
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

  function getIP(json) {
      document.getElementById('ip').value = (json.ip);
      document.getElementById('ipp').innerHTML = "Registro con IP: " + (json.ip);
  }

</script>

<script src="http://api.ipify.org?format=jsonp&callback=getIP"></script>

</body>
<footer>
  <div class="foot">
    
    <spam > <span style="font-size: 0.9rem;" class="glyphicon glyphicon-user"></span> - JChavez - zextjchavez@correoargentino.com.ar - <img src="images/logo2.png" width="11" height="9"> Correo Argentino © - <img src="images/logo1.png" width="15" height="8"> Novatium © - 2021 </spam>
  </div>
</footer>
</html>