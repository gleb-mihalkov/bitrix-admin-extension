<?php
namespace BitrixAdminExtension\Page\Highload
{
    /**
     * Базовый типаж страницы Highload-блоков.
     */
    trait Base
    {
        /**
         * Название highload-блока.
         * @var string
         */
        public $name;

        /**
         * Создает экземпляр класса.
         * @param string $name Название highload-блока.
         */
        public function __construct($name = null)
        {
            $params = Helper::getParams($name);
            $path = self::getPath();

            parent::__construct($path, $params);
            $this->name = $name;
        }

        /**
         * Получает адрес страницы. Требует переопределения.
         * @return string Адрес страницы.
         */
        protected static function getPath() {}
    }
}