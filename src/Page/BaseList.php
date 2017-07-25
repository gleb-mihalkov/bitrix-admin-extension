<?php
namespace BitrixAdminExtension\Page
{
    /**
     * Базовый класс страницы списка элементов.
     */
    abstract class BaseList extends Base
    {
        /**
         * Создает экземпляр класса.
         * @param string $path   Адрес расширяемой страницы.
         * @param array  $params Дополнительные параметры расширяемой страницы.
         */
        public function __construct($path, $params = [])
        {
            parent::__construct($path, $params);

            $this->bind('OnAdminListDisplay', 'onList');
        }



        /**
         * Позволяет редактировать список элементов. Виртуальный метод.
         * @param  \CAdminList &$list Сущность списка элементов.
         * @return void
         *
         * @link https://dev.1c-bitrix.ru/api_help/main/general/admin.section/classes/cadminlist/index.php
         * Документация по спискам Битрикс.
         */
        protected function editList(&$list) {}



        /**
         * Обработчик события построения списка элементов.
         * @internal
         * @param  \CAdminList &$list Сущность списка элементов.
         * @return void
         */
        public function onList(&$list)
        {
            $this->editList($list);
        }
    }
}