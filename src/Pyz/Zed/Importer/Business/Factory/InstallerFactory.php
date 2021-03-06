<?php

/**
 * This file is part of the Spryker Demoshop.
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace Pyz\Zed\Importer\Business\Factory;

use Pyz\Zed\Importer\Business\Installer\Category\CategoryCatalogInstaller;
use Pyz\Zed\Importer\Business\Installer\Category\CategoryInstaller;
use Pyz\Zed\Importer\Business\Installer\Category\CategoryRootInstaller;
use Pyz\Zed\Importer\Business\Installer\Cms\CmsBlockInstaller;
use Pyz\Zed\Importer\Business\Installer\Cms\CmsPageInstaller;
use Pyz\Zed\Importer\Business\Installer\Discount\DiscountInstaller;
use Pyz\Zed\Importer\Business\Installer\Glossary\GlossaryInstaller;
use Pyz\Zed\Importer\Business\Installer\Product\ProductInstaller;
use Pyz\Zed\Importer\Business\Installer\Product\ProductSearchInstaller;
use Pyz\Zed\Importer\Business\Installer\Shipment\ShipmentInstaller;
use Pyz\Zed\Importer\Business\Installer\Tax\TaxInstaller;
use Pyz\Zed\Importer\ImporterConfig;

/**
 * @method \Pyz\Zed\Importer\ImporterConfig getConfig()
 */
class InstallerFactory extends AbstractFactory
{

    /**
     * @return \Pyz\Zed\Importer\Business\Factory\ImporterFactory
     */
    protected function createImporterFactory()
    {
        return new ImporterFactory();
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Category\CategoryInstaller
     */
    public function createCategoryInstaller()
    {
        $categoryInstaller = new CategoryInstaller(
            $this->getImporterCategoryCollection(),
            $this->getConfig()->getIcecatImportDataDirectory()
        );

        return $categoryInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Category\CategoryCatalogInstaller
     */
    public function createCategoryCatalogInstaller()
    {
        $categoryHierarchyInstaller = new CategoryCatalogInstaller(
            $this->getImporterCategoryCatalogCollection(),
            $this->getConfig()->getIcecatImportDataDirectory()
        );

        return $categoryHierarchyInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Category\CategoryRootInstaller
     */
    public function createCategoryRootInstaller()
    {
        $categoryRootInstaller = new CategoryRootInstaller(
            $this->getImporterCategoryRootCollection(),
            $this->getConfig()->getImportDataDirectory()
        );

        return $categoryRootInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Product\ProductInstaller
     */
    public function createProductInstaller()
    {
        $productInstaller = new ProductInstaller(
            $this->getImporterProductCollection(),
            $this->getConfig()->getIcecatImportDataDirectory()
        );

        return $productInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Product\ProductSearchInstaller
     */
    public function createProductSearchInstaller()
    {
        $productSearchInstaller = new ProductSearchInstaller(
            $this->getImporterProductSearchCollection(),
            $this->getConfig()->getImportDataDirectory()
        );

        return $productSearchInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Glossary\GlossaryInstaller
     */
    public function createGlossaryInstaller()
    {
        $glossaryInstaller = new GlossaryInstaller(
            $this->getImporterGlossaryCollection(),
            $this->getConfig()->getImportDataDirectory()
        );

        return $glossaryInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Glossary\GlossaryInstaller
     */
    public function createDiscountInstaller()
    {
        $glossaryInstaller = new DiscountInstaller(
            $this->getDiscountImporterCollection(),
            $this->getConfig()->getImportDataDirectory()
        );

        return $glossaryInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Cms\CmsBlockInstaller
     */
    public function createCmsBlockInstaller()
    {
        $cmsBlockInstaller = new CmsBlockInstaller(
            $this->getImporterCmsBlockCollection(),
            $this->getConfig()->getImportDataDirectory()
        );

        return $cmsBlockInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Cms\CmsPageInstaller
     */
    public function createCmsPageInstaller()
    {
        $cmsBlockInstaller = new CmsPageInstaller(
            $this->getImporterCmsPageCollection(),
            $this->getConfig()->getImportDataDirectory()
        );

        return $cmsBlockInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Shipment\ShipmentInstaller
     */
    public function createShipmentInstaller()
    {
        $shipmentInstaller = new ShipmentInstaller(
            $this->getImporterShipmentCollection(),
            $this->getConfig()->getImportDataDirectory()
        );

        return $shipmentInstaller;
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\Tax\TaxInstaller
     */
    public function createTaxInstaller()
    {
        return new TaxInstaller(
            $this->getImporterTaxCollection(),
            $this->getConfig()->getImportDataDirectory()
        );
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\InstallerInterface[]
     */
    public function getImporterTaxCollection()
    {
        return [
            ImporterConfig::RESOURCE_TAX => $this->createImporterFactory()->createTaxImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\InstallerInterface[]
     */
    public function getImporterCategoryCollection()
    {
        return [
            ImporterConfig::RESOURCE_CATEGORY => $this->createImporterFactory()->createCategoryImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\InstallerInterface[]
     */
    public function getImporterCategoryCatalogCollection()
    {
        return [
            ImporterConfig::RESOURCE_CATEGORY_CATALOG => $this->createImporterFactory()->createCategoryHierarchyImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\InstallerInterface[]
     */
    public function getImporterCategoryRootCollection()
    {
        return [
            ImporterConfig::RESOURCE_CATEGORY_ROOT => $this->createImporterFactory()->createCategoryRootImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Installer\InstallerInterface[]
     */
    public function getImporterProductCollection()
    {
        return [
            ImporterConfig::RESOURCE_PRODUCT => $this->createImporterFactory()->createProductAbstractImporter(),
            ImporterConfig::RESOURCE_PRODUCT_CATEGORY => $this->createImporterFactory()->createProductCategoryImporter(),
            ImporterConfig::RESOURCE_PRODUCT_STOCK => $this->createImporterFactory()->createProductStockImporter(),
            ImporterConfig::RESOURCE_PRODUCT_PRICE => $this->createImporterFactory()->createProductPriceImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Importer\ImporterInterface[]
     */
    public function getImporterProductSearchCollection()
    {
        return [
            ImporterConfig::RESOURCE_PRODUCT_SEARCH => $this->createImporterFactory()->createProductSearchImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Importer\ImporterInterface[]
     */
    public function getImporterGlossaryCollection()
    {
        return [
            ImporterConfig::RESOURCE_GLOSSARY_TRANSLATION => $this->createImporterFactory()->createGlossaryImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Importer\ImporterInterface[]
     */
    public function getDiscountImporterCollection()
    {
        return [
            ImporterConfig::RESOURCE_DISCOUNT => $this->createImporterFactory()->createDiscountImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Importer\ImporterInterface[]
     */
    public function getImporterCmsBlockCollection()
    {
        return [
            ImporterConfig::RESOURCE_CMS_BLOCK => $this->createImporterFactory()->createCmsBlockImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Importer\ImporterInterface[]
     */
    public function getImporterCmsPageCollection()
    {
        return [
            ImporterConfig::RESOURCE_CMS_PAGE => $this->createImporterFactory()->createCmsPageImporter(),
        ];
    }

    /**
     * @return \Pyz\Zed\Importer\Business\Importer\ImporterInterface[]
     */
    public function getImporterShipmentCollection()
    {
        return [
            ImporterConfig::RESOURCE_SHIPMENT => $this->createImporterFactory()->createShipmentImporter(),
        ];
    }

}
