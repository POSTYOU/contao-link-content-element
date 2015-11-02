<?php
/**
 * Content Element Link
 * Extension for Contao Open Source CMS (contao.org)
 *
 * Copyright (c) 2015 POSTYOU
 *
 * @package link-content-element
 * @author  Gerald Meier
 * @link    http://www.postyou.de
 * @license http://www.gnu.org/licenses/lgpl-3.0.html LGPL
 */
foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key=>$palette){ 
    if(!is_array($palette) && is_string($palette)) {
        //if(preg_match('/boxLink/',$GLOBALS['TL_DCA']['tl_content']['palettes'][$key])==0)
            $GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = preg_replace('/;/', ';{boxLink_legend:hide},addLinkContentElement;', $GLOBALS['TL_DCA']['tl_content']['palettes'][$key],1);
    }
}

$GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'addLinkContentElement';

// add Subpalettes
$GLOBALS['TL_DCA']['tl_content']['subpalettes']['addLinkContentElement'] = 'elementHref_cursor,elementHref_target,elementHrefTitle,elementHrefLink';


// Add fields
$GLOBALS['TL_DCA']['tl_content']['fields']['addLinkContentElement'] = array
(

	//'reference' => &$GLOBALS['TL_LANG']['tl_content'],
    'label'				=> &$GLOBALS['TL_LANG']['tl_content']['addLinkContentElement'],
    //'exclude'			=> true,
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
    'eval'                    => array('rgxp'=>'url','filesOnly'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'fieldType'=>'radio', 'tl_class'=>'clr wizard'),
    'wizard' => array
    (
        array('tl_content', 'pagePicker')
    ),
    'sql'                     => "varchar(255) NOT NULL default ''"
);
