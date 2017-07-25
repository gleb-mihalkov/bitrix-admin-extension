<?php
namespace BitrixAdminExtension\Control\Traits
{
    use Webmozart\PathUtil\Path;

    /**
     * Типаж элемента управления, имеющего PHP-шаблон для рендера
     * своего HTML-кода.
     */
    trait Template
    {
        /**
         * Путь к файлу шаблона (относительно корня сайта).
         * @var string
         */
        public $template = null;

        /**
         * Генерирует HTML-код из шаблона.
         * @return string HTML-код.
         */
        protected function render()
        {
            if (!$this->template) return null;

            $template = Path::makeAbsolute($this->template, $_SERVER['DOCUMENT_ROOT']);
            if (!file_exists($template)) return null;

            ob_start();
            include $template;
            $html = ob_get_contents();
            ob_end_clean();

            return $html;
        }
    }
}