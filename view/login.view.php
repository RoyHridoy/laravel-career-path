<?php
use app\core\Application;
use app\core\Form\Form;

$successMessage = Application::$app->session->flash( 'success' );
if ( $successMessage ) {
    echo sprintf(
        '<div class="p-4 mt-2 mb-5 text-sm text-teal-800 bg-teal-100 border border-teal-200 rounded-lg" role="alert">
        <span class="font-bold">%s</span>
    </div>', $successMessage );
}
$errorMessage = Application::$app->session->flash( 'error' );
if ( $errorMessage ) {
    echo sprintf(
        '<div class="p-4 mt-2 mb-5 text-sm text-red-800 bg-red-100 border border-red-200 rounded-lg" role="alert">
        <span class="font-bold">%s</span>
    </div>', $errorMessage );
}
?>
<?php $form = Form::start()?>
    <?php echo $form->field( $model, "email" )->type( "email" )->label( "Email Address" ); ?>
    <?php echo $form->field( $model, "password" )->type( "password" )->label( "Password" ); ?>
    <div>
        <button type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sign in</button>
    </div>
<?php echo Form::end(); ?>

<p class="mt-10 text-sm text-center text-gray-500">
    Not a member?
    <a href="/register" class="font-semibold leading-6 text-indigo-600 hover:text-indigo-500">Register now!</a>
</p>