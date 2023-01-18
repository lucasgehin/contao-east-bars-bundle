<?php
use LucasGehin\ContaoEastBarsBundle\Member;

$GLOBALS['FE_MOD']['eastBars'] = [
    'memberEastBars' => LucasGehin\ContaoEastBarsBundle\Module\ModuleMemberEastBars::class,
    'memberList' => LucasGehin\ContaoEastBarsBundle\Module\ModuleMemberList::class,
    'memberAvatarSidebar' => LucasGehin\ContaoEastBarsBundle\Module\ModuleMemberAvatarSidebar::class,
    'memberListDesk' => LucasGehin\ContaoEastBarsBundle\Module\ModuleMemberListDesk::class,
    'memberEditDesk' => LucasGehin\ContaoEastBarsBundle\Module\ModuleMemberEditDesk::class,
    'projectTeaserList' => LucasGehin\ContaoEastBarsBundle\Module\ModuleProjectTeaserList::class,
    'projectList' => LucasGehin\ContaoEastBarsBundle\Module\ModuleProjectList::class,
];

$GLOBALS['TL_HOOKS']['updatePersonalData'][] = [Member::class, 'updateAvatar'];