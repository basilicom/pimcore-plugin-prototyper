<?php

use Pimcore\Model\Object;

class Prototyper_AdminController extends \Pimcore\Controller\Action\Admin
{
    /**
     * @param $label string human readable field title
     * @return string ascii 7 bit, camel-cased
     */
    private function getFieldName($label)
    {
        // works only if this locale is installed on the host!
        setlocale(LC_CTYPE, 'de_DE.utf8');

        $name = str_replace('_', ' ', iconv("UTF-8", "ASCII//TRANSLIT", strtolower($label)));
        $name = preg_replace('/  +/', ' ', $name);
        $name = ucwords($name);
        $name = str_replace(' ', '', $name);
        $name = lcfirst($name);
        return $name;
    }

    /**
     * Copied from: pimcore/modules/admin/controllers/ClassController.php
     * @param $name string
     * @return string
     */
    private function correctClassname($name) {
        $name = preg_replace('/[^a-zA-Z0-9]+/', '', $name);
        $name = preg_replace("/^[0-9]+/", "", $name);
        return $name;
    }

    /**
     * @todo refactor steps into proper methods instead of doing it all in the action
     * @throws Exception
     */
    public function indexAction()
    {
        // reachable via http://your.domain/plugin/Prototyper/admin/index

        $this->view->previewData = null;

        $this->view->csvText = $this->getParam('csv');
        $this->view->classname = $this->getParam('classname');

        $csvData = array();

        $rowNr = 0;

        $rows = str_getcsv($this->view->csvText, "\n"); //parse the rows

        foreach($rows as $row) {

            $rowNr++;

            $rowData = str_getcsv($row, ";");
            $csvData[] = $rowData;

            if ($rowNr == 1) {
                $fieldNames  = array();
                $fieldTitles  = array();
                foreach ($rowData as $cell) {
                    $fieldTitles[] = $cell;
                    $fieldNames[] = $this->getFieldName($cell);
                }
                $csvData[] = $fieldNames;
            }

            if ($rowNr > 10 ) {
                break;
            }
        }

        $this->view->previewTable = $csvData;

        $fieldList = array();

        foreach ($fieldNames as $fieldName) {

            $fieldTitle = array_shift($fieldTitles);

            ob_start();
            include __DIR__ . "/../classes/field.json.php";
            $fieldList[] = ob_get_clean();

        }
        $fields = implode(',', $fieldList);

        ob_start();
        include __DIR__ . "/../classes/object.json.php";
        $jsonText = ob_get_clean();

        if ($this->getParam('generate') != '') {

            $class = Object\ClassDefinition::getByName($this->correctClassname($this->getParam("classname")));

            if ($class == null) {

                $class = Object\ClassDefinition::create(
                    array(
                        'name' => $this->correctClassname($this->getParam("classname")),
                        'userOwner' => $this->user->getId()
                    )
                );
                $class->save();
            }

            $class = Object\ClassDefinition::getById($class->getId());
            $success = Object\ClassDefinition\Service::importClassDefinitionFromJson($class, $jsonText);

            if ($success) {
                $this->view->successMessage = '<strong>Class generation successful.</strong>';
            }
        }
    }
}
