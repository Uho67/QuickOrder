<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace MyModules\QuickOrder\Controller\Adminhtml\Orders;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor;


use MyModules\QuickOrder\Api\Order\QuickOrderInterface;

use MyModules\QuickOrder\Api\QuickOrdersRepositoryInterface as QuickOrdersRepository;

/**
 * Cms page grid inline edit controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineEdit extends \Magento\Backend\App\Action
{
    /**
     * Authorization level of a basic admin session
     */
    const ACL_RESOURCE      = 'MyModules_QuickOrder::editOrder';

    /**
     * @var \Magento\Cms\Controller\Adminhtml\Page\PostDataProcessor
     */
    protected $dataProcessor;

    /**
     * @var \MyModules\QuickOrder\Api\QuickOrdersRepositoryInterface
     */
    protected $orderRepository;

    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    protected $jsonFactory;

    /**
     * @param Context $context
     * @param PostDataProcessor $dataProcessor
     * @param QuickOrdersRepository $orderRepository
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        PostDataProcessor $dataProcessor,
        QuickOrdersRepository $orderRepository,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->dataProcessor = $dataProcessor;
        $this->orderRepository = $orderRepository;
        $this->jsonFactory = $jsonFactory;
    }

    /** {@inheritdoc} */
    protected function _isAllowed()
    {
        $result = parent::_isAllowed();
        $result = $result && $this->_authorization->isAllowed(static::ACL_RESOURCE);

        return $result;
    }
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        $postItems = $this->getRequest()->getParam('items', []);
        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
            return $resultJson->setData([
                'messages' => [__('Please correct the data sent.')],
                'error' => true,
            ]);
        }

        foreach (array_keys($postItems) as $pageId) {
            /** @var \MyModules\QuickOrder\Model\QuickOrders $page */
            $page = $this->orderRepository->getById($pageId);
            try {
                $pageData = $this->filterPost($postItems[$pageId]);
                $this->validatePost($pageData, $page, $error, $messages);
                $extendedPageData = $page->getData();
                $this->setCmsPageData($page, $extendedPageData, $pageData);
                $this->orderRepository->save($page);
            } catch (\Magento\Framework\Exception\LocalizedException $e) {
                $messages[] = $this->getErrorWithPageId($page, $e->getMessage());
                $error = true;
            } catch (\RuntimeException $e) {
                $messages[] = $this->getErrorWithPageId($page, $e->getMessage());
                $error = true;
            } catch (\Exception $e) {
                $messages[] = $this->getErrorWithPageId(
                    $page,
                    __('Something went wrong while saving the page.')
                );
                $error = true;
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }

    /**
     * Filtering posted data.
     *
     * @param array $postData
     * @return array
     */
    protected function filterPost($postData = [])
    {
        $pageData = $this->dataProcessor->filter($postData);
        $pageData['custom_theme'] = isset($pageData['custom_theme']) ? $pageData['custom_theme'] : null;
        $pageData['custom_root_template'] = isset($pageData['custom_root_template'])
            ? $pageData['custom_root_template']
            : null;
        return $pageData;
    }

    /**
     * Validate post data
     *
     * @param array $pageData
     * @param \MyModules\QuickOrder\Model\QuickOrders $page
     * @param bool $error
     * @param array $messages
     * @return void
     */
    protected function validatePost(array $pageData, \MyModules\QuickOrder\Model\QuickOrders $page, &$error, array &$messages)
    {
        if (!($this->dataProcessor->validate($pageData) && $this->dataProcessor->validateRequireEntry($pageData))) {
            $error = true;
            foreach ($this->messageManager->getMessages(true)->getItems() as $errorMessage) {
                $messages[] = $this->getErrorWithPageId($page, $errorMessage->getText());
            }
        }
    }

    /**
     * Add page title to error message
     *
     * @param QuickOrderInterface $order
     * @param string $errorText
     * @return string
     */
    protected function getErrorWithPageId(QuickOrderInterface $order, $errorText)
    {
        return '[Page ID: ' . $order->getId() . '] ' . $errorText;
    }

    /**
     * Set person data
     *
     * @param \MyModules\QuickOrder\Model\QuickOrders $person
     * @param array $extendedPageData
     * @param array $personData
     * @return $this
     */
    public function setCmsPageData(\MyModules\QuickOrder\Model\QuickOrders $person, array $extendedPageData, array $personData)
    {
        $person->setData(array_merge($person->getData(), $extendedPageData, $personData));
        return $this;
    }
}
