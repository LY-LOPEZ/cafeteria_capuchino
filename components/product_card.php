<?php
// components/product_card.php
// Requires: $fetch_products array and $user_id
?>
<form action="" method="post" class="box tw-group tw-relative tw-flex tw-flex-col tw-overflow-hidden tw-rounded-2xl tw-bg-white tw-p-5 tw-shadow-[0_8px_30px_rgb(0,0,0,0.04)] tw-transition-all tw-duration-300 hover:-tw-translate-y-2 hover:tw-shadow-xl">
   <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
   <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
   <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
   <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">

   <!-- Product Image & Floating Actions -->
   <div class="tw-relative tw-mb-4 tw-overflow-hidden tw-rounded-xl tw-bg-gradient-to-tr tw-from-coffee-50/50 tw-to-white tw-p-4">
      <img class="tw-h-64 tw-w-full tw-object-contain tw-transition-transform tw-duration-500 group-hover:tw-scale-110" src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      
      <!-- Floating Actions (Quick View & Add to Cart) -->
      <div class="tw-absolute tw-right-3 tw-top-3 tw-flex tw-flex-col tw-gap-2 tw-opacity-0 tw-transition-opacity tw-duration-300 group-hover:tw-opacity-100">
         <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'quick_view' : 'quick_view.php'; ?>?pid=<?= $fetch_products['id']; ?>" class="tw-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-full tw-bg-white/90 tw-text-xl tw-text-coffee-900 tw-shadow-sm tw-backdrop-blur tw-transition-colors hover:tw-bg-coffee-900 hover:tw-text-white" title="Vista R&aacute;pida">
            <i class="fas fa-eye"></i>
         </a>
         <?php 
         // Customize the add to cart button using the renderCartAction helper
         renderCartAction($user_id, 'tw-flex tw-h-12 tw-w-12 tw-items-center tw-justify-center tw-rounded-full tw-bg-white/90 tw-text-xl tw-text-coffee-900 tw-shadow-sm tw-backdrop-blur tw-transition-colors hover:tw-bg-coffee-900 hover:tw-text-white', '<i class="fas fa-cart-plus"></i>'); 
         ?>
      </div>
   </div>

   <!-- Category Badge -->
   <?php if (isset($fetch_products['category'])) { ?>
   <a href="<?= defined('PUBLIC_BASE') ? PUBLIC_BASE . 'category' : 'category.php'; ?>?category=<?= $fetch_products['category']; ?>" class="cat tw-inline-flex tw-self-start tw-rounded-full tw-bg-sage/15 tw-px-4 tw-py-1.5 tw-text-xs tw-font-bold tw-uppercase tw-tracking-wide tw-text-sage tw-transition-colors hover:tw-bg-sage hover:tw-text-white">
      <?= $fetch_products['category']; ?>
   </a>
   <?php } ?>
   
   <!-- Product Name -->
   <div class="name tw-mt-4 tw-min-h-16 tw-text-2xl tw-font-bold tw-leading-tight tw-text-coffee-900 tw-line-clamp-2">
      <?= $fetch_products['name']; ?>
   </div>
   
   <!-- Price & Quantity -->
   <div class="flex tw-mt-auto tw-flex tw-items-center tw-gap-3 tw-pt-5">
      <div class="price tw-mr-auto tw-font-display tw-text-3xl tw-font-bold tw-text-coffee-700">
         <span class="tw-text-lg tw-text-coffee-400">Bs.</span><?= $fetch_products['price']; ?>
      </div>
      <div class="tw-flex tw-items-center tw-gap-2">
         <input type="number" name="qty" class="qty tw-h-12 tw-w-16 tw-rounded-lg tw-border tw-border-coffee-700/10 tw-bg-coffee-50 tw-text-center tw-text-xl tw-font-medium focus:tw-border-coffee-300 focus:tw-outline-none" min="1" max="99" value="1" maxlength="2">
         <?php 
         // Another Add button next to quantity for direct action
         renderCartAction($user_id, 'tw-flex tw-h-12 tw-items-center tw-justify-center tw-rounded-lg tw-bg-coffee-900 tw-px-4 tw-text-white tw-transition-colors hover:tw-bg-coffee-800', 'Agregar'); 
         ?>
      </div>
   </div>
</form>
