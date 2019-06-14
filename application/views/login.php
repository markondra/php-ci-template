<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Aplikasi Billing | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo base_url();?>assets/plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo base_url();?>"><b>Apps</b> Billing</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Silahkan Log In untuk masuk ke Aplikasi</p>
    <div class="alert alert-danger alert-dismissible" style="display: none;">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <i class="icon fa fa-warning"></i> Pesan!
        <span></span>
    </div>
    <form action="#" method="post">
      <div class="form-group has-feedback">
        <input type="text" id="user" class="form-control" placeholder="Username">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="pass" class="form-control" placeholder="Password">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="<?php echo base_url();?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url();?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script>
  $(function () {
    $('form').submit(function(e){
      e.preventDefault();
      var user = $('#user').val();
      var pass = $('#pass').val();
      if(user === ''){
        $('.alert span').html('Username masih belum diisi!');
        $('.alert').fadeIn(900);
        $('.alert').fadeOut(1500);
        $('#user').focus();
        return false;
      }
      if(pass === ''){
        $('.alert span').html('Password masih belum diisi!');
        $('.alert').fadeIn(900);
        $('.alert').fadeOut(1500);
        $('#pass').focus();
        return false;
      }
      $.ajax({
        url : '<?php echo base_url();?>login/login',
        type : 'POST',
        dataType : 'json',
        data : {
          user : user,
          pass : pass
        },
        beforeSend : function(){
          $('form button').prop('disabled', true);
        },
        success : function(response){
          console.log(response);
          $('form button').prop('disabled', false);
          if(response.result == 0){
            $('.alert span').html(response.alert);
            $('.alert').fadeIn(900);
            $('.alert').fadeOut(1500);
          }
          else{
            window.location = '<?php echo base_url();?>';
          }
        }
      });
    });
  });
</script>
</body>
</html>
