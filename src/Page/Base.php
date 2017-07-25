<?php
namespace BitrixAdminExtension\Page
{
    use BitrixAdminExtension\Traits\Asset;
    use Bitrix\Main\EventManager;

    /**
     * Базовый класс страницы в административном разделе.
     */
    abstract class Base
    {
        use Asset;

        /**
         * Адрес расширяемой страницы.
         * @var string
         */
        protected $path = '';

        /**
         * Дополнительные параметры расширяемой страницы.
         * @var array
         */
        protected $params = [];

        /**
         * Создает экземпляр класса.
         * @param string $path   Адрес расширяемой страницы.
         * @param array  $params Дополнительные параметры расширяемой страницы.
         */
        public function __construct($path, $params = [])
        {
            $this->path = $path;
            $this->params = $params;

            $this->bind('OnAdminContextMenuShow', 'onButtons');
            $this->bind('OnProlog', 'onPage');
        }



        /**
         * Список новых кнопок.
         * @internal
         * @var array
         */
        protected $buttons = [];

        /**
         * Добавляет на страницу новую кнопку.
         * @param \BitrixAdminPanel\Control\Button $button Кнопка.
         */
        public function addButton($button)
        {
            $this->buttons[] = $button;
        }

        /**
         * Позволяет редактировать существующий список кнопок. Виртуальный метод.
         * @param  array &$items Массив информации о кнопках.
         * @return void
         *
         * @link https://dev.1c-bitrix.ru/api_help/main/general/admin.section/classes/cadmincontextmenu/cadmincontextmenu.php
         * Описание элемента входного массива.
         */
        protected function editButtons(&$items) {}



        /**
         * Выполняется при построении списка кнопок.
         * @internal
         * @param  array &$items Массив информации о кнопках.
         * @return void
         */
        public function onButtons(&$items)
        {
            foreach ($this->buttons as $button)
            {
                $item = $button->getData();
                $items[] = $item;
            }

            $this->editButtons($items);
        }

        /**
         * Обрабатывает начало работы страницы.
         * @return void
         */
        public function onPage()
        {
            $this->registerAssets();
            $this->registerControlsAssets($this->buttons);
        }



        /**
         * Показывает, соответствует ли текущий запрос условиям страницы.
         * @internal
         * @return boolean True, если соответствует, иначе false.
         */
        protected function isCurrent()
        {
            if ($this->path)
            {
                $app = $GLOBALS['APPLICATION'];

                $path = $app->GetCurPage(true);
                if ($this->path !== $path) return false;
            }

            foreach ($this->params as $name => $value)
            {
                $isUndefined = !isset($_REQUEST[$name]);
                if ($isUndefined) return false;

                if ($value === true) continue;

                $param = $_REQUEST[$name];
                if ($value != $param) return false;
            }

            return true;
        }

        /**
         * Добавляет обработчик системного события. Обработчик добавляется только тогда,
         * когда запрос соответствует параметрам $path и $params.
         * @param  string $event   Имя события.
         * @param  string $handler Имя метода обработчика из этого класса.
         * @return void
         */
        protected function bind($event, $handler)
        {
            if (!$this->isCurrent()) return;

            $cb = [$this, $handler];

            $events = EventManager::getInstance();
            $events->addEventHandler('main', $event, $cb);
        }

        /**
         * Регистрирует ресурсы элементов управления страницы.
         * @param  array<\BitrixAdminExtension\Control\Base> $controls Массив элементов управления.
         * @return void
         */
        protected function registerControlsAssets($controls)
        {
            foreach ($controls as $control)
            {
                $control->registerAssets();
            }
        }
    }
}