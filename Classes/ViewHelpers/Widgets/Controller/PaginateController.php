<?php
class Tx_MovieController_ViewHelpers_Widget_Controller_PaginateController extends Tx_Fluid_ViewHelpers_Widget_Controller_PaginateController {

    /**
     * @param Tx_Extbase_MVC_View_ViewInterface $view
     * @return void
     * @todo implement logic for overriding widget template paths (tx_extension.view.widget.<WidgetViewHelperClassName>.templateRootPath...)
     */
    protected function setViewConfiguration(Tx_Extbase_MVC_View_ViewInterface $view) {
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(Tx_Extbase_Configuration_ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $widgetViewHelperClassName = $this->request->getWidgetContext()->getWidgetViewHelperClassName();
        if (isset($extbaseFrameworkConfiguration['view']['widget'][$widgetViewHelperClassName]['templateRootPath'])
            && strlen($extbaseFrameworkConfiguration['view']['widget'][$widgetViewHelperClassName]['templateRootPath']) > 0
            && method_exists($view, 'setTemplateRootPath')) {
            $view->setTemplateRootPath(t3lib_div::getFileAbsFileName($extbaseFrameworkConfiguration['view']['widget'][$widgetViewHelperClassName]['templateRootPath']));
        }
    }

}
?>