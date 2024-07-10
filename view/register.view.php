<?php use app\core\Form\Form;?>
<?php $form = Form::start()?>
    <?php echo $form->field( $model, "name" )->type( "text" )->label( "Name" ); ?>
    <?php echo $form->field( $model, "email" )->type( "email" )->label( "Email Address" ); ?>
    <?php echo $form->field( $model, "password" )->type( "password" )->label( "Password" ); ?>
    <?php echo $form->field( $model, "confirmPassword" )->type( "password" )->label( "Confirm Password" ); ?>
    <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Register</button>
    </div>
<?php echo Form::end(); ?>

<p class="mt-10 text-center text-sm text-gray-500">
    Already have an account?
    <a href="./login" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Login!</a>
</p>
