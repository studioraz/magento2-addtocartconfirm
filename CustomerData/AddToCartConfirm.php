<?php

 namespace SR\AddToCartConfirm\CustomerData;

 use Magento\Customer\CustomerData\SectionSourceInterface;
 use Magento\Catalog\Api\ProductRepositoryInterface;

 class AddToCartConfirm extends \Magento\Framework\DataObject implements SectionSourceInterface {

     /**
      * @var \Magento\Customer\Model\Session
      */
     protected $checkoutSession;

     /**
      * @var ProductRepositoryInterface
      */
     protected $productRepository;

     /**
      * @var \Magento\Catalog\Block\Product\ImageBuilder
      */
     protected $imageBuilder;
     /**
      * AddToCartConfirm constructor.
      * @param \Magento\Checkout\Model\Session $checkoutSession
      * @param array $data
      */
     public function __construct(
         \Magento\Catalog\Block\Product\ImageBuilder $imageBuilder,
         \Magento\Checkout\Model\Session $checkoutSession,
         ProductRepositoryInterface $productRepository,
         array $data = []
     ) {
         parent::__construct($data);
         $this->imageBuilder = $imageBuilder;
         $this->checkoutSession = $checkoutSession;
         $this->productRepository = $productRepository;
     }

     public function getSectionData() {

         $lastAddedId = $this->checkoutSession->getLastAddedProductForConfirmPopup(true);

         if (is_null($lastAddedId)) {
             return;
         }
         /**
          * @var \Magento\Catalog\Api\Data\ProductInterface
          */
         $product = $this->productRepository->getById($lastAddedId);

         return [
             'product_image_html' => $this->getImage($product, 'product_page_image_medium')->toHtml(),
             'product_name' => $product->getName(),
             'product_sku' => $product->getSku(),
             'success_message' => __(
                 'You added %1 to your shopping cart.',
                 $product->getName()
             )
         ];
     }

     /**
      * Retrieve product image
      *
      * @param \Magento\Catalog\Model\Product $product
      * @param string $imageId
      * @param array $attributes
      * @return \Magento\Catalog\Block\Product\Image
      */
     public function getImage($product, $imageId, $attributes = [])
     {
         return $this->imageBuilder->setProduct($product)
             ->setImageId($imageId)
             ->setAttributes($attributes)
             ->create();
     }


 }