<h1>Register</h1>

<?php $form = \app\core\form\Form::begin('', "post") ?>
  <?php echo $form->field($model, 'name', "Name") ?>
  <?php echo $form->field($model, 'email', "Email") ?>
  <?php echo $form->field($model, 'password', "Password")->passwordField() ?>
  <?php echo $form->field($model, 'passwordRepeat', "Repeat Password")->passwordField() ?>
  <button type="submit" class="btn btn-primary">Submit</button>
<?php echo \app\core\form\Form::end() ?>