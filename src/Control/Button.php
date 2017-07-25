<?php
namespace BitrixAdminExtension\Control
{
    /**
     * Базовый класс кнопки действия в административной панели.
     */
    class Button extends Base
    {
        /**
         * Ссылка кнопки.
         * @var string
         */
        public $link = '';

        /**
         * Визуальный тип кнопки.
         * @var string
         */
        public $type = '';

        /**
         * Подсказка при наведении.
         * @var string
         */
        public $tooltip = '';

        /**
         * Набор дополнительных HTML-атрибутов кнопки.
         * @var array
         */
        public $attrs = [];


        /**
         * Создает экземпляр класса.
         * @param string $text Текст кнопки.
         * @param string $link Ссылка кнопки.
         * @param string $type Иконка кнопки.
         */
        public function __construct($text, $link = '#', $type = '')
        {
            parent::__construct($text);
            
            $this->link = $link;
            $this->type = $type;
        }

        /**
         * Получает параметры кнопки для Битрикс.
         * @return array Ассоциативный массив.
         */
        public function getData()
        {
            $data = parent::getData();

            $data['TEXT'] = $this->text;
            $data['LINK'] = $this->link;
            $data['ICON'] = $this->type;

            if ($this->tooltip)
            {
                $data['TITLE'] = $this->tooltip;
            }

            if ($this->attrs)
            {
                $attrs = '';

                foreach ($this->attrs as $name => $value)
                {
                    $value = htmlspecialchars($value);
                    $name = htmlspecialchars($name);

                    $item = $name.'="'.$value.'"';
                    $attrs .= ' '.$item;
                }

                $data['LINK_PARAM'] = $attrs;
            }

            return $data;
        }
    }
}