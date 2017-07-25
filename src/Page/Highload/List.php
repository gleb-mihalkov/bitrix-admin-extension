<?php
namespace BitrixAdminExtension\Page\Highload
{
    use BitrixAdminExtension\Page\BaseList;

    /**
     * Страница редактирования элемента Highload-блока.
     */
    class List extends BaseList
    {
        use Base;

        /**
         * Получает адрес страницы.
         * @return string Адрес страницы.
         */
        protected static function getPath()
        {
            return Helper::LIST;
        }
    }
}