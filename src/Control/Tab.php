<?php
namespace BitrixAdminExtension\Control
{
    use BitrixAdminExtension\Control\Traits\Template;

    /**
     * Базовый класс вкладки.
     */
    class Tab extends Base
    {
        use Template;

        /**
         * Уникальный ID вкладки.
         * @var string
         */
        public $id = '';

        /**
         * Подсказка для вкладки.
         * @var string
         */
        public $title = '';

        /**
         * Создает экземпляр класса.
         * @param string $text     Текст на вкладке.
         * @param string $title    Полное название вкладки.
         * @param string $template Имя PHP шаблона, генерирующего содержимое вкладки.
         */
        public function __construct($text, $title, $template = null)
        {
            parent::__construct($text);

            $this->title = $title;
            $this->template = $template;
            
            $id = uniqid('tab_', true);
            $id = str_replace('.', '', $id);
            $this->id = $id;
        }

        /**
         * Получает сведения о вкладке в виде массива для Битрикс.
         * @return array Ассоциативный массив.
         */
        public function getData()
        {
            $data = [
                'DIV' => $this->id,
                'TAB' => $this->text,
                'TITLE' => $this->title
            ];

            $content = $this->render();
            $content = $content ? $content : '<div></div>';
            $data['CONTENT'] = $content;

            return $data;
        }
    }
}