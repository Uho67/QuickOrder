<?php
namespace MyModules\QuickOrder\Setup;

use Psr\Log\LoggerInterface;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\InstallSchemaInterface;


use Magento\Framework\DB\Adapter\AdapterInterface;


use MyModules\QuickOrder\Api\Order\QuickOrderInterface;
use MyModules\QuickOrder\Api\Status\StatusInterface;

class InstallSchema implements InstallSchemaInterface
{


    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->createTableQuickOrder($setup,$context);
        $this->createTableStatus($setup,$context);
     }

     public function createTableQuickOrder(SchemaSetupInterface $setup, ModuleContextInterface $context){

            $installer = $setup;

            $installer->startSetup();

            $table = $installer->getConnection()->newTable(
                $installer->getTable(QuickOrderInterface::TABLE_NAME)
            )->addColumn(
                QuickOrderInterface::ID_FIELD,
                Table::TYPE_INTEGER,
                null,
                ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
                'QuickOrder ID'
            )->addColumn(
                QuickOrderInterface::NAME_FIELD,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Client name'
            )->addColumn(
                QuickOrderInterface::SKU_FIELD,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Product sku'
            )->addColumn(
                QuickOrderInterface::EMAIL_FIELD,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Client email'
            )->addColumn(
                QuickOrderInterface::PHONE_FIELD,
                Table::TYPE_TEXT,
                255,
                ['nullable' => false],
                'Client phone'
            )->addColumn(
                QuickOrderInterface::STATUS_FIELD,
                Table::TYPE_SMALLINT,
                255,
                [
                    'nullable'  => false,
                ],
                'status_id table status'
            )->addColumn(
                QuickOrderInterface::CREATE_FIELD,
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'default'   => Table::TIMESTAMP_INIT,
                ],
                'create order'
            )->addColumn(
                QuickOrderInterface::UPDATE_FIELD,
                Table::TYPE_TIMESTAMP,
                null,
                [
                    'default'   => Table::TIMESTAMP_INIT_UPDATE,
                ],
                'update order'
            )->addIndex(
                $setup->getIdxName(
                    $installer->getTable(QuickOrderInterface::TABLE_NAME),
                    [QuickOrderInterface::SKU_FIELD],
                    AdapterInterface::INDEX_TYPE_FULLTEXT
                ),
                [QuickOrderInterface::NAME_FIELD, QuickOrderInterface::SKU_FIELD],
                ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
            )->setComment(
                'QuickOrders table'
            );
            $installer->getConnection()->createTable($table);
            $installer->endSetup();
        }


     public function createTableStatus(SchemaSetupInterface $setup, ModuleContextInterface $context){
         $installer = $setup;

         $installer->startSetup();

         $table = $installer->getConnection()->newTable(
             $installer->getTable(StatusInterface::TABLE_NAME)
         )->addColumn(
             StatusInterface::ID_FIELD,
             Table::TYPE_INTEGER,
             null,
             ['identity' => true, 'nullable' => false, 'primary' => true, 'unsigned'=> true],
             'status ID'
         )->addColumn(
             StatusInterface::NAME_FIELD,
             Table::TYPE_TEXT,
             255,
             ['nullable' => false],
             'status name'
         )->addIndex(
             $setup->getIdxName(
                 $installer->getTable(StatusInterface::TABLE_NAME),
                 [StatusInterface::NAME_FIELD],
                 AdapterInterface::INDEX_TYPE_FULLTEXT
             ),
             [StatusInterface::NAME_FIELD],
             ['type' => AdapterInterface::INDEX_TYPE_FULLTEXT]
         )->setComment(
             'Quick order status  table'
         );
         $installer->getConnection()->createTable($table);
         $installer->endSetup();
     }
}


