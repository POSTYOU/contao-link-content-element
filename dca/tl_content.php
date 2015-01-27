<?php

foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key=>$palette){ 
    if(!is_array($palette) && is_string($palette)) {
            $GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = preg_replace('/;/', ';{boxLink_legend:hide},addLinkContentElement;', $GLOBALS['TL_DCA']['tl_content']['palettes'][$key],1);
    }
}

// add Selector
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'addLinkContentElement';
$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'hrefType';

// add Subpalettes
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['addLinkContentElement'] = 'elementHref_cursor,elementHref_target,hrefType';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['hrefType_elementHrefLink'] = 'elementHrefTitle,elementHrefLink';
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['hrefType_elementHrefFile'] = 'elementHrefTitle,elementHrefFile';


// Add fields
$GLOBALS['TL_DCA']['tl_content']['fields']['addLinkContentElement'] = array
(
    'label'				=> &$GLOBALS['TL_LANG']['tl_content']['addLinkContentElement'],
    'exclude'			=> true,
    'inputType'			=> 'checkbox',
    'eval'				=> array('submitOnChange'=>true, 'tl_class' => 'clr'),
    'sql'				=> "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['elementHref_cursor'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['elementHref_cursor'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'clr w50'),
    'sql'                     => "char(1) NOT NULL default '1'"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['elementHref_target'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['MSC']['target'],
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => array('tl_class'=>'w50'),
    'sql'                     => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['hrefType'] = array
(
'label' => &$GLOBALS['TL_LANG']['tl_content']['hrefType'],
'default' => 'elementHrefFile',
'inputType' => 'radio',
'options_callback' => array('LinkContent_tl_content', 'getSubPalettesOptions'),
'reference' => &$GLOBALS['TL_LANG']['tl_content'],
'eval' => array('submitOnChange'=>true,'mandatory'=>true,'tl_class'=>'clr'),
'sql' => "varchar(256) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['elementHrefTitle'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['elementHrefTitle'],
    'inputType'               => 'text',
    'eval'                    => array('maxlength'=>255, 'tl_class'=>'clr'),
    'sql'                     => "varchar(255) NOT NULL default ''"
);


$GLOBALS['TL_DCA']['tl_content']['fields']['elementHrefLink'] = array
(
    'label'                   => &$GLOBALS['TL_LANG']['tl_content']['elementHrefLink'],
    'inputType'               => 'text',
    'eval'                    => array('rgxp'=>'url', 'decodeEntities'=>true,'mandatory'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'tl_class'=>'clr wizard'),
    'wizard' => array
    (
        array('tl_content', 'pagePicker')
    ),
    'sql'                     => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_content']['fields']['elementHrefFile'] = array
(
    'label'				=> &$GLOBALS['TL_LANG']['tl_content']['elementHrefFile'],
    'exclude'	=> true,
    'inputType'	=> 'fileTree',
    'eval'	=> array('filesOnly'=>true, 'fieldType'=>'radio','mandatory'=>true, 'tl_class'=>'clr'),
    'sql'	=> "binary(16) NULL"
);


class LinkContent_tl_content{

    function getSubPalettesOptions(){
        return array('elementHrefLink', 'elementHrefFile');
    }



}


