<?php
namespace BitrixAdminExtension\Control
{
    use BitrixAdminExtension\Traits\Asset;
    
    /**
     * Базовый класс элемента управления административной панели.
     */
    abstract class Base
    {
        use Asset;

        /**
         * Получает данные об элементе управления в виде ассоциативного массива
         * для вставки в методы ядра Битрикс.
         * @return array Ассоциативный массив.
         */
        abstract public function getData();
        
        /**
         * Текст элемента.
         * @var string
         */
        public $text = '';

        /**
         * Создает экземпляр класса.
         * @param string $text Текст элемента.
         */
        public function __construct($text)
        {
            $this->text = $text;
        }
    }
}