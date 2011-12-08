<?php use_helper('I18N') ?>

<h1>Login Administrationsbereich</h1>
<br />
<br />
<style>
th
{
  vertical-align: bottom;
  text-align: right;
  padding-right: 15px;
}
td
{
  text-align: right;
  width:150px;
  padding-right: 15px;
}
</style>
<?php echo get_partial('sfGuardAuth/signin_form', array('form' => $form)) ?>


