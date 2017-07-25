<?php
namespace BitrixAdminExtension\Page\Highload
{
    use BitrixAdminExtension\Page\BaseGrid;

    /**
     * Страница редактирования элемента Highload-блока.
     */
    class Grid extends BaseList
    {
        use Base;

        /**
         * Получает адрес страницы.
         * @return string Адрес страницы.
         */
        protected static function getPath()
        {
            return Helper::GRID;
        }
    }
}