<?php
namespace BitrixAdminExtension\Page\Highload
{
    use BitrixAdminExtension\Page\BaseEdit;

    /**
     * Страница редактирования элемента Highload-блока.
     */
    class Edit extends BaseEdit
    {
        use Base;

        /**
         * Получает адрес страницы.
         * @return string Адрес страницы.
         */
        protected static function getPath()
        {
            return Helper::EDIT;
        }
    }
}