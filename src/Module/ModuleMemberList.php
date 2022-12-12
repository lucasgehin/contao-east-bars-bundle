<?php

namespace LucasGehin\ContaoEastBarsBundle\Module;

use Contao\FilesModel;
use Contao\MemberModel;
use Contao\Module;
use Contao\System;

class ModuleMemberList extends Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_eb_member_list';

    public function generate()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### Liste des membres ###';
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
        $defaultAvatar = FilesModel::findByPk($this->singleSRC)->path;
        $members = [];
        $objMembers = MemberModel::findBy('consentement', true);

        foreach ($objMembers as $member) {
            $members[] = [
                'id' => $member->id,
                'date' => $member->dateAdded,
                'firstname' => $member->firstname,
                'lastname' => $member->lastname,
                'instagram' => $member->instagram,
                'description' => $member->description,
                'avatar' => $member->picture_primary ? FilesModel::findByPk($member->picture_primary)->path : $defaultAvatar,
                'descriptionPicture' => $member->picture_secondary ? FilesModel::findByPk($member->picture_secondary)->path : null,
                'role' => $member->role_association
            ];
        }

        $this->Template->members = $members;
    }
}