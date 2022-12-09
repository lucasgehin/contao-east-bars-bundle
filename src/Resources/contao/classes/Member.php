<?php

namespace LucasGehin\ContaoEastBarsBundle;

use Contao\File;
use Contao\Frontend;
use Contao\FrontendUser;
use Contao\MemberModel;
use Contao\StringUtil;
use Contao\System;
use Contao\Dbafs;
use Contao\FilesModel;

class Member extends Frontend
{
    /**
     * @param FrontendUser $objUser
     * @param $arrData
     */
    public function updateAvatar(FrontendUser $objUser, $arrData): void
    {
        $objMember = MemberModel::findById($objUser->id);
        if ($objMember === null) {
            return;
        }

        $this->pictureAction('picture_primary', $objUser);
        $this->pictureAction('picture_secondary', $objUser);
    }

    /**
     * @param string $name
     * @param FrontendUser $objUser
     */
    protected function pictureAction(string $name, FrontendUser $objUser)
    {
        $objMember = MemberModel::findById($objUser->id);
        $picture = $_SESSION['FILES'][$name];
        if ($picture !== null) {
            $objFile = new File($picture['name']);
            $uploadDir = 'files/membres/';
            $this->import('Files');
            $picture['name'] =  $objUser->firstname . '-' . $objUser->lastname . '-' . $objUser->id . '-' . $name . '.' . $objFile->extension;
            $this->Files->move_uploaded_file($picture['tmp_name'], $uploadDir . '/' . $picture['name']);
            $this->Files->chmod($uploadDir . '/' . $picture['name'], 0666 & ~umask());

            $strUuid = null;
            $strFile = $uploadDir . '/' . $picture['name'];


            // Generate the DB entries
            if (Dbafs::shouldBeSynchronized($strFile)) {
                $objModel = FilesModel::findByPath($strFile);

                if ($objModel === null) {
                    $objModel = Dbafs::addResource($strFile);
                }

                $strUuid = StringUtil::binToUuid($objModel->uuid);

                // Update the hash of the target folder
                Dbafs::updateFolderHashes($uploadDir);

                // Update member avatar
                $objMember->$name = $objModel->uuid;
                $objMember->save();
            }

            $projectDir = System::getContainer()->getParameter('kernel.project_dir');
            $_SESSION['FILES'][$name] = [
                'name'     => $picture['name'],
                'type'     => $picture['type'],
                'tmp_name' => $projectDir . '/' . $strFile,
                'error'    => $picture['error'],
                'size'     => $picture['size'],
                'uploaded' => true,
                'uuid'     => $strUuid
            ];
        } 
    }
}