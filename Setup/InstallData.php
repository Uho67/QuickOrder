<?php

namespace MyModules\QuickOrder\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\DB\TransactionFactory;
use Psr\Log\LoggerInterface;

use MyModules\QuickOrder\Api\Status\StatusInterfaceFactory;
use MyModules\QuickOrder\Api\Order\QuickOrderInterfaceFactory;

/**
 * Class InstallData
 * @package MyModules\QuickOrder\Setup
 */
class InstallData implements InstallDataInterface
{
    /**
     * @var StatusInterfaceFactory
     */
    private $statusFactory;
    /**
     * @var QuickOrderInterfaceFactory
     */
    private $orderFactory;
    /**
     * @var TransactionFactory
     */
    private $transactionFactory;
    /**
     * @var LoggerInterface
     */
    private $logger;
    /**
     * InstallData constructor.
     * @param LoggerInterface $logger
     * @param QuickOrderInterfaceFactory $quickFactory
     * @param TransactionFactory $transactionFactory
     * @param StatusInterfaceFactory $status
     */
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
    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $defaultStatus = ['Status was deleted',
            'Pending',
            'Approved',
            'Decline'];
        $transactionModel = $this->transactionFactory->create();
        foreach ($defaultStatus as $item) {
            $statusModel = $this->statusFactory->create();
            $statusModel->setName($item);
            $transactionModel->addObject($statusModel);
        }
        for ($i = 0; $i < 3; $i++) {
            $order = $this->orderFactory->create();
            $order->setName(sprintf('Name %d', $i));
            $order->setSku(sprintf('Sku %d', $i));
            $order->setEmail(sprintf('Email %d', $i));
            $order->setPhone(sprintf('Phone %d', $i));
            $order->setStatus(2);
            $transactionModel->addObject($order);
        }
        try {
            $transactionModel->save();
        } catch (\Exception $e) {
            $this->logger->critical($e->getMessage());
        }
    }
}
