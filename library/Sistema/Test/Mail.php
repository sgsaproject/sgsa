<?php

/**
 * Description of Mail
 *
 * @author thiago
 */
class Sistema_Test_Mail {

    public static function getEmails() {
        $directory = realpath(APPLICATION_PATH . "/../data/cache/sentmail");
        //remove the pesky .. and .
        $files = array_diff(scandir($directory), array('..', '.'));
        sort($files);  //IMPORTANT - We need them in order!
        $emails = array();
        foreach ($files as $file) {
            if ($file !== 'gitkeep') {
                $email_str = realpath(APPLICATION_PATH . "/../data/cache/sentmail/" . $file);
                $emails[] = new Zend_Mail_Message_File(array('file' => $email_str));
            }
        }
        return $emails;
    }

    public static function clearMailFiles() {
        //delete all files in folder
        $directory = realpath(APPLICATION_PATH . "/../data/cache/sentmail");
        $files1 = array_diff(scandir($directory), array('..', '.'));
        foreach ($files1 as $val) {
            if ($val !== 'gitkeep') {
                unlink(realpath($directory . "/" . $val));
            }
        }
    }

}
