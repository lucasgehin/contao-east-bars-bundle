<?php
use LucasGehin\ContaoEastBarsBundle\Member;

$GLOBALS['FE_MOD']['eastBars'] = [
    'memberEastBars' => LucasGehin\ContaoEastBarsBundle\Module\ModuleMemberEastBars::class,
    'projectTeaserList' => LucasGehin\ContaoEastBarsBundle\Module\ModuleProjectTeaserList::class,
    'projectList' => LucasGehin\ContaoEastBarsBundle\Module\ModuleProjectList::class,
];

$GLOBALS['TL_HOOKS']['updatePersonalData'][] = [Member::class, 'updateAvatar'];