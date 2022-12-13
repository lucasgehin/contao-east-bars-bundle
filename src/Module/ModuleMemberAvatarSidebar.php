<?php

namespace LucasGehin\ContaoEastBarsBundle\Module;

use Contao\FilesModel;
use Contao\FrontendUser;
use Contao\Module;
use Contao\System;

class ModuleMemberAvatarSidebar extends Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_eb_member_avatar_sidebar';

    public function generate()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### Module avatar membre sidebar ###';
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
        $this->import(FrontendUser::class, 'User');
        $this->Template->lastname = $this->User->lastname;
        $this->Template->firstname = $this->User->firstname;
        $this->Template->avatar = $this->User->picture_primary ? FilesModel::findByPk($this->User->picture_primary)->path : $defaultAvatar;
    }
}