<?php
namespace BitrixAdminExtension\Page\Highload
{
    use Bitrix\Highloadblock\HighloadBlockTable;
    use Bitrix\Main\Application;
    use CModule;

    /**
     * Содержит вспомогательные методы для работы со страницами Highload-блоков.
     * @internal
     */
    class Helper
    {
        /**
         * Адрес страницы редактирования элемента.
         */
        const EDIT = '/bitrix/admin/highloadblock_row_edit.php';

        /**
         * Адрес страницы списка элементов.
         */
        const GRID = '/bitrix/admin/highloadblock_rows_list.php';



        /**
         * Коллекция ID Highload блоков, проиндексированная по из названиям.
         * @var array
         */
        protected static $ids = [];

        /**
         * Получает ID highload-блока по его названию.
         * @param  string  $name Название блока.
         * @return integer       ID.
         */
        protected static function getId($name)
        {           
            if (isset(self::$ids[$name])) return self::$ids[$name];

            CModule::IncludeModule('highloadblock');

            $table = HighloadBlockTable::getTableName();
            $db = Application::getConnection();

            $result = $db->query("SELECT * FROM `$table` WHERE `NAME` = '$name';");
            $result = $result->fetch();
            $id = $result ? $result['ID'] : false;

            self::$ids[$name] = $id;
            return $id;
        }



        /**
         * Возвращает массив параметров адреса страницы.
         * @param  string $name Название highload-блока.
         * @return array        Массив параметров.
         */
        public static function getParams($name = null)
        {
            if (empty($name)) return [];

            $isId = preg_match('/[0-9]+/', $name);
            $id = $isId ? $name : self::getId($name);

            return ['ENTITY_ID' => $id];
        }
    }
}