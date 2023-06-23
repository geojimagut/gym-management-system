$(document).ready(function(){ 
    $('.edit_member_new').on('click', function(){
        var id=$(this).closest('tr').find('td:eq(1)').text().trim()
        var fname=$(this).closest('tr').find('td:eq(5)').text().trim()
        var mname=$(this).closest('tr').find('td:eq(6)').text().trim()
        var lname=$(this).closest('tr').find('td:eq(7)').text().trim()
        var email=$(this).closest('tr').find('td:eq(3)').text().trim()
        var contact=$(this).closest('tr').find('td:eq(4)').text().trim()

        document.getElementById('txthidden').value=id
        document.getElementById('txtid').value=id
        document.getElementById('txtfname').value=lname
        document.getElementById('txtmname').value=fname
        document.getElementById('txtlname').value=mname
        document.getElementById('txtemail').value=email
        document.getElementById('txtcontact').value=contact
        //showing update panel
        var back=document.getElementById('blurr-back')
        var front=document.getElementById('update-panel')
        back.style.display='block'
        front.style.display='block'
  })
  $('#hide_update_panel').on('click', function(){
    var back=document.getElementById('blurr-back')
    var front=document.getElementById('update-panel')
    back.style.display='none'
    front.style.display='none'
  })
  //updating members
  $('#frmUpdate').on('submit',function(e){
      e.preventDefault()
      var data=$('#frmUpdate').serialize() + '&btn_update=btn_update'
      if($('#txtid').val()==""){
        document.getElementById('msg_result').style.color='red'
        $('#msg_result').html('ID is required')
        setTimeout(function(){
          $('#msg_result').html('')
        }, 2000)
      }else if($('#txtfname').val()==""){
        document.getElementById('msg_result').style.color='red'
        $('#msg_result').html('Fill the First Name Field')
        setTimeout(function(){
          $('#msg_result').html('')
        }, 2000)
      }else if($('#txtlname').val()==""){
        document.getElementById('msg_result').style.color='red'
        $('#msg_result').html('Fill the Last Name Field')
        setTimeout(function(){
          $('#msg_result').html('')
        }, 2000)
      }else if($('#txtemail').val()==""){
        document.getElementById('msg_result').style.color='red'
        $('#msg_result').html('Fill the Email Field')
        setTimeout(function(){
          $('#msg_result').html('')
        }, 2000)
      }else if($('#txtcontact').val()==""){
        document.getElementById('msg_result').style.color='red'
        $('#msg_result').html('Fill the Contact Field')
        setTimeout(function(){
          $('#msg_result').html('')
        }, 2000)
      }else{
        $.ajax({
          url:'save_member.php',
          method:'POST',
          data:data,
          success:function(data){
            document.getElementById('msg_result').style.color='blue'
        $('#msg_result').html(data)
        setTimeout(function(){
          $('#msg_result').html('')
        }, 2000)
          }

        })

        }
      })
  })
