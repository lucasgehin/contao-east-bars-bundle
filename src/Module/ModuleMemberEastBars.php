<?php

namespace LucasGehin\ContaoEastBarsBundle\Module;

use Contao\Config;
use Contao\FrontendUser;
use Contao\Input;
use Contao\Module;
use Contao\System;
use Contao\File;
use Contao\CoreBundle\Exception\PageNotFoundException;

class ModuleMemberEastBars extends Module
{
    /**
     * Template
     * @var string
     */
    protected $strTemplate = 'mod_eb_member';

    public function generate()
    {
        $request = System::getContainer()->get('request_stack')->getCurrentRequest();

        if ($request && System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest($request))
        {
            $objTemplate = new \BackendTemplate('be_wildcard');
            $objTemplate->wildcard = '### ModuleMemberEastBars ###';
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
        $this->import(FrontendUser::class, 'User');
        $this->Template->logged = FE_USER_LOGGED_IN;
        if (FE_USER_LOGGED_IN) {
            $this->Template->lastname = $this->User->lastname;
            $this->Template->firstname = $this->User->firstname;
        }
    }
}