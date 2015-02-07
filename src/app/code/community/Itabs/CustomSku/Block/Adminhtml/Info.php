<?php

class Itabs_CustomSku_Block_Adminhtml_Info extends Mage_Adminhtml_Block_Template
{
    /**
     * Retrieve the custom sku
     *
     * @return string
     */
    public function getCustomSku()
    {
        if ($this->getParentBlock() && $this->getParentBlock()->getItem()) {
            return $this->getParentBlock()->getItem()->getData('custom_sku');
        }

        return null;
    }
}
