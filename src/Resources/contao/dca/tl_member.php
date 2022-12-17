<?php

$GLOBALS['TL_DCA']['tl_member']['fields']['consentement'] = [
    'exclude' => true,
    'toggle' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => ['feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'],
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_member']['fields']['instagram'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => ['maxlength'=>255, 'feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'],
    'sql' => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_member']['fields']['description'] = [
    'exclude' => true,
    'inputType' => 'textarea',
    'eval' => ['feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'maxlength'=>2048, 'tl_class'=>'clr'],
    'sql' => "text NULL"
];

$GLOBALS['TL_DCA']['tl_member']['fields']['picture_primary'] = [
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr', 'feEditable'=>true, 'isGallery'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'uploadFolder' => 'files/', 'extensions'=>implode(',', System::getContainer()->getParameter('contao.image.valid_extensions'))],
    'sql' => "binary(16) NULL"
];

$GLOBALS['TL_DCA']['tl_member']['fields']['picture_secondary'] = [
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['filesOnly'=>true, 'fieldType'=>'radio', 'tl_class'=>'clr', 'feEditable'=>true, 'isGallery'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'uploadFolder' => 'files/', 'extensions'=>implode(',', System::getContainer()->getParameter('contao.image.valid_extensions'))],
    'sql' => "binary(16) NULL"
];

$GLOBALS['TL_DCA']['tl_member']['fields']['role_association'] = [
    'exclude' => true,
    'search' => true,
    'inputType' => 'text',
    'eval' => ['maxlength'=>255, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'],
    'sql' => "varchar(255) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_member']['fields']['cotisation'] = [
    'exclude' => true,
    'toggle' => true,
    'filter' => true,
    'inputType' => 'checkbox',
    'eval' => ['feEditable'=>true, 'feViewable'=>true, 'feGroup'=>'contact', 'tl_class'=>'w50'],
    'sql' => "char(1) NOT NULL default ''"
];

$GLOBALS['TL_DCA']['tl_member']['palettes']['default'] = str_replace(';{groups_legend}', ';{eastbars_legend},picture_primary,picture_secondary,instagram,description,role_association,consentement,cotisation;{groups_legend}', $GLOBALS['TL_DCA']['tl_member']['palettes']['default']);