 <!DOCTYPE html>
<html>
  <head >
    <meta charset="utf-8">
    
    <title>Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" style="min-height:100%" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/bootstrap/dist/css/bootstrap.min.css')); ?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/font-awesome/css/font-awesome.min.css')); ?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo e(asset('bower_components/Ionicons/css/ionicons.min.css')); ?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo e(asset('dist/css/AdminLTE.min.css')); ?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo e(asset('plugins/iCheck/square/blue.css')); ?>">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
	<style>
	 body{
		 background: url('../dist/img/restaurant/login2.jpg') center center; 
		// background: background: rgba(0, 0, 0, 5); 
		 color:white;
		 background-repeat: no-repeat;
		 background-attachment: fixed;
		 background-size: cover;
		// color: rgba(255, 255, 255, 0.6);
		 height: 100%;
		 style="opacity: 0.5;"
	 }
	</style>
  </head>
  <body class="hold-transition" style="height:100px;">
    <div class="login-box" >
      <div class="login-logo">
        <b style="color: rgba(255, 255, 255, 0.6);" >Login</b><span >COS</span></a>
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body" style="background: rgba(255, 255, 255, 0.8);" >
        <p class="login-box-msg"  >
          Sign in to start your session
        </p>
        <form method="POST" action="<?php echo e(route('login')); ?>">
			<?php echo csrf_field(); ?>
			
          <div class="form-group has-feedback <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" >
            <input id="email"  type="email" name="email" class="form-control" placeholder="Email" value="<?php echo e(old('email')); ?>" required autocomplete="email" ><span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			
          </div>
		  
		  <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="callout callout-danger">
				<h4>Oops</h4>
				<p><?php echo e($message); ?></p>
				</div>
          <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
          <div class="form-group has-feedback <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> has-error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
            <input id="password" type="password" name="password" class="form-control" required placeholder="Password"><span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
		  <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="callout callout-danger">
				<h4>Oops</h4>
				<p><?php echo e($message); ?></p>
				</div>
		  <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?> 
          <div class="row">
            <div class="col-xs-8">
              <div class="checkbox icheck">
                <label><input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?>> Remember Me</label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
       </div>
      <!-- /.login-box-body -->
    </div>
    <!-- /.login-box -->
    <!-- jQuery 3 -->
    <script src="<?php echo e(asset('bower_components/jquery/dist/jquery.min.js')); ?>"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="<?php echo e(asset('bower_components/bootstrap/dist/js/bootstrap.min.js')); ?>"></script>
    <!-- iCheck -->
    <script src="<?php echo e(asset('plugins/iCheck/icheck.min.js')); ?>"></script>
    <script>
$(function () {
    $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
    });
});
    </script>
  </body>
</html><?php /**PATH C:\wamp64\www\COS\resources\views/auth/login.blade.php ENDPATH**/ ?>