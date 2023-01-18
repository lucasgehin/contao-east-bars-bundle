<?php

namespace LucasGehin\ContaoEastBarsBundle\Module;

use Contao\CoreBundle\Exception\PageNotFoundException;
use Contao\Input;
use Contao\Module;
use Contao\System;

class ModuleMemberEditDesk extends Module {
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_eb_member_edit_desk';

    public function generate()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request)) {
            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### BUREAU : Modifier un membre ###';
            $objTemplate->title = $this->headline;
            $objTemplate->id = $this->id;
            $objTemplate->link = $this->name;
            $objTemplate->href = 'contao/main.php?do=themes&amp;table=tl_module&amp;act=edit&amp;id=' . $this->id;

            return $objTemplate->parse();
        }

        return parent::generate();
    }

    protected function compile()
    {
        $id = Input::get('auto_item');
        System::loadLanguageFile('tl_member');

        if (!$id || !$member = \MemberModel::findByPk($id)) {
            throw new PageNotFoundException();
        }

        $strFormId = 'tl_eb_member_edit_' . $this->id;

        if (Input::post('FORM_SUBMIT') == $strFormId) {
            $fieldsToEdit = [
                'firstname',
                'lastname',
                'phone',
                'email',
            ];
            foreach ($fieldsToEdit as $fieldToEdit) {
                $postField = Input::post($fieldToEdit);
                if ($postField !== null) {
                    $member->$fieldToEdit = $postField;
                }
            }

            $checkboxesToEdit = [
                'consentement',
                'cotisation',
            ];
            foreach ($checkboxesToEdit as $checkboxToEdit) {
                $postField = Input::post($checkboxToEdit);
                if ($postField === null) {
                    $member->$checkboxToEdit = false;
                } else {
                    $member->$checkboxToEdit = true;
                }
            }

            $member->tstamp = time();
            $member->save();
            $this->Template->success = true;
        }

        $this->Template->member = $member;
        $this->Template->formId = $strFormId;
        $this->Template->requestToken = System::getContainer()->get('contao.csrf.token_manager')->getDefaultTokenValue();


    }
}