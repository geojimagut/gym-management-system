<style>
  body{
    /* background-image:url() */
  }
	#blurr-back{
		position:absolute;
		height:100vh;
		width:100%;
		background-color:#000;
		z-index:100;
    opacity:0.3;
		display:none;
	}
  #update-panel{
    position:absolute;
    height:fit-content;
    padding-bottom:10px;
    width:40%;
    margin-left:30%;
    background-color:#FFFFFF;
    z-index:101;
    display:none;
    margin-top:50px;
  }
  .update-panel form{
    width:90%;
    margin-left:5%;
  }
  .update-panel{
    display:flex;
  }
  .update-flex{
    width:100%;
  }
  #ide_update_panel{
    float:right;
  }
  #msg_result{
    height:20px;
    margin-left:5%;
    margin-top:10px;
  }
</style>

<!--
updating panel
-->
<div id="blurr-back">

</div>
<div id="update-panel"class="update-panel">
  <div id="msg_result"></div>
<form id="frmUpdate">
  <div class="form-group">
    <label for="exampleInputEmail1">ID NO.</label>
    <input type="hidden"name="txthidden"id="txthidden">
    <input type="text" class="form-control" name="txtid"id="txtid"placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted"></small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">First Name</label>
    <input type="text" class="form-control" name="txtfname"id="txtfname" placeholder="First Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Middle Name</label>
    <input type="text" class="form-control" name="txtmname"id="txtmname" placeholder="Middle Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Last Name</label>
    <input type="text" class="form-control" name="txtlname"id="txtlname" placeholder="Last Name">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Email</label>
    <input type="text" class="form-control" name="txtemail"id="txtemail" placeholder="Email">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Contact</label>
    <input type="text" class="form-control" name="txtcontact"id="txtcontact" placeholder="Contact">
  </div>
  <div class="update-flex">
  <button type="submit" class="btn btn-primary"id="btn_update"name="btn_update">Submit</button>
  <span class="btn btn-secondary"id="hide_update_panel">Cancel</span>
</div>
</form>

</div>
<!--
end
-->

<!DOCTYPE html>
<html lang="en">
	
<?php session_start(); 


?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Gym System | User</title>
 	

<?php
  if(!isset($_SESSION['login_id']))
    header('location:login.php');
 include('./header.php'); 
 // include('./auth.php'); 
 ?>

</head>
<style>
	
  body::-webkit-scrollbar{
    display:none;
  }
  .modal-dialog.large {
    width: 80% !important;
    max-width: unset;
  }
  .modal-dialog.mid-large {
    width: 50% !important;
    max-width: unset;
  }
  #viewer_modal .btn-close {
    position: absolute;
    z-index: 999999;
    /*right: -4.5em;*/
    background: unset;
    color: white;
    border: unset;
    font-size: 27px;
    top: 0;
}
#viewer_modal .modal-dialog {
        width: 80%;
    max-width: unset;
    height: calc(90%);
    max-height: unset;
}
  #viewer_modal .modal-content {
       background: black;
    border: unset;
    height: calc(100%);
    display: flex;
    align-items: center;
    justify-content: center;
  }
  #viewer_modal img,#viewer_modal video{
    max-height: calc(100%);
    max-width: calc(100%);
  }

</style>

<body>
	<?php include 'topbar.php' ?>
	<?php include 'navbar.php' ?>
  <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-body text-white">
    </div>
  </div>
  <main id="view-panel" >
      <?php $page = isset($_GET['page']) ? $_GET['page'] :'home'; ?>
  	<?php include $page.'.php' ?>
  	

  </main>

  <div id="preloader"></div>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>


  <div class="modal fade" id="uni_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title"></h5>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Save</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal"id="upper-cancel">Cancel</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="confirm_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Confirmation</h5>
      </div>
      <div class="modal-body">
        <div id="delete_content"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="viewer_modal" role='dialog'>
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
              <button type="button" class="btn-close" data-dismiss="modal"><span class="fa fa-times"></span></button>
              <img src="" alt="">
      </div>
    </div>
  </div>
</body>
<script src="assets/js/jquery-te-1.4.0.min.js"></script>
<script src="assets/js/new.js?v=<?php echo time();?>"></script>
<script>
	 window.start_load = function(){
    $('body').prepend('<di id="preloader2"></di>')
  }
  window.end_load = function(){
    $('#preloader2').fadeOut('fast', function() {
        $(this).remove();
      })
  }
 window.viewer_modal = function($src = ''){
     
    var t = $src.split('.')
    t = t[1]
    if(t =='mp4'){
      var view = $("<video src='"+$src+"' controls autoplay></video>")
    }else{
      var view = $("<img src='"+$src+"' />")
    }
    $('#viewer_modal .modal-content video,#viewer_modal .modal-content img').remove()
    $('#viewer_modal .modal-content').append(view)
    $('#viewer_modal').modal({
            show:true,
            backdrop:'static',
            keyboard:false,
            focus:true
          })
          end_load()  

}
  window.uni_modal = function($title = '' , $url='',$size=""){
     
    $.ajax({
        url:$url,
        error:err=>{
            console.log()
            alert("An error occured")
        },
        success:function(resp){
            if(resp){
                $('#uni_modal .modal-title').html($title)
                $('#uni_modal .modal-body').html(resp)
                if($size != ''){
                    $('#uni_modal .modal-dialog').addClass($size)
                }else{
                    $('#uni_modal .modal-dialog').removeAttr("class").addClass("modal-dialog modal-md")
                }
                $('#uni_modal').modal({
                  show:true,
                  backdrop:'static',
                  keyboard:false,
                  focus:true
                })
                end_load()
            }
        }
    })
}
window._conf = function($msg='',$func='',$params = []){
     $('#confirm_modal #confirm').attr('onclick',$func+"("+$params.join(',')+")")
     $('#confirm_modal .modal-body').html($msg)
     $('#confirm_modal').modal('show')
  }
   window.alert_toast= function($msg = 'TEST',$bg = 'success'){
      $('#alert_toast').removeClass('bg-success')
      $('#alert_toast').removeClass('bg-danger')
      $('#alert_toast').removeClass('bg-info')
      $('#alert_toast').removeClass('bg-warning')

    if($bg == 'success')
      $('#alert_toast').addClass('bg-success')
    if($bg == 'danger')
      $('#alert_toast').addClass('bg-danger')
    if($bg == 'info')
      $('#alert_toast').addClass('bg-info')
    if($bg == 'warning')
      $('#alert_toast').addClass('bg-warning')
    $('#alert_toast .toast-body').html($msg)
    $('#alert_toast').toast({delay:3000}).toast('show');
  }
  $(document).ready(function(){
    $('#preloader').fadeOut('fast', function() {
        $(this).remove();
      })
  })
  $('.datetimepicker').datetimepicker({
      format:'Y/m/d H:i',
      startDate: '+3d'
  })
  $('.select2').select2({
    placeholder:"Please select here",
    width: "100%"
  })
</script>	
</html>