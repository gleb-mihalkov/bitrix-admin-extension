<?php
namespace BitrixAdminExtension\Traits
{
    use Bitrix\Main\Page\Asset as BitrixAsset;
    use Webmozart\PathUtil\Path;
    
    /**
     * Типаж для добавления произвольных ресурсов на страницу.
     */
    trait Asset
    {
        /**
         * Список JS-файлов, которые должны быть добавлены на страницу.
         * @internal
         * @var array
         */
        protected $js = [];

        /**
         * Список CSS-файлов, которые должны быть добавлены на страницу.
         * @internal
         * @var array
         */
        protected $css = [];

        /**
         * Список строк, которые должны быть добавлены в секцию HEAD страницы.
         * @internal
         * @var array
         */
        protected $head = [];

        /**
         * Получает путь для подключения ресурса.
         * @param  string $path Переданный путь для подключения.
         * @return string       Реальный путь для подключения.
         */
        protected function getAssetPath($path)
        {
            $isUrl = strpos($path, '//') !== false;
            if ($isUrl) return $path;

            $isAbsolute = Path::isAbsolute($path);
            if ($isAbsolute) return $path;

            $path = Path::makeRelative($path, $_SERVER['DOCUMENT_ROOT']);

            $path = '/'.$path;
            return $path;
        }

        /**
         * Добавляет на страницу JS-файл.
         * @param string $file Путь к файлу (относительно корня сайта) или внешний URL.
         */
        public function addJs($file)
        {
            $file = $this->getAssetPath($file);
            $this->js[] = $file;
        }

        /**
         * Добавляет на страницу CSS-файл.
         * @param string $file Путь к файлу (относительно корня сайта) или внешний URL.
         */
        public function addCss($file)
        {
            $file = $this->getAssetPath($file);
            $this->css[] = $file;
        }

        /**
         * Добавляет строку в раздел HEAD страницы.
         * @param string $string Строка.
         */
        public function addString($string)
        {
            $this->head[] = $string;
        }

        /**
         * Вызывает реальное добавление объявленных ресурсов на страницу.
         */
        public function registerAssets()
        {
            $asset = BitrixAsset::getInstance();

            foreach ($this->js as $js) $asset->addJs($js);
            foreach ($this->css as $css) $asset->addCss($css);
            foreach ($this->head as $head) $asset->addString($head);
        }
    }
}