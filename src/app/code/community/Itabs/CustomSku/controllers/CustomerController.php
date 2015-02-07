<?php
/**
 * This file is part of the Itabs_CustomSku module.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * PHP version 5
 *
 * @category  Itabs
 * @package   Itabs_CustomSku
 * @author    ITABS GmbH <info@itabs.de>
 * @copyright 2015 ITABS GmbH (http://www.itabs.de)
 */

/**
 * Class Itabs_CustomSku_CustomerController
 */
class Itabs_CustomSku_CustomerController extends Mage_Core_Controller_Front_Action
{
    /**
     * Check if the customer is authenticated
     */
    public function preDispatch()
    {
        parent::preDispatch();

        if (!$this->getHelper()->getSession()->authenticate($this)) {
            $this->setFlag('', 'no-dispatch', true);
        }
    }

    /**
     * Show all custom skus in customer account
     */
    public function listAction()
    {
        $this->loadLayout();
        $this->_initLayoutMessages('customer/session');
        $this->_title($this->getHelper()->__('Custom SKUs'));
        $this->renderLayout();
    }

    /**
     * Process the custom sku update and save
     */
    public function saveAction()
    {
        $helper = $this->getHelper();
        $hasProcessedData = false;

        // Process all existing custom sku
        $existing = $this->getRequest()->getPost('existing', false);
        if ($existing) {
            foreach ($existing as $itemId => $customSku) {
                /* @var $model Itabs_CustomSku_Model_CustomSku */
                $model = Mage::getModel('itabs_customsku/customSku')->load($itemId);

                if ($helper->hasCorrectCustomerId($model)
                    && !empty($customSku)
                    && $customSku != $model->getData('custom_sku')
                ) {
                    $service = $helper->getFactory()->getServiceCheckCustomSkuExits();
                    $service->setExcludeId($model->getId());
                    if (!$service->execute($customSku, $helper->getCustomer())) {
                        $model->setData('custom_sku', $customSku);
                        $model->save();

                        $hasProcessedData = true;
                    } else {
                        $helper->getSession()->addError(
                            $helper->__('You already have a custom sku "%s"!', $customSku)
                        );
                    }
                }
            }
        }

        // Process the new custom sku
        $new = $this->getRequest()->getPost('new', false);
        if ($new) {
            if (!empty($new['sku']) && !empty($new['custom_sku'])) {
                try {
                    $service = $helper->getFactory()->getServiceCheckCustomSkuExits();
                    if (!$service->execute($new['custom_sku'], $helper->getCustomer())) {
                        /* @var $model Itabs_CustomSku_Model_CustomSku */
                        $model = Mage::getModel('itabs_customsku/customSku');
                        $model->setData('customer_id', $helper->getCustomerId());
                        $model->setData('sku', $new['sku']);
                        $model->setData('custom_sku', $new['custom_sku']);
                        $model->save();

                        $hasProcessedData = true;
                    } else {
                        $helper->getSession()->addError(
                            $helper->__('You already have a custom sku "%s"!', $new['custom_sku'])
                        );
                    }
                } catch (Exception $e) {
                    if ($e->getCode() == 23000) { // Duplicate key error
                        $helper->getSession()->addError(
                            $helper->__('You already have a custom sku for the sku "%s".', $new['sku'])
                        );
                    } else {
                        $helper->getSession()->addError($helper->__('Error during save. Please try again.'));
                    }
                }
            }
        }

        // Output success message if there are changed data
        if ($hasProcessedData) {
            $helper->getSession()->addSuccess($helper->__('Data successfully saved.'));
        }

        return $this->_redirect('*/customer/list');
    }

    /**
     * Delete a custom sku
     */
    public function deleteAction()
    {
        $helper = $this->getHelper();

        if ($id = $this->getRequest()->getParam('id')) {
            $model = Mage::getModel('itabs_customsku/customSku')->load($id);
            if ($model->getId()) {
                if ($helper->hasCorrectCustomerId($model)) {
                    $model->delete();
                    $helper->getSession()->addSuccess($helper->__('Entry successfully deleted.'));
                } else {
                    $helper->getSession()->addError($helper->__('Forbidden.'));
                }
            } else {
                $helper->getSession()->addError($helper->__('Entry does not exist.'));
            }
        }

        $this->_redirect('*/customer/list');
    }

    /**
     * Retrieve the helper
     *
     * @return Itabs_CustomSku_Helper_Data
     */
    public function getHelper()
    {
        return Mage::helper('itabs_customsku');
    }
}
