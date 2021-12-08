<?php

use Brainson\Formfactory\Form\Elements\Button;
use Brainson\Formfactory\Form\Elements\Childs\Option;
use Brainson\Formfactory\Form\Elements\Input;
use Brainson\Formfactory\Form\Elements\SpamProtection;
use Brainson\Formfactory\Form\Elements\Textarea;
use Brainson\Formfactory\Form\Elements\Raw;
use Brainson\Formfactory\Form\Elements\Radio;
use Brainson\Formfactory\Form\Elements\Checkbox;
use Brainson\Formfactory\Form\Form;

$input_classes = ['form-input', 'w-full', 'max-w-md', 'mt-1', 'mb-4'];
$textarea_classes = ['form-textarea', 'w-full', 'h-32', 'max-w-md', 'mt-1', 'mb-4'];
$radio_classes = ['form-radio mr-1 mt-1 mb-2'];
$checkbox_classes = ['form-checkbox mr-2 mt-1 mb-4'];

$form = new Form(get_permalink());
$form->addMiddleware(new \Brainson\Formfactory\Form\Middleware\Validator($_POST));

$form->addFormOption('retentionTime', 30);

$radio = new \Brainson\Formfactory\Form\Elements\Radio('typ');
$radio->addOption('<span class="mr-2">Keine Angabe</span>', '-', ['checked' => 'checked', 'class' => $radio_classes]);
$radio->addOption('<span class="mr-2">Frau</span>', 'frau', ['checked' => 'checked', 'class' => $radio_classes]);
$radio->addOption('<span>Herr</span>', 'herr', ['checked' => 'checked', 'class' => $radio_classes]);
$form->addElement($radio)->addAttribute('required')
    ->setLabel('Anrede');



$form->addElement(new Input('vorname'))
    ->addAttribute('class', $input_classes)
    ->addAttribute('type', 'text')
    ->addAttribute('required')
    ->setLabel(__('Vorname', 'brainson_theme'));

$form->addElement(new Input('nachname'))
    ->addAttribute('class', $input_classes)
    ->addAttribute('type', 'text')
    ->addAttribute('required')
    ->setLabel(__('Nachname', 'brainson_theme'));

$form->addElement(new Input('email'))
    ->addAttribute('class', $input_classes)
    ->addAttribute('type', 'email')
    ->addAttribute('required')
    ->setLabel(__('E-Mail', 'brainson_theme'));


$form->addElement(new Textarea('anliegen'))
    ->addAttribute('class', $textarea_classes)
    ->addAttribute('required')
    ->setLabel(__('Ihre Nachricht an uns', 'brainson_theme'));

/* FORM FIELD 'Datenschutz Bestätigung' */
$checkboxes = new \Brainson\Formfactory\Form\Elements\Checkbox('dse');
$checkboxes->addOption(sprintf(__('<span class="max-w-md text-base text-gray-700">Ich bin damit einverstanden, dass meine Daten gemäß der <a class="link" href="%s">Datenschutzerklärung</a> gespeichert und verarbeitet werden.</span>', 'brainson_theme'), get_permalink(get_option('wp_page_for_privacy_policy'))), 'dse-bestaetigt', ['required', 'class' => 'form-checkbox mr-2 mt-1 mb-4']);

$form->addElement($checkboxes)
    ->addAttribute('required')
    ->setLabel(__('Datenschutz', 'brainson_theme'));


$submitButton = new Button('submit', __('Senden', 'brainson_theme'));
$submitButton->addAttribute('class', 'c-button');


/* FORM FIELD 'Submit' */
$form->addActionButton($submitButton);
