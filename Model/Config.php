<?php
namespace Lof\ImprovedSorting\Model;

class Config extends \Magento\Catalog\Model\Config
{
    const XML_PATH_IMPROVED_SORTING_ENABLED = 'lofimprovedsorting/general/enabled';

    /**
     * @inheritdoc
     */
    public function getAttributeUsedForSortByArray()
    {
        if ((bool)$this->isEnabledImprovedSorting()) {
            foreach ($this->getAttributesUsedForSortBy() as $attribute) {
                /* @var $attribute \Magento\Eav\Model\Entity\Attribute\AbstractAttribute */
                $options[$attribute->getAttributeCode()] = $attribute->getStoreLabel();
            }
            $options['bestseller'] = __('Best Sellers');
            $options['created_at'] = __('New Arrivals');
            $options['toprated'] = __('Top Rated');
            return $options;
        } else {
            return parent::getAttributeUsedForSortByArray();
        }
    }

    /**
     * is enabled
     *
     * @param mixed $store
     * @return string
     */
    public function isEnabledImprovedSorting($store = null)
    {
        return $this->_scopeConfig->getValue(
            self::XML_PATH_IMPROVED_SORTING_ENABLED,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE,
            $store
        );
    }
 }
