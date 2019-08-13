<?php
/**
 * Created by PhpStorm.
 * User: uho0613
 * Date: 10.08.19
 * Time: 16:32
 */

namespace MyModules\QuickOrder\Setup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\Transaction;
use Magento\Framework\DB\TransactionFactory;

use MyModules\QuickOrder\Api\Status\StatusInterfaceFactory;
use MyModules\QuickOrder\Api\Order\QuickOrderInterfaceFactory;

use Psr\Log\LoggerInterface;


class InstallData implements InstallDataInterface
{
    protected $statusFactory;
    protected $orderFactory;
    protected $transactionFactory;
    protected $logger;
    public function __construct(
        LoggerInterface $logger,
        QuickOrderInterfaceFactory $quickFactory,
        TransactionFactory $transactionFactory,
    StatusInterfaceFactory $status
    )
    {
        $this->orderFactory = $quickFactory;
        $this->logger = $logger;
        $this->statusFactory = $status;
        $this->transactionFactory = $transactionFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $defaultStatus = ['Status was deleted','order accepted','order completed'];

        $transactionModel = $this->transactionFactory->create();
        foreach ($defaultStatus as $item) {
            $statusModel = $this->statusFactory->create();
            $statusModel->setName($item);
            $transactionModel->addObject($statusModel);
        }
        for($i =0 ;$i<3;$i++){
            $order = $this->orderFactory->create();
            $order->setName(sprintf("Name %d", $i));
            $order->setSku(sprintf("Sku %d", $i));
            $order->setEmail(sprintf("Email %d", $i));
            $order->setPhone(sprintf("Phone %d", $i));
            $order->setStatus(1);
            $transactionModel->addObject($order);

        }
        try {
            $transactionModel->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}