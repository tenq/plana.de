<?php

global $wpdb;

use Brainson\Formfactory\Form\Middleware\CSRF;
use Brainson\Formfactory\Form\Middleware\Mailer;
use Brainson\Formfactory\Form\Middleware\Saver;
use Brainson\Formfactory\Form\Storage\Wordpress;

$storage = new Wordpress();
$storage->title = date_i18n('Y-m-d H:i') . ' - ' . $form->getFormOption('FormName');

$form->addMiddleware(new Saver($storage));



// E-Mail to Company
$mailer = new Mailer();
do_action('phpmailer_init', $mailer);

$mailer->viewTemplate = 'form/mail-company';

$mailer->callback = function (Mailer $mailer) use ($form, $wpdb) {

    //Get ID from record
    $record_id = $wpdb->insert_id;

    $mailer->addAddress('company@mail.com');

    $mailer->Subject = 'Neuer Formulareintrag "' . $form->getFormOption('FormName') . '"';



    return $mailer;
};

$form->addMiddleware($mailer);



// E-Mail to Customer
$mailer = new Mailer();
do_action('phpmailer_init', $mailer);

$mailer->Subject = __('Vielen Dank für Ihre Nachricht', 'brainson_theme');
$mailer->viewTemplate = 'form/mail-user';

$mailer->callback = function (Mailer $mailer) use ($form, $wpdb) {

    //Get ID from record
    $record_id = $wpdb->insert_id;

    $mailer->addAddress($mailer->data['email']);

    return $mailer;
};

$form->addMiddleware($mailer);
